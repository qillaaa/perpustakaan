<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BookModel;
use App\Models\Admin\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Database;

class BookController extends BaseController
{
    protected $bookModel;
    protected $categoryModel;
    protected $db;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->categoryModel = new CategoryModel();
        $this->db = Database::connect();
        $this->data['base_url'] = base_url();
    }

    // 📚 List semua buku dengan search dan stok real-time
    public function index()
{
    $this->data['title'] = 'Data Buku';
    $q = $this->request->getGet('q');

    // Ambil buku + kategori + jumlah buku yang sedang dipinjam
    $builder = $this->bookModel
        ->select('books.*, categories.nama_kategori AS kategori, 
                  (SELECT COUNT(*) FROM peminjaman p WHERE p.book_id = books.book_id AND p.status="Dipinjam") AS dipinjam')
        ->join('categories', 'categories.kategori_id = books.kategori_id', 'left')
        ->orderBy('books.book_id', 'DESC');

    if ($q) {
        $builder->groupStart()
                ->like('books.judul', $q)
                ->orLike('books.penulis', $q)
                ->orLike('books.penerbit', $q)
                ->orLike('categories.nama_kategori', $q)
                ->orLike('books.tahun_terbit', $q)
                ->orLike('books.deskripsi', $q)
                ->orLike('books.stok', $q)
                ->groupEnd();
    }

    $books = $builder->findAll();

    // Hitung stok tersisa
    foreach ($books as &$book) {
        $book['stok_sisa'] = max($book['stok'] - $book['dipinjam'], 0);
    }

    $this->data['books'] = $books;
    $this->data['q'] = $q;
    $this->data['success'] = session()->getFlashdata('success');

    return $this->parse('admin/books/books.tpl', $this->data);
}

    // ➕ Form tambah buku
    public function create()
    {
        $this->data['title'] = 'Tambah Buku';
        $this->data['categories'] = $this->categoryModel->findAll();
        return $this->parse('admin/books/books_form.tpl', $this->data);
    }

    // 💾 Simpan buku baru
    public function store()
    {
        $data = [
            'judul'        => $this->request->getPost('judul'),
            'penulis'      => $this->request->getPost('penulis'),
            'penerbit'     => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'kategori_id'  => $this->request->getPost('kategori_id'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'stok'         => $this->request->getPost('stok') ?? 1,
        ];

        // Upload file buku
        $fileBuku = $this->request->getFile('file_buku');
        if ($fileBuku && $fileBuku->isValid()) {
            $fileName = $fileBuku->getRandomName();
            $fileBuku->move(FCPATH . 'uploads/ebooks', $fileName);
            $data['file_buku'] = $fileName;
        }

        // Upload cover
        $cover = $this->request->getFile('cover');
        if ($cover && $cover->isValid()) {
            $coverName = $cover->getRandomName();
            $cover->move(FCPATH . 'uploads/covers', $coverName);
            $data['cover'] = $coverName;
        }

        $this->bookModel->insert($data);
        return redirect()->to(base_url('admin/books'))->with('success', '📘 Buku berhasil ditambahkan!');
    }

    // ✏️ Form edit buku
    public function edit($id)
    {
        $book = $this->bookModel->find($id);
        if (!$book) throw new PageNotFoundException("Buku tidak ditemukan.");

        $this->data['title'] = 'Edit Buku';
        $this->data['book'] = $book;
        $this->data['categories'] = $this->categoryModel->findAll();
        return $this->parse('admin/books/books_form.tpl', $this->data);
    }

    // 🔄 Update buku
    public function update($id)
    {
        $data = [
            'judul'        => $this->request->getPost('judul'),
            'penulis'      => $this->request->getPost('penulis'),
            'penerbit'     => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'kategori_id'  => $this->request->getPost('kategori_id'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'stok'         => $this->request->getPost('stok') ?? 1,
        ];

        // Upload file baru jika ada
        $fileBuku = $this->request->getFile('file_buku');
        if ($fileBuku && $fileBuku->isValid()) {
            $fileName = $fileBuku->getRandomName();
            $fileBuku->move(FCPATH . 'uploads/ebooks', $fileName);
            $data['file_buku'] = $fileName;
        }

        // Upload cover baru jika ada
        $cover = $this->request->getFile('cover');
        if ($cover && $cover->isValid()) {
            $coverName = $cover->getRandomName();
            $cover->move(FCPATH . 'uploads/covers', $coverName);
            $data['cover'] = $coverName;
        }

        $this->bookModel->update($id, $data);
        return redirect()->to(base_url('admin/books'))->with('success', '✏️ Buku berhasil diperbarui!');
    }

    // 🗑️ Hapus buku
    public function delete($id)
    {
        $book = $this->bookModel->find($id);
        if ($book) {
            if (!empty($book['file_buku']) && file_exists(FCPATH . 'uploads/ebooks/' . $book['file_buku'])) {
                unlink(FCPATH . 'uploads/ebooks/' . $book['file_buku']);
            }
            if (!empty($book['cover']) && file_exists(FCPATH . 'uploads/covers/' . $book['cover'])) {
                unlink(FCPATH . 'uploads/covers/' . $book['cover']);
            }

            $this->bookModel->delete($id);
        }

        return redirect()->to(base_url('admin/books'))->with('success', '🗑️ Buku berhasil dihapus!');
    }
}
