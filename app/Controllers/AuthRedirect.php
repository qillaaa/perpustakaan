<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthRedirect extends Controller
{
    public function afterLogin()
    {
        $session = session();
        $auth    = service('auth');
        $user    = $auth->user();

        // 🔒 Kalau belum login
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Hapus tempdata sebelum redirect
        $session->removeTempdata('beforeLoginUrl');

        // 🔥 Cek grup berdasarkan nama di tabel auth_groups
        if ($user->inGroup('admin')) {
            return redirect()->to('/admin/dashboard');
        }

        if ($user->inGroup('user')) {  
            return redirect()->to('/user/dashboard');
        }

        // Role tidak dikenal → logout & redirect ke login
        $auth->logout();
        return redirect()->to('/login')->with('error', 'Akses ditolak. Role tidak valid.');
    }
}
