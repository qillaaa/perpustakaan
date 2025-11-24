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


        /** TOTAL BUKU **/
        $totalBooks = $bookModel->countAll();

        /** DIPINJAM USER **/
        $borrowedBooks = $peminjamanModel
            ->where('user_id', $user->id)
            ->where('status', 'Dipinjam')
            ->countAllResults();

        /** FAVORIT USER **/
        $favoriteBooks = $favModel
            ->where('user_id', $user->id)
            ->countAllResults();


        /** BUKU TERBARU **/
        $latestBooksQuery = $bookModel
            ->select('books.*, categories.nama_kategori')
            ->join('categories', 'categories.kategori_id = books.kategori_id', 'left')
            ->orderBy('books.created_at', 'DESC');

        if ($search) {
            $latestBooksQuery
                ->groupStart()
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


        /** BUKU BER-RATING **/
        $ratedBooks = $bookModel
            ->select('books.*, AVG(ulasan.rating) AS avg_rating')
            ->join('ulasan', 'ulasan.book_id = books.book_id', 'left')
            ->groupBy('books.book_id')
            ->having('AVG(ulasan.rating) > 0')
            ->orderBy('avg_rating', 'DESC')
            ->limit(6)
            ->findAll();


        /** =====================================================
         * KOMBINASI POPULER = DIPINJAM + FAVORIT
         * ===================================================== */

        // Total pinjam
        $borrowStats = $peminjamanModel
            ->select('book_id, COUNT(book_id) AS total_pinjam')
            ->groupBy('book_id')
            ->findAll();

        // Total favorit
        $favStats = $favModel
            ->select('book_id, COUNT(book_id) AS total_favorit')
            ->groupBy('book_id')
            ->findAll();

        // Convert ke associative array
        $borrowArr = [];
        foreach ($borrowStats as $b) {
            $borrowArr[$b['book_id']] = $b['total_pinjam'];
        }

        $favArr = [];
        foreach ($favStats as $f) {
            $favArr[$f['book_id']] = $f['total_favorit'];
        }

        // Gabungkan popularitas
        $popularBooks = [];
        $allBookIds = array_unique(array_merge(array_keys($borrowArr), array_keys($favArr)));

        foreach ($allBookIds as $bookId) {
            $bookData = $bookModel->find($bookId);

            if (!$bookData) {
                continue; // Skip jika buku sudah dihapus
            }

            $popularBooks[] = [
                'book_id'        => $bookId,
                'judul'          => $bookData['judul'],
                'cover'          => $bookData['cover'],
                'penulis'        => $bookData['penulis'],
                'total_pinjam'   => $borrowArr[$bookId] ?? 0,
                'total_favorit'  => $favArr[$bookId] ?? 0,
                'popularity'     => ($borrowArr[$bookId] ?? 0) + ($favArr[$bookId] ?? 0),
            ];
        }

        // Urutkan berdasarkan popularitas
        usort($popularBooks, function ($a, $b) {
            return $b['popularity'] <=> $a['popularity'];
        });

        // Ambil 6 teratas
        $popularBooks = array_slice($popularBooks, 0, 6);


        /** KATEGORI **/
        $categories = $categoryModel->findAll();


        /** KIRIM KE VIEW **/
        $data = [
            'title'            => 'Dashboard Pengguna',
            'base_url'         => base_url(),
            'userName'         => $user->username,

            'totalBooks'       => $totalBooks,
            'borrowedBooks'    => $borrowedBooks,
            'favoriteBooks'    => $favoriteBooks,

            'latestBooks'      => $latestBooks,
            'ratedBooks'       => $ratedBooks,

            'popularBooks'     => $popularBooks, // Sudah aman & flat

            'categories'       => $categories,
            'search'           => $search,
            'selectedCategory' => $category,
        ];

        return $this->parse('user/dashboard.tpl', $data);
    }
}
