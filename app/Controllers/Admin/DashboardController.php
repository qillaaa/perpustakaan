<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BookModel;
use App\Models\Admin\CategoryModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $auth = service('auth');
        $user = $auth->user();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!$user->inGroup('admin')) {
            return redirect()->to('/login')->with('error', 'Akses ditolak! Hanya admin.');
        }

        $db = \Config\Database::connect();
        $bookModel = new BookModel();
        $categoryModel = new CategoryModel();

        // Statistik buku
        $totalBooks = $bookModel->countAll();
        $stokResult = $bookModel->selectSum('stok')->first();
        $totalStock = (int)($stokResult['stok'] ?? 0);
        $totalCategories = $categoryModel->countAll();

        // --- Hitung total pengguna kecuali admin ---
        $totalUsers = $db->table('auth_groups_users ag')
            ->join('users u', 'u.id = ag.user_id', 'left')
            ->where('ag.group !=', 'admin')
            ->countAllResults();

        // Buku favorit per kategori (Dipinjam)
        $favQuery = $db->table('peminjaman p')
            ->select('c.nama_kategori, COUNT(p.peminjaman_id) AS total')
            ->join('books b', 'b.book_id = p.book_id', 'left')
            ->join('categories c', 'c.kategori_id = b.kategori_id', 'left')
            ->where('p.status', 'Dipinjam')
            ->groupBy('c.kategori_id')
            ->get()
            ->getResultArray();

        $favoriteCategoryLabels = [];
        $favoriteCategoryCounts = [];

        foreach ($favQuery as $row) {
            $favoriteCategoryLabels[] = $row['nama_kategori'] ?? 'Tidak ada data';
            $favoriteCategoryCounts[] = (int)($row['total'] ?? 0);
        }

        if (empty($favoriteCategoryLabels)) {
            $favoriteCategoryLabels = ['Tidak ada data'];
            $favoriteCategoryCounts = [0];
        }

        // Peminjaman mingguan (4 minggu terakhir)
        $weekLabels = [];
        $weekBorrowers = [];
        for ($i = 3; $i >= 0; $i--) {
            $monday = strtotime("monday -$i week");
            $sunday = strtotime("+6 days", $monday);

            $start = date('Y-m-d', $monday);
            $end = date('Y-m-d', $sunday);

            $count = $db->table('peminjaman')
                        ->where('tgl_pinjam >=', $start)
                        ->where('tgl_pinjam <=', $end)
                        ->countAllResults();

            $weekLabels[] = date('d M', $monday) . ' - ' . date('d M', $sunday);
            $weekBorrowers[] = $count;
        }

        return $this->parse('admin/dashboard.tpl', [
            'title' => 'Dashboard Admin',
            'base_url' => base_url(),
            'userName' => $user->username ?? 'Guest',
            'isLoggedIn' => true,
            'totalBooks' => $totalBooks,
            'totalStock' => $totalStock,
            'totalCategories' => $totalCategories,
            'totalUsers' => $totalUsers,
            'favoriteCategoryLabels' => $favoriteCategoryLabels,
            'favoriteCategoryCounts' => $favoriteCategoryCounts,
            'weekLabels' => $weekLabels,
            'weekBorrowers' => $weekBorrowers,
        ]);
    }
}
