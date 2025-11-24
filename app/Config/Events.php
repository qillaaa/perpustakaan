<?php

namespace Config;

use CodeIgniter\Events\Events;

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files.
 */

// Pre-system event tetap sama
Events::on('pre_system', static function (): void {
    if (ENVIRONMENT !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw \CodeIgniter\Exceptions\FrameworkException::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(static fn($buffer) => $buffer);
    }

    if (CI_DEBUG && !is_cli()) {
        Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
        service('toolbar')->respond();
    }
});

// 🛡️ Shield: redirect setelah login **gunakan LoginResponse**, bukan langsung di event
// Event ini sekarang hanya untuk logging atau tindakan ringan
Events::on('login', function ($user) {
    if (!$user) return;

    $session = service('session');

    // Hapus redirect_url lama dari session
    if ($session->has('redirect_url')) {
        $session->remove('redirect_url');
    }

    // **Tidak melakukan redirect di sini!**
    // Redirect sekarang ditangani oleh App\Authentication\LoginResponse
});
