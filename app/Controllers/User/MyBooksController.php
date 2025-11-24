<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User\PeminjamanModel;
use App\Models\User\UlasanModel;
use App\Models\Admin\BookModel;

class MyBooksController extends BaseController
{
    protected $auth;
    protected $user;
    protected $peminjamanModel;
    protected $ulasanModel;
    protected $bookModel;

    public function __construct()
    {
        $this->auth = service('auth');
        $this->user = $this->auth->user();
        $this->peminjamanModel = new PeminjamanModel();
        $this->ulasanModel     = new UlasanModel();
        $this->bookModel       = new BookModel();
    }

    private function checkUser()
    {
        if (!$this->user) {
            return redirect()->to('/login')->with('error', 'Akses ditolak! Silakan login.');
        }
    }

    public function index()
    {
        if ($redirect = $this->checkUser()) return $redirect;

        $keyword = $this->request->getGet('q');

        // Ambil semua peminjaman user
        $loansQuery = $this->peminjamanModel
            ->select('peminjaman.*, books.book_id, books.judul, books.cover, books.file_buku, books.penulis, books.stok, categories.nama_kategori')
            ->join('books', 'books.book_id = peminjaman.book_id', 'left')
            ->join('categories', 'categories.kategori_id = books.kategori_id', 'left')
            ->where('peminjaman.user_id', $this->user->id)
            ->orderBy('peminjaman.tgl_pinjam', 'DESC');

        if ($keyword) {
            $loansQuery->groupStart()
                       ->like('books.judul', $keyword)
                       ->orLike('categories.nama_kategori', $keyword)
                       ->groupEnd();
        }

        $loansRaw = $loansQuery->findAll();

        $loans = [];
        $userBookIds = [];
        foreach ($loansRaw as $l) {
            $tgl_pinjam  = $l['tgl_pinjam'] ?? date('Y-m-d');
            $tgl_kembali = $l['tgl_kembali'] ?? date('Y-m-d', strtotime($tgl_pinjam . ' +7 days'));
            $status      = $l['status'] ?? 'Dipinjam';

            $hasReview   = !empty($l['book_id']) ? $this->ulasanModel->hasReview($this->user->id, $l['book_id']) : false;
            $can_review  = ($status === 'Selesai' && !$hasReview);

            if ($status === 'Selesai' && !$can_review) continue;

            $loans[] = [
                'peminjaman_id' => $l['peminjaman_id'] ?? 0,
                'book_id'       => $l['book_id'] ?? 0,
                'judul'         => $l['judul'] ?? '-',
                'penulis'       => $l['penulis'] ?? '-',
                'kategori'      => $l['nama_kategori'] ?? '-',
                'cover'         => $l['cover'] ?? null,
                'file_buku'     => ($status !== 'Selesai') ? ($l['file_buku'] ?? null) : null,
                'tgl_pinjam'    => $tgl_pinjam,
                'tgl_kembali'   => $tgl_kembali,
                'status'        => $status,
                'read_link'     => ($status !== 'Selesai' && !empty($l['file_buku'])) ? base_url('user/file/book/' . $l['file_buku']) : null,
                'has_review'    => $hasReview,
                'can_review'    => $can_review,
            ];

            $userBookIds[] = $l['book_id'];
        }

        // Ambil buku populer (tidak termasuk buku user)
        $popularBooksRaw = $this->bookModel
                                ->select('books.*, COUNT(peminjaman.peminjaman_id) as total_pinjam')
                                ->join('peminjaman', 'peminjaman.book_id = books.book_id', 'left')
                                ->groupBy('books.book_id')
                                ->orderBy('total_pinjam', 'DESC')
                                ->limit(6)
                                ->get()
                                ->getResultArray();

        $popularBooks = [];
        foreach ($popularBooksRaw as $b) {
            if (!in_array($b['book_id'], $userBookIds)) {
                $popularBooks[] = $b;
            }
        }

        return $this->parse('user/mybooks.tpl', [
            'title'        => 'Buku Saya',
            'base_url'     => base_url(),
            'loans'        => $loans,
            'popularBooks' => $popularBooks,
            'userName'     => $this->user->username ?? 'User',
            'search'       => $keyword,
        ]);
    }

    public function konfirmasi($peminjaman_id = null)
    {
        if ($redirect = $this->checkUser()) return $redirect;
    
        if (!$peminjaman_id) {
            return redirect()->back()->with('error', 'Peminjaman tidak valid.');
        }
    
        $pinjam = $this->peminjamanModel
                       ->where('peminjaman_id', $peminjaman_id)
                       ->where('user_id', $this->user->id)
                       ->first();
    
        if (!$pinjam) {
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan!');
        }
    
        // Update status dan TANGGAL KEMBALI = hari ini
        $this->peminjamanModel->update($peminjaman_id, [
            'status'      => 'Selesai',
            'tgl_kembali' => date('Y-m-d')
        ]);
    
        // Tambahkan stok kembali
        $book_id = $pinjam['book_id'];
        $book = $this->bookModel->find($book_id);
        if($book){
            $this->bookModel->update($book_id, ['stok' => $book['stok'] + 1]);
        }
    
        return redirect()->back()->with('success', 'Peminjaman selesai, tanggal kembali telah diperbarui!');
    }    

    // Contoh metode pinjam buku baru (stok otomatis berkurang)
    public function borrow($book_id = null)
    {
        if ($redirect = $this->checkUser()) return $redirect;

        if (!$book_id) return redirect()->back()->with('error', 'Buku tidak ditemukan!');

        $book = $this->bookModel->find($book_id);
        if (!$book || $book['stok'] <= 0) {
            return redirect()->back()->with('error', 'Buku sedang habis stok!');
        }

        // Kurangi stok
        $this->bookModel->update($book_id, ['stok' => $book['stok'] - 1]);

        // Simpan peminjaman
        $this->peminjamanModel->insert([
            'user_id' => $this->user->id,
            'book_id' => $book_id,
            'tgl_pinjam' => date('Y-m-d'),
            'status' => 'Dipinjam'
        ]);

        return redirect()->to('/user/mybooks')->with('success', 'Buku berhasil dipinjam!');
    }
}
