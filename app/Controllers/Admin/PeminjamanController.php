<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class PeminjamanController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->data['base_url'] = base_url();
    }

    // 📄 List peminjaman dengan search
    public function index()
    {
        $q = $this->request->getGet('q'); // ambil keyword search
        $builder = $this->db->table('peminjaman p')
            ->select('p.peminjaman_id, u.username AS user_name, b.judul AS book_title, p.tgl_pinjam, p.tgl_kembali, p.status')
            ->join('users u', 'p.user_id = u.id')
            ->join('books b', 'p.book_id = b.book_id')
            ->orderBy('p.tgl_pinjam', 'DESC');

        if ($q) {
            $builder->groupStart()
                    ->like('u.username', $q)
                    ->orLike('b.judul', $q)
                    ->orLike('p.status', $q)
                    ->groupEnd();
        }

        $this->data['peminjaman'] = $builder->get()->getResultArray();
        $this->data['title'] = 'Data Peminjaman';
        $this->data['q'] = $q;

        return $this->parse('admin/peminjaman/peminjaman.tpl', $this->data);
    }

    // ➕ Pinjam buku (stok otomatis berkurang)
    public function pinjam($book_id)
    {
        $user_id = session()->get('user_id'); // misal user login
        $tgl_pinjam = date('Y-m-d');

        // Ambil data buku
        $book = $this->db->table('books')->where('book_id', $book_id)->get()->getRowArray();
        if (!$book) {
            session()->setFlashdata('error', 'Buku tidak ditemukan!');
            return redirect()->to(base_url('admin/books'));
        }
        if ($book['stok'] < 1) {
            session()->setFlashdata('error', 'Stok buku habis!');
            return redirect()->to(base_url('admin/books'));
        }

        // Simpan peminjaman
        $this->db->table('peminjaman')->insert([
            'user_id' => $user_id,
            'book_id' => $book_id,
            'tgl_pinjam' => $tgl_pinjam,
            'status' => 'Dipinjam'
        ]);

        // Kurangi stok buku
        $this->db->table('books')->update(
            ['stok' => $book['stok'] - 1],
            ['book_id' => $book_id]
        );

        session()->setFlashdata('success', '📗 Buku berhasil dipinjam!');
        return redirect()->to(base_url('admin/books'));
    }

    // 🔄 Kembalikan buku (stok otomatis bertambah)
    public function kembalikan($id)
    {
        $tgl_kembali = date('Y-m-d');

        // Ambil data peminjaman
        $peminjaman = $this->db->table('peminjaman')->where('peminjaman_id', $id)->get()->getRowArray();
        if (!$peminjaman || $peminjaman['status'] == 'Dikembalikan') {
            session()->setFlashdata('error', 'Buku sudah dikembalikan atau data tidak ditemukan.');
            return redirect()->to(base_url('admin/peminjaman'));
        }

        // Update status peminjaman
        $this->db->table('peminjaman')->update(
            ['status' => 'Dikembalikan', 'tgl_kembali' => $tgl_kembali],
            ['peminjaman_id' => $id]
        );

        // Tambahkan stok buku
        $this->db->table('books')
            ->set('stok', 'stok+1', false)
            ->where('book_id', $peminjaman['book_id'])
            ->update();

        session()->setFlashdata('success', '📗 Buku berhasil dikembalikan!');
        return redirect()->to(base_url('admin/peminjaman'));
    }
}
