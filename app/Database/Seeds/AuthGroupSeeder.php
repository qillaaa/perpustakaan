<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class AuthGroupSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();

        // 1️⃣ Buat user admin
        $admin = new User([
            'username' => 'qailla',
            'email'    => 'qaillaagnia@gmail.com',
            'password' => 'perpustakaan@2025',
        ]);
        $users->save($admin);

        $adminUser = $users->findById($users->getInsertID());
        $adminUser->addGroup('admin');

        // 2️⃣ Buat user biasa (pengguna)
        $user = new User([
            'username' => 'pengguna',
            'email'    => 'user@library.com',
            'password' => 'user123',
        ]);
        $users->save($user);

        $regularUser = $users->findById($users->getInsertID());
        $regularUser->addGroup('user');
    }
}
