<?php
namespace App\Models\User;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table      = 'peminjaman';
    protected $primaryKey = 'peminjaman_id';

    protected $allowedFields = [
        'user_id', 'book_id', 'tgl_pinjam', 'tgl_kembali', 'status'
    ];

    protected $returnType     = 'array';
    protected $useTimestamps  = false;

    /**
     * Tandai peminjaman selesai
     */
    public function setSelesai(int $peminjaman_id): bool
    {
        return $this->update($peminjaman_id, ['status' => 'Selesai']);
    }

    /**
     * Ambil semua peminjaman milik user tertentu
     */
    public function getLoansByUser(int $userId): array
    {
        return $this->select('peminjaman.*, books.book_id, books.judul, books.cover, books.file_buku, books.penulis')
                    ->join('books', 'books.book_id = peminjaman.book_id', 'left')
                    ->where('peminjaman.user_id', $userId) // filter hanya peminjaman user ini
                    ->orderBy('peminjaman.tgl_pinjam', 'DESC')
                    ->findAll();
    }
}
