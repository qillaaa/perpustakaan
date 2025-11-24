<?php

namespace App\Authentication;

use CodeIgniter\Shield\Authentication\LoginResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Entities\User;

class LoginResponse implements LoginResponseInterface
{
    public function redirect(User $user): RedirectResponse
    {
        // Redirect sesuai role Shield
        if ($user->inGroup('admin')) {
            return redirect()->to('/admin/dashboard');
        }

        if ($user->inGroup('user')) {
            return redirect()->to('/user/dashboard');
        }

        // fallback jika role tidak dikenal
        return redirect()->to('/');
    }
}
