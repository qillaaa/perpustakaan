<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'book_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'deskripsi',
        'file_buku',
        'cover',
        'stok',
    ];

    // ⏱ Tidak pakai timestamps otomatis (biarkan database handle tgl_ditambahkan)
    protected $useTimestamps = false;

    // 🧩 Kalau nanti kamu mau aktifkan timestamps custom:
    /*
    protected $useTimestamps = true;
    protected $createdField  = 'tgl_ditambahkan';
    protected $updatedField  = null; // karena tidak ada kolom updated_at
    */

    // 🧠 Tambahan opsional (biar gampang ambil data + kategori)
    public function getAllBooks()
    {
        return $this->select('books.*, categories.nama_kategori AS kategori')
                    ->join('categories', 'categories.kategori_id = books.kategori_id', 'left')
                    ->orderBy('book_id', 'DESC')
                    ->findAll();
    }
}
