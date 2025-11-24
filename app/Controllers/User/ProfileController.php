<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $auth = service('auth');
        $this->user = $auth->user();
    }

    public function index()
    {
        if (!$this->user) return redirect()->to('/login')->with('error','Silakan login!');

        return $this->parse('user/profile.tpl', [
            'title' => 'Profil Saya',
            'user'  => [
                'id'         => $this->user->id,
                'username'   => $this->user->username,
                'email'      => $this->user->email,
                'avatar_url' => $this->user->avatar_url,
                'created_at' => $this->user->created_at,
            ],
            'error'   => session()->getFlashdata('error'),
            'message' => session()->getFlashdata('message'),
        ]);
    }

    public function update()
    {
        if (!$this->user) return redirect()->to('/login')->with('error','Silakan login!');

        $post   = $this->request->getPost();
        $avatar = $this->request->getFile('avatar');

        // Update username & email
        $this->user->username = $post['username'];
        $this->user->email    = $post['email'];

        // Update password jika diisi
        if (!empty($post['password'])) {
            $this->user->password = password_hash($post['password'], PASSWORD_DEFAULT);
        }

        // Upload avatar
        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/avatars/';
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

            $filename = $avatar->getRandomName();
            $avatar->move($uploadPath, $filename);
            $this->user->avatar_url = 'uploads/avatars/' . $filename;
        }

        // Simpan ke DB
        $userModel = model('UserModel');
        $userModel->save([
            'id'         => $this->user->id,
            'username'   => $this->user->username,
            'email'      => $this->user->email,
            'password'   => $this->user->password,
            'avatar_url' => $this->user->avatar_url,
        ]);

        return redirect()->to('/user/profile')->with('message','Profil berhasil diperbarui.');
    }
}
