<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User\FavoriteModel;

class FavoriteController extends BaseController
{
    protected $user;
    protected $favModel;

    public function __construct()
    {
        $auth = service('auth');
        $this->user = $auth->user();
        $this->favModel = new FavoriteModel();
    }

    public function index()
    {
        if (!$this->user) return redirect()->to('/login');

        $table = $this->favModel->table;

        $favorites = $this->favModel
            ->select("$table.*, books.book_id, books.judul, books.cover, books.penulis")
            ->join('books', 'books.book_id = ' . $table . '.book_id', 'left')
            ->where($table . '.user_id', $this->user->id)
            ->orderBy($table . '.created_at', 'DESC')
            ->findAll();

        $favBooks = [];
        foreach ($favorites as $f) {
            $favBooks[] = [
                'book_id' => $f['book_id'] ?? null,
                'judul'   => $f['judul'] ?? '-',
                'penulis' => $f['penulis'] ?? '-',
                'cover'   => !empty($f['cover'])
                             ? base_url('uploads/covers/' . $f['cover'])
                             : base_url('assets/img/no-cover.png'),
                'added_at'=> isset($f['created_at']) ? date('d M Y', strtotime($f['created_at'])) : '-',
            ];
        }

        return $this->parse('user/favorites.tpl', [
            'favorites' => $favBooks,
            'userName'  => $this->user->username,
        ]);
    }

    public function remove($bookId = null)
    {
        if (!$this->user) return redirect()->to('/login');
        if (!$bookId) return redirect()->to('/user/favorites')->with('error', 'Buku favorit tidak valid.');

        $this->favModel->where('user_id', $this->user->id)
                       ->where('book_id', $bookId)
                       ->delete();

        return redirect()->to('/user/favorites')->with('success', 'Buku dihapus dari favorit.');
    }
}
