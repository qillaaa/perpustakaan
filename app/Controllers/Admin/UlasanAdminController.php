<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User\UlasanModel;

class UlasanAdminController extends BaseController
{
    protected $ulasanModel;
    public $data = [];

    public function __construct()
    {
        $this->ulasanModel = new UlasanModel();
        $this->data['base_url'] = base_url();
    }

    public function index()
    {
        $this->data['title'] = 'Ulasan Buku';
        $q = $this->request->getGet('q');

        $builder = $this->ulasanModel
            ->select('ulasan.*, books.judul AS buku, users.username AS user')
            ->join('books', 'books.book_id = ulasan.book_id', 'left')
            ->join('users', 'users.id = ulasan.user_id', 'left')
            ->orderBy('ulasan.created_at', 'DESC');

        // Search
        if ($q) {
            $builder->groupStart()
                ->like('books.judul', $q)
                ->orLike('users.username', $q)
                ->orLike('ulasan.rating', $q)
                ->orLike('ulasan.created_at', $q)
                ->groupEnd();
        }

        $this->data['ulasan'] = $builder->findAll();
        $this->data['q'] = $q;

        return $this->parse('admin/ulasan/ulasan_list.tpl', $this->data);
    }
}
