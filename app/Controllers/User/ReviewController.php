<?php 
namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User\UlasanModel;
use App\Models\User\PeminjamanModel;

class ReviewController extends BaseController
{
    protected $ulasanModel;
    protected $peminjamanModel;

    public function __construct()
    {
        $this->ulasanModel     = new UlasanModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    private function getUser()
    {
        $user = auth()->user(); // Shield
        if (!$user) {
            return redirect()->to('/login')->with('error','Silakan login!');
        }
        return $user;
    }

    public function index()
{
    $user = $this->getUser();
    if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

    $q = $this->request->getGet('q'); // input search dari query string

    // Ambil semua ulasan user
    $rawReviews = $this->ulasanModel->getUserReviews($user->id) ?? [];
    $reviewedBookIds = array_column($rawReviews, 'book_id');

    // Ambil semua buku yang selesai dipinjam
    $borrowedBooksRaw = $this->peminjamanModel
        ->select('peminjaman.*, books.book_id, books.judul, books.cover')
        ->join('books', 'books.book_id = peminjaman.book_id')
        ->where('peminjaman.user_id', $user->id)
        ->where('peminjaman.status', 'Selesai')
        ->orderBy('tgl_pinjam','DESC')
        ->findAll();

    $borrowedBooks = [];
    foreach ($borrowedBooksRaw as $b) {
        $hasReview = in_array($b['book_id'], $reviewedBookIds);

        $borrowedBooks[] = [
            'peminjaman_id' => $b['peminjaman_id'],
            'book_id'       => $b['book_id'],
            'judul'         => $b['judul'] ?? '-',
            'cover'         => $b['cover'] ?? null,
            'tgl_pinjam'    => $b['tgl_pinjam'] ?? null,
            'tgl_kembali'   => $b['tgl_kembali'] ?? null,
            'can_review'    => !$hasReview,
            'review_status' => $hasReview ? 'Sudah Diulas' : 'Belum Diulas'
        ];
    }

    // Filter jika ada query search
    if ($q) {
        $qLower = mb_strtolower($q);
        $borrowedBooks = array_filter($borrowedBooks, function($b) use ($qLower) {
            return mb_stripos($b['judul'], $qLower) !== false
                || mb_stripos($b['tgl_pinjam'], $qLower) !== false
                || mb_stripos($b['tgl_kembali'], $qLower) !== false
                || mb_stripos($b['review_status'], $qLower) !== false;
        });
    }

    return $this->parse('user/reviews.tpl', [
        'title'         => 'Buku Selesai & Ulasan',
        'base_url'      => base_url(),
        'borrowedBooks' => $borrowedBooks,
        'reviews'       => $rawReviews,
        'userName'      => $user->username, // dikirim ke template
        'search'        => $q
    ]);
}

    public function add($peminjaman_id = null)
    {
        $user = $this->getUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        if (!$peminjaman_id) return redirect()->back()->with('error','Peminjaman tidak ditemukan!');

        $borrow = $this->peminjamanModel
            ->select('peminjaman.*, books.book_id, books.judul, books.cover')
            ->join('books', 'books.book_id = peminjaman.book_id', 'left')
            ->where('peminjaman.peminjaman_id', $peminjaman_id)
            ->where('peminjaman.user_id', $user->id)
            ->where('peminjaman.status', 'Selesai')
            ->first();

        if (!$borrow) return redirect()->back()->with('error','Peminjaman tidak ditemukan atau belum selesai!');

        if ($this->ulasanModel->hasReview($user->id, $borrow['book_id'])) {
            return redirect()->to('/user/reviews')->with('info','Buku ini sudah diulas!');
        }

        return $this->parse('user/review_add.tpl', [
            'title'        => 'Tambah Ulasan',
            'base_url'     => base_url(),
            'peminjaman_id'=> $peminjaman_id,
            'book_id'      => $borrow['book_id'],
            'book_title'   => $borrow['judul'],
            'book_cover'   => $borrow['cover'] ?? base_url('assets/img/no-cover.png')
        ]);
    }

    public function save()
    {
        $user = $this->getUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $post = $this->request->getPost();
        $book_id = $post['book_id'] ?? null;
        if (!$book_id) return redirect()->back()->with('error', 'Buku tidak valid!');

        $rating = (int) ($post['rating'] ?? 0);
        if ($rating < 1 || $rating > 5) return redirect()->back()->with('error', 'Rating harus antara 1 sampai 5!');

        $komentar = trim($post['komentar'] ?? '');

        $this->ulasanModel->insert([
            'user_id'    => $user->id,
            'book_id'    => $book_id,
            'rating'     => $rating,
            'komentar'   => $komentar,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/user/reviews')->with('success', 'Ulasan berhasil ditambahkan!');
    }
}
