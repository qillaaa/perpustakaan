<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Admin\BookModel;
use App\Models\Admin\CategoryModel;
use App\Models\User\PeminjamanModel;
use App\Models\User\FavoriteModel;
use App\Models\User\UlasanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BooksController extends BaseController
{
    protected $auth;
    protected $user;

    public function __construct()
    {
        $this->auth = service('auth');
        $this->user = $this->auth->user();
    }

    private function checkUser()
    {
        if (!$this->user) {
            return redirect()->to('/login')->with('error', 'Akses ditolak!');
        }
    }

    // =================== Daftar Buku ===================
    public function index()
    {
        if ($redirect = $this->checkUser()) return $redirect;

        $bookModel     = new BookModel();
        $categoryModel = new CategoryModel();

        $q        = $this->request->getGet('q');
        $kategori = $this->request->getGet('kategori');

        $bookQuery = $bookModel->select('books.*, categories.nama_kategori')
            ->join('categories', 'categories.kategori_id = books.kategori_id', 'left')
            ->orderBy('books.created_at', 'DESC');

        if (!empty($q)) {
            $bookQuery->groupStart()
                      ->like('books.judul', $q)
                      ->orLike('books.penulis', $q)
                      ->orLike('books.penerbit', $q)
                      ->orLike('books.deskripsi', $q)
                      ->orLike('categories.nama_kategori', $q)
                      ->groupEnd();
        }

        if (!empty($kategori)) {
            $bookQuery->where('books.kategori_id', $kategori);
        }

        $booksRaw = $bookQuery->findAll();
        $books = [];
        $favModel = new FavoriteModel();

        foreach ($booksRaw as $b) {
            $books[] = [
                'book_id'       => $b['book_id'] ?? '',
                'judul'         => $b['judul'] ?? '',
                'penulis'       => $b['penulis'] ?? '-',
                'penerbit'      => $b['penerbit'] ?? '-',
                'kategori_id'   => $b['kategori_id'] ?? null,
                'nama_kategori' => $b['nama_kategori'] ?? '-',
                'tahun_terbit'  => $b['tahun_terbit'] ?? '-',
                'deskripsi'     => $b['deskripsi'] ?? '',
                'cover'         => $b['cover'] ?? null,
                'file_buku'     => $b['file_buku'] ?? null,
                'stok'          => $b['stok'] ?? 0,
                'isFavorited'   => $favModel->where('user_id', $this->user->id)
                                             ->where('book_id', $b['book_id'])
                                             ->first() ? true : false,
            ];
        }

        $categories = $categoryModel->findAll();

        return $this->parse('user/books.tpl', [
            'title'      => 'Daftar Buku',
            'base_url'   => base_url(),
            'userName'   => $this->user->username,
            'books'      => $books,
            'categories' => $categories,
            'q'          => $q,
            'kategori'   => $kategori,
        ]);
    }

    // =================== Detail Buku ===================
    public function view($bookId = null)
    {
        if ($redirect = $this->checkUser()) return $redirect;
        if (!$bookId) throw PageNotFoundException::forPageNotFound('Buku tidak ditemukan');

        $bookModel = new BookModel();
        $favModel  = new FavoriteModel();

        $book = $bookModel->select('books.*, categories.nama_kategori')
                          ->join('categories', 'categories.kategori_id = books.kategori_id', 'left')
                          ->find($bookId);

        if (!$book) throw PageNotFoundException::forPageNotFound('Buku tidak ditemukan');

        // Cek favorit user
        $isFavorited = $favModel->where('user_id', $this->user->id)
                                ->where('book_id', $bookId)
                                ->first() ? true : false;

        // Rekomendasi buku berdasarkan kategori
        $recommendedBooksRaw = $bookModel->where('kategori_id', $book['kategori_id'])
                                         ->where('book_id !=', $bookId)
                                         ->findAll();

        $recommendedBooks = [];
        foreach ($recommendedBooksRaw as $rec) {
            $recommendedBooks[] = [
                'book_id'       => $rec['book_id'],
                'judul'         => $rec['judul'],
                'penulis'       => $rec['penulis'] ?? '-',
                'cover'         => $rec['cover'] ?? null,
                'isFavorited'   => $favModel->where('user_id', $this->user->id)
                                             ->where('book_id', $rec['book_id'])
                                             ->first() ? true : false,
            ];
        }

        return $this->parse('user/books_view.tpl', [
            'base_url'         => base_url(),
            'book'             => $book,
            'isFavorited'      => $isFavorited,
            'recommendedBooks' => $recommendedBooks,
            'userName'         => $this->user->username,
        ]);
    }

    // =================== Pinjam Buku ===================
    public function borrow($bookId = null)
    {
        if ($redirect = $this->checkUser()) return $redirect;
        if (!$bookId) return redirect()->back()->with('error', 'Buku tidak valid.');

        $bookModel = new BookModel();
        $peminjamanModel = new PeminjamanModel();

        $book = $bookModel->find($bookId);
        if (!$book) return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        if ($book['stok'] <= 0) return redirect()->back()->with('error', 'Stok buku habis.');

        $alreadyBorrowed = $peminjamanModel
            ->where('user_id', $this->user->id)
            ->where('book_id', $bookId)
            ->where('status', 'Dipinjam')
            ->first();

        if ($alreadyBorrowed) return redirect()->back()->with('error', 'Anda sudah meminjam buku ini.');

        $tglPinjam  = date('Y-m-d');
        $tglKembali = date('Y-m-d', strtotime($tglPinjam . ' +7 days'));

        $peminjamanModel->insert([
            'user_id'    => $this->user->id,
            'book_id'    => $bookId,
            'tgl_pinjam' => $tglPinjam,
            'tgl_kembali'=> $tglKembali,
            'status'     => 'Dipinjam',
        ]);

        $bookModel->update($bookId, ['stok' => $book['stok'] - 1]);

        return redirect()->to('/user/mybooks')->with('success', 'Buku berhasil dipinjam!');
    }

    // =================== Favorit ===================
    public function favorite($bookId = null)
    {
        if ($redirect = $this->checkUser()) return $redirect;
        if (!$bookId) return redirect()->back()->with('error', 'Buku tidak valid.');

        $favModel = new FavoriteModel();

        $fav = $favModel->where('user_id', $this->user->id)
                        ->where('book_id', $bookId)
                        ->first();

        if ($fav) {
            $favModel->delete($fav['id']);
            return redirect()->back()->with('success', 'Buku dihapus dari favorit.');
        } else {
            $favModel->insert([
                'user_id' => $this->user->id,
                'book_id' => $bookId,
            ]);
            return redirect()->back()->with('success', 'Buku ditambahkan ke favorit.');
        }
    }

    // =================== My Books ===================
    public function myBooks()
    {
        if ($redirect = $this->checkUser()) return $redirect;
    
        $peminjamanModel = new PeminjamanModel();
        $ulasanModel     = new UlasanModel();
    
        $loansRaw = $peminjamanModel
            ->select('peminjaman.*, books.judul, books.cover, books.file_buku, books.penulis')
            ->join('books', 'books.book_id = peminjaman.book_id', 'left')
            ->where('peminjaman.user_id', $this->user->id)
            ->orderBy('peminjaman.tgl_pinjam', 'DESC')
            ->findAll();
    
        $loans = [];
        foreach ($loansRaw as $l) {
            $status = $l['status'] ?? 'Dipinjam';
            $hasReview = $ulasanModel->hasReview($this->user->id, $l['book_id']);
            $can_review = (!$hasReview && $status === 'Selesai');

            if ($status === 'Selesai' && $hasReview) continue;
    
            $loans[] = [
                'peminjaman_id' => $l['peminjaman_id'],
                'book_id'       => $l['book_id'],
                'judul'         => $l['judul'] ?? '-',
                'penulis'       => $l['penulis'] ?? '-',
                'cover'         => $l['cover'] ?? null,
                'file_buku'     => $l['file_buku'] ?? null,
                'tgl_pinjam'    => $l['tgl_pinjam'] ?? date('Y-m-d'),
                'tgl_kembali'   => $l['tgl_kembali'] ?? date('Y-m-d', strtotime($l['tgl_pinjam'] . ' +7 days')),
                'status'        => $status,
                'read_link'     => $l['file_buku'] ? base_url('user/file/book/' . $l['file_buku']) : null,
                'has_review'    => $hasReview,
                'can_review'    => $can_review,
            ];
        }
    
        return $this->parse('user/mybooks.tpl', [
            'base_url' => base_url(),
            'userName' => $this->user->username,
            'loans'    => $loans,
        ]);
    }

    // =================== Konfirmasi Selesai ===================
    public function konfirmasi($peminjamanId = null)
    {
        if ($redirect = $this->checkUser()) return $redirect;

        if (!$peminjamanId) {
            return redirect()->back()->with('error', 'Peminjaman tidak valid.');
        }

        $peminjamanModel = new PeminjamanModel();
        $loan = $peminjamanModel->find($peminjamanId);

        if (!$loan || $loan['user_id'] != $this->user->id) {
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
        }

        $peminjamanModel->update($peminjamanId, ['status' => 'Selesai']);

        return redirect()->to('/user/mybooks')->with('success', 'Buku berhasil dikonfirmasi selesai!');
    }

    // =================== Download Buku ===================
    public function serveBook($filename = null)
{
    $auth = service('auth');
    $user = $auth->user();
    if (!$user) return redirect()->to('/login')->with('error', 'Akses ditolak!');

    if (!$filename) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File tidak ditemukan');
    }

    $filePath = FCPATH . 'uploads/ebooks/' . $filename;

    if (!is_file($filePath)) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File tidak ditemukan');
    }

    // Buka langsung di browser (inline)
    return $this->response->setHeader('Content-Type', 'application/pdf')
                          ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
                          ->setBody(file_get_contents($filePath));
}

}
