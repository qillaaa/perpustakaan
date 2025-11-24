<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Database;
use CodeIgniter\Shield\Authentication\Passwords;

class AdminProfileController extends BaseController
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
        $auth = service('auth');
        $user = $auth->user();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Akses ditolak!');
        }

        // Ambil data user + role
        $builder = $this->db->table('users u')
            ->select('u.id, u.username, u.avatar_url, u.status_message, ag.name AS role')
            ->join('auth_groups_users agu', 'agu.user_id = u.id', 'left')
            ->join('auth_groups ag', 'ag.name = agu.group', 'left')
            ->where('u.id', $user->id);

        $this->data['user'] = $builder->get()->getRowArray();

        // Ambil email dari auth_identities
        $emailRow = $this->db->table('auth_identities')
        ->select('secret')
        ->where('user_id', $user->id)
        ->whereIn('type', ['email', 'email_password'])
        ->get()
        ->getRow();
    
    $this->data['user']['email'] = $emailRow ? $emailRow->secret : '';     

        // Ambil flashdata dari session
        $this->data['error'] = session()->getFlashdata('error');
        $this->data['success'] = session()->getFlashdata('success');

        $this->data['title'] = 'Profile Admin';

        return $this->parse('admin/admin_profile.tpl', $this->data);
    }

    public function update()
    {
        $auth = service('auth');
        $user = $auth->user();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Akses ditolak!');
        }

        $username = $this->request->getPost('username');
        $status_message = $this->request->getPost('status_message');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $updateData = [
            'username' => $username,
            'status_message' => $status_message,
        ];

        // Handle avatar upload
        $avatar = $this->request->getFile('avatar');
        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $newName = $avatar->getRandomName();
            $avatar->move(ROOTPATH . 'public/uploads', $newName);
            $updateData['avatar_url'] = base_url("uploads/$newName");
        }

        // Update users table
        $this->db->table('users')->where('id', $user->id)->update($updateData);

        // Update email di auth_identities
        $identityTable = $this->db->table('auth_identities');
        $identityTable->where('user_id', $user->id)->where('type', 'email')->update([
            'secret' => $email
        ]);

        // Update password jika diisi
        if ($password) {
            $passwordHasher = service('passwords'); // Shield Passwords service
            $hashedPassword = $passwordHasher->hash($password);

            $identityTable->where('user_id', $user->id)->where('type', 'password')->update([
                'secret' => $hashedPassword
            ]);
        }

        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
