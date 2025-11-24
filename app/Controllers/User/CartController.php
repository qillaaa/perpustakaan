<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User\CartModel;
use App\Models\Admin\BookModel;
use App\Models\User\PeminjamanModel;

class CartController extends BaseController
{
    protected $cartModel;
    protected $bookModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->bookModel = new BookModel();
    }

    // ===== Cek login user =====
    private function checkUser()
    {
        $auth = service('auth');
        $user = $auth->user();
        if (!$user) {
            return null;
        }
        return $user;
    }

    // 🧺 Tampilkan halaman keranjang
    public function index()
    {
        $user = $this->checkUser();
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $cartItems = $this->cartModel
            ->select('carts.*, books.judul, books.cover, books.penulis')
            ->join('books', 'books.book_id = carts.book_id', 'left')
            ->where('carts.user_id', $user->id)
            ->findAll();

        $data = [
            'title'     => 'Keranjang Saya',
            'base_url'  => base_url(),
            'user'      => [
                'id'       => $user->id,
                'username' => $user->username,
                'email'    => $user->email,
            ],
            'cartItems' => $cartItems,
        ];

        return $this->parse('user/cart.tpl', $data);
    }

    // ➕ Tambah ke keranjang
    public function add($book_id)
    {
        $user = $this->checkUser();
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $book = $this->bookModel->find($book_id);
        if (!$book) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        // Cek duplikat
        $existing = $this->cartModel
            ->where('user_id', $user->id)
            ->where('book_id', $book_id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Buku ini sudah ada di keranjangmu.');
        }

        $this->cartModel->insert([
            'user_id'    => $user->id,
            'book_id'    => $book_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    // ❌ Hapus satu item
    public function remove($cart_id)
    {
        $user = $this->checkUser();
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $item = $this->cartModel->find($cart_id);

        if ($item && $item['user_id'] == $user->id) {
            $this->cartModel->delete($cart_id);
            return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan.');
    }

    // 🧹 Kosongkan semua
    public function clear()
    {
        $user = $this->checkUser();
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $this->cartModel->where('user_id', $user->id)->delete();
        return redirect()->back()->with('success', 'Keranjang dikosongkan.');
    }

    // 🔹 Checkout semua isi keranjang
    public function checkout()
    {
        $user = $this->checkUser();
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $cartItems = $this->cartModel->where('user_id', $user->id)->findAll();
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjangmu masih kosong!');
        }

        $peminjamanModel = new PeminjamanModel();

        foreach ($cartItems as $item) {
            $book = $this->bookModel->find($item['book_id']);
            if (!$book) continue; // skip jika buku tidak ada
            if ($book['stok'] <= 0) continue; // skip jika stok habis

            $tglPinjam  = date('Y-m-d');
            $tglKembali = date('Y-m-d', strtotime($tglPinjam . ' +7 days'));

            $peminjamanModel->insert([
                'user_id'    => $user->id,
                'book_id'    => $item['book_id'],
                'tgl_pinjam' => $tglPinjam,
                'tgl_kembali'=> $tglKembali,
                'status'     => 'Dipinjam',
            ]);

            // Kurangi stok
            $this->bookModel->update($item['book_id'], ['stok' => $book['stok'] - 1]);
        }

        // Hapus semua isi keranjang
        $this->cartModel->where('user_id', $user->id)->delete();

        return redirect()->to('/user/dashboard')->with('success', 'Checkout berhasil! Buku berhasil dipinjam.');
    }
}
