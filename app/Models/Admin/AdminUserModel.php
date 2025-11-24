<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function getAllUsers()
    {
        return $this->select('users.id, users.username, users.active, users.created_at,
        auth_groups_users.group AS role,
        COUNT(peminjaman.peminjaman_id) AS total_pinjam')
->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
->join('peminjaman', 'peminjaman.user_id = users.id AND peminjaman.status = "Dipinjam"', 'left')
->groupBy('users.id, users.username, users.active, users.created_at, auth_groups_users.group')
->having('role =', 'user') // <-- hanya tampilkan user biasa
->orderBy('users.id', 'ASC')
->findAll();
    }
}
