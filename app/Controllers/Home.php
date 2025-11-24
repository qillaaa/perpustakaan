<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin\BookModel;
use App\Models\Admin\CategoryModel;
use App\Models\User\UlasanModel;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Halaman Utama';

        $categoryModel = new CategoryModel();
        $bookModel     = new BookModel();
        $ulasanModel   = new UlasanModel();

        // Ambil semua kategori
        $this->data['categories'] = $categoryModel->findAll();

        // Populer
        $popularBooks = $bookModel
            ->orderBy('book_id', 'DESC')
            ->limit(6)
            ->findAll();
        $this->data['popular_books'] = $popularBooks;

        // Terbaru (1 minggu terakhir)
        $oneWeekAgo = Time::now()->subDays(7)->toDateTimeString();
        $latestBooks = $bookModel
            ->where('created_at >=', $oneWeekAgo)
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $this->data['latest_books'] = $latestBooks;

        // Buku dengan Rating
        $allBooks = $bookModel->findAll();
        $ratedBooks = [];

        foreach ($allBooks as $book) {

            $avgRating = $ulasanModel->selectAvg('rating')
                                     ->where('book_id', $book['book_id'])
                                     ->first();

            // FIX: paksa rating menjadi float
            $book['rating'] = isset($avgRating['rating'])
                ? floatval($avgRating['rating'])
                : 0;

            // Optional: batasi rating agar tidak lebih dari 5
            $book['rating'] = min(5, max(0, $book['rating']));

            if ($book['rating'] > 0) {
                $ratedBooks[] = $book;
            }
        }

        // Urutkan berdasarkan rating
        usort($ratedBooks, fn($a, $b) => $b['rating'] <=> $a['rating']);
        $this->data['rated_books'] = array_slice($ratedBooks, 0, 6);

        // Status User
        $this->data['isLoggedIn'] = session()->get('isLoggedIn') ?? false;
        $this->data['userName']   = session()->get('userName') ?? '';

        return $this->parse('home.tpl', $this->data);
    }

    public function search()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $query = $this->request->getGet('q');
        $bookModel = new BookModel();

        $this->data['books'] = $bookModel
            ->like('judul', $query)
            ->findAll();

        $this->data['query'] = $query;
        $this->data['title'] = 'Hasil Pencarian: ' . $query;

        return $this->parse('search_results.tpl', $this->data);
    }

    public function category($kategori_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $categoryModel = new CategoryModel();
        $bookModel     = new BookModel();
        $ulasanModel   = new UlasanModel();

        $this->data['categories'] = $categoryModel->findAll();
        $books = $bookModel->where('kategori_id', $kategori_id)->findAll();

        foreach ($books as &$book) {

            $avgRating = $ulasanModel->selectAvg('rating')
                                     ->where('book_id', $book['book_id'])
                                     ->first();

            // FIX
            $book['rating'] = isset($avgRating['rating'])
                ? floatval($avgRating['rating'])
                : 0;

            $book['rating'] = min(5, max(0, $book['rating']));
        }

        $this->data['books'] = $books;
        $this->data['title'] = 'Kategori: ' . ($categoryModel->find($kategori_id)['nama_kategori'] ?? '');

        return $this->parse('category.tpl', $this->data);
    }

    public function book($book_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $bookModel   = new BookModel();
        $ulasanModel = new UlasanModel();

        $book = $bookModel->find($book_id);

        $avgRating = $ulasanModel->selectAvg('rating')
                                 ->where('book_id', $book_id)
                                 ->first();

        // FIX
        $book['rating'] = isset($avgRating['rating'])
            ? floatval($avgRating['rating'])
            : 0;

        $book['rating'] = min(5, max(0, $book['rating']));

        $this->data['book']  = $book;
        $this->data['title'] = $book['judul'] ?? 'Detail Buku';

        return $this->parse('book_detail.tpl', $this->data);
    }
}
