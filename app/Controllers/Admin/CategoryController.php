<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CategoryController extends BaseController
{
    public $data = [];
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->data['base_url'] = base_url();
    }

    public function index()
    {
        $this->data['title'] = 'Data Kategori Buku';

        $q = $this->request->getGet('q');

        $builder = $this->categoryModel->db->table('categories c')
            ->select('c.kategori_id, c.nama_kategori, COUNT(b.book_id) AS jumlah_buku, COALESCE(SUM(b.stok),0) AS total_stok')
            ->join('books b', 'b.kategori_id = c.kategori_id', 'left')
            ->groupBy('c.kategori_id, c.nama_kategori')
            ->orderBy('c.nama_kategori', 'ASC');

        if ($q) {
            if (is_numeric($q)) {
                // jika angka, search berdasarkan jumlah buku atau total stok
                $builder->having('COUNT(b.book_id)', $q);
                // alternatif: $builder->having('COALESCE(SUM(b.stok),0)', $q);
            } else {
                // jika teks, search nama kategori
                $builder->like('c.nama_kategori', $q);
            }
        }

        $this->data['categories'] = $builder->get()->getResultArray();
        $this->data['q'] = $q;
        $this->data['success'] = session()->getFlashdata('success');

        return $this->parse('admin/categories/categories.tpl', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Tambah Kategori';
        return $this->parse('admin/categories/categories_form.tpl', $this->data);
    }

    public function store()
    {
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        $this->categoryModel->insert($data);
        return redirect()->to(base_url('admin/categories'))->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            throw new PageNotFoundException("Kategori tidak ditemukan");
        }

        $this->data['title'] = 'Edit Kategori';
        $this->data['category'] = $category;
        return $this->parse('admin/categories/categories_form.tpl', $this->data);
    }

    public function update($id)
    {
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        $this->categoryModel->update($id, $data);
        return redirect()->to(base_url('admin/categories'))->with('success', 'Kategori berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to(base_url('admin/categories'))->with('success', 'Kategori berhasil dihapus!');
    }
}
