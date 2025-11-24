<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Admin\BookModel;
use App\Models\Admin\CategoryModel;
use App\Models\User\PeminjamanModel;
use App\Models\User\FavoriteModel;
use App\Models\User\UlasanModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $auth = service('auth');
        $user = $auth->user();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Akses ditolak! Silakan login.');
        }

        $bookModel       = new BookModel();
        $peminjamanModel = new PeminjamanModel();
        $favModel        = new FavoriteModel();
        $categoryModel   = new CategoryModel();
        $ulasanModel     = new UlasanModel();

        $request  = service('request');
        $search   = $request->getGet('q'); 
        $category = $request->getGet('category');

        // Total buku di perpustakaan
        $totalBooks = $bookModel->countAll();

        // Buku yang sedang dipinjam user ini
        $borrowedBooks = $peminjamanModel
            ->where('user_id', $user->id)
            ->where('status', 'Dipinjam')
            ->countAllResults();

        // Buku favorit user ini
        $favoriteBooks = $favModel
            ->where('user_id', $user->id)
            ->countAllResults();

        // Buku terbaru
        $latestBooksQuery = $bookModel
            ->select('books.*, categories.nama_kategori')
            ->join('categories', 'categories.kategori_id = books.kategori_id', 'left')
            ->orderBy('books.created_at', 'DESC');

        if ($search) {
            $latestBooksQuery->groupStart()
                             ->like('books.judul', $search)
                             ->orLike('books.penulis', $search)
                             ->orLike('books.penerbit', $search)
                             ->orLike('books.deskripsi', $search)
                             ->orLike('categories.nama_kategori', $search)
                             ->groupEnd();
        }

        if ($category) {
            $latestBooksQuery->where('books.kategori_id', $category);
        }

        $latestBooks = $latestBooksQuery->findAll(6);

        // Buku populer (berdasarkan rating)
        $ratedBooks = $bookModel
            ->select('books.*, AVG(ulasan.rating) as avg_rating')
            ->join('ulasan', 'ulasan.book_id = books.book_id', 'left')
            ->groupBy('books.book_id')
            ->having('COUNT(ulasan.rating) > 0')
            ->orderBy('avg_rating', 'DESC')
            ->limit(6)
            ->findAll();

        // Semua kategori
        $categories = $categoryModel->findAll();

        $data = [
            'title'            => 'Dashboard Pengguna',
            'base_url'         => base_url(),
            'userName'         => $user->username,
            'totalBooks'       => $totalBooks,
            'borrowedBooks'    => $borrowedBooks,
            'favoriteBooks'    => $favoriteBooks,
            'latestBooks'      => $latestBooks,
            'ratedBooks'       => $ratedBooks,
            'categories'       => $categories,
            'search'           => $search,
            'selectedCategory' => $category
        ];

        return $this->parse('user/dashboard.tpl', $data);
    }
}
