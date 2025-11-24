<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'kategori_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nama_kategori',
    ];

    // Karena tabel tidak memiliki kolom created_at / updated_at
    protected $useTimestamps = false;

    // Tambahan opsional untuk ambil semua kategori dengan urutan terbaru
    public function getAllCategories()
    {
        return $this->orderBy('kategori_id', 'DESC')->findAll();
    }
}
