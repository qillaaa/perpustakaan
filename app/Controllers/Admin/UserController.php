<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;

class UserController extends BaseController
{
    protected $db;
    public $data = [];

    public function __construct()
    {
        $this->db = Database::connect();
        $this->data['base_url'] = base_url();
    }

    public function index()
    {
        $q = $this->request->getGet('q');

        $builder = $this->db->table('users u')
            ->select('u.id, u.username, u.avatar_url, u.active, ag.name AS role,
                     COUNT(p.peminjaman_id) AS total_pinjam')
            ->join('auth_groups_users agu', 'agu.user_id = u.id', 'left')
            ->join('auth_groups ag', 'ag.name = agu.group', 'left')
            ->join('peminjaman p', 'p.user_id = u.id AND p.status = "Dipinjam"', 'left')
            ->groupBy('u.id, u.username, u.avatar_url, u.active, ag.name');

        // Search
        if ($q) {
            $builder->groupStart()
                ->like('u.username', $q)
                ->orLike('ag.name', $q)
                ->groupEnd();
        }

        // Hapus admin
        $builder->where('ag.name !=', 'admin');

        $this->data['users'] = $builder->get()->getResultArray();
        $this->data['title'] = 'Daftar Pengguna';
        $this->data['q'] = $q;

        return $this->parse('admin/users.tpl', $this->data);
    }
}
