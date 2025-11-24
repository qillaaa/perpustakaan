<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Traits\Viewable;
use App\Libraries\CISmarty;
use Config\Services;
use App\Models\User\CartModel;

abstract class BaseController extends Controller
{
    use Viewable;

    protected $request;
    public $data = [];
    protected ?CISmarty $smartyEngine = null;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Tambahkan helper
        $this->helpers = array_merge($this->helpers ?? [], ['setting']);

        // Tambahkan CSRF header jika bukan CLI
        if (!is_cli()) {
            $response = $response->appendHeader(csrf_header(), csrf_hash());
        }

        // Ambil flashdata dari session
        $this->data['error']   = session()->getFlashdata('error');
        $this->data['warning'] = session()->getFlashdata('warning');
        $this->data['message'] = session()->getFlashdata('message');

        // 🛡️ Ambil data user login
        $auth = service('auth');
        $user = $auth->user();

        $this->data['userdata']   = $user;
        $this->data['isLoggedIn'] = $auth->loggedIn();
        $this->data['userName']   = $user ? ($user->username ?? $user->email ?? 'Pengguna') : 'Tamu';

        // 🛒 Ambil jumlah item keranjang
        $cartCount = 0;
        if ($user) {
            $cartModel = new CartModel();
            $cartCount = $cartModel->where('user_id', $user->id)->countAllResults();
        }
        $this->data['cart_count'] = $cartCount;

        // 🧡 Ambil jumlah buku favorit
        $favCount = 0;
        if ($user) {
            $favModel = new \App\Models\User\FavoriteModel();
            $favCount = $favModel->where('user_id', $user->id)->countAllResults();
        }
        $this->data['fav_count'] = $favCount;

        // ✅ Assign variabel global ke semua view Smarty
        $smarty = $this->getSmartyEngine();
        $smarty->assign([
            'userName'   => $this->data['userName'],
            'isLoggedIn' => $this->data['isLoggedIn'],
            'userdata'   => $this->data['userdata'],
            'cart_count' => $this->data['cart_count'],
            'fav_count'  => $this->data['fav_count'],
        ]);

        // Ambil segmen URL aktif untuk navigasi atau breadcrumb
        $uri = current_url(true);
        $this->data['segments'] = $uri->getSegments();
    }

    public function setWarning(string $warning)
    {
        $this->data['warning'] = $warning;
        session()->setFlashdata('warning', $warning);
    }

    public function setMessage(string $message)
    {
        $this->data['message'] = $message;
        session()->setFlashdata('message', $message);
    }

    public function setError(string $error)
    {
        $this->data['error'] = $error;
        session()->setFlashdata('error', $error);
    }

    protected function getSmartyEngine(): CISmarty
    {
        if ($this->smartyEngine === null) {
            $this->smartyEngine = Services::smarty();
        }
        return $this->smartyEngine;
    }
}
                                                                                     