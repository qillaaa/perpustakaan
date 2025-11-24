<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="{$base_url}assets/img/favicon.png">
  <title>{$title|escape}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />

  <!-- CSS -->
  <link href="{$base_url}assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{$base_url}assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="{$base_url}assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

  <style>
    /* ==========================
       FIX WARNA TULISAN DAN ICON
       ========================== */
    .sidenav .nav-link,
    .sidenav .nav-link .material-symbols-rounded {
      color: #344767 !important;
      font-weight: 600 !important;
    }

    .sidenav .nav-link.active,
    .sidenav .nav-link.active .material-symbols-rounded {
      color: #fff !important;
    }

    .sidenav .nav-link:hover,
    .sidenav .nav-link:hover .material-symbols-rounded {
      color: #111 !important;
    }

    .sidenav { border-right: 1px solid #e5e5e5; }

    #sidenav-main {
      transition: width .35s ease, transform .35s ease;
      overflow: hidden;
    }

    body.sidebar-collapsed #sidenav-main { width: 80px !important; }
    body.sidebar-collapsed #sidenav-main .nav-link-text,
    body.sidebar-collapsed #sidenav-main .navbar-brand span { opacity: 0; visibility: hidden; }

    .main-content { transition: margin-left .35s ease; }
    body.sidebar-collapsed .main-content { margin-left: 100px !important; }

    @media(max-width:991px) {
      body.sidebar-show #sidenav-main { transform: translateX(0); }
      body.sidebar-hidden #sidenav-main { transform: translateX(-110%); }
      #sidenav-main { position: fixed; z-index: 9999; }
    }

    #sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,.45);
      z-index: 9998;
    }
    body.sidebar-show #sidebar-overlay { display: block; }

    .navbar .nav-link,
    .navbar strong,
    .navbar span,
    .breadcrumb-item,
    .breadcrumb-item a { color: #333 !important; font-weight: 600; }

    .material-symbols-rounded {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      font-size: 22px;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">

  <div id="sidebar-overlay"></div>

  <!-- Sidebar -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <a class="navbar-brand px-4 py-3 m-0">
        <img src="{$base_url}assets/img/logo-ct-dark.png" width="26" height="26">
        <span class="ms-1 text-sm text-dark">Perpusku</span>
      </a>
    </div>

    <hr class="horizontal dark mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active bg-gradient-dark text-white" href="{$base_url}admin/dashboard"><i class="material-symbols-rounded">dashboard</i><span class="nav-link-text ms-1">Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}admin/books"><i class="material-symbols-rounded">menu_book</i><span class="nav-link-text ms-1">Data Buku</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}admin/categories"><i class="material-symbols-rounded">category</i><span class="nav-link-text ms-1">Kategori Buku</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}admin/peminjaman"><i class="material-symbols-rounded">library_books</i><span class="nav-link-text ms-1">Peminjaman</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}admin/users"><i class="material-symbols-rounded">group</i><span class="nav-link-text ms-1">Pengguna</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}admin/ulasan"><i class="material-symbols-rounded">reviews</i><span class="nav-link-text ms-1">Ulasan Buku</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}admin/profile"><i class="material-symbols-rounded">person</i><span class="nav-link-text ms-1">Profil</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}logout"><i class="material-symbols-rounded">logout</i><span class="nav-link-text ms-1">Logout</span></a></li>
      </ul>
    </div>

    <!-- Footer -->
    <div class="sidenav-footer w-100 bottom-0 position-absolute">
      <div class="mx-3 text-center mb-3">
        <a class="btn bg-gradient-pink w-100 text-white mb-2" href="https://perpus.qailla.app" target="_blank">📚 Perpustakaan Digital</a>
        <a class="btn btn-outline-dark w-100">📖 Dokumentasi</a>
      </div>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="main-content border-radius-lg">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl">
      <div class="container-fluid py-1 px-3">
        <button id="toggleSidebar" class="btn btn-dark btn-sm me-3"><i class="material-symbols-rounded">menu</i></button>

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
            <li class="breadcrumb-item"><a class="text-dark" href="#">Dashboard</a></li>
            <li class="breadcrumb-item text-dark active">{$title}</li>
          </ol>
        </nav>

        <div class="ms-auto d-flex align-items-center">
          <span class="text-dark me-1">Hai,</span>
          <strong class="text-dark me-3">{if isset($userName) && $userName != ''}{$userName}{else}Guest{/if}</strong>
          <a href="{$base_url}logout" class="btn btn-sm btn-outline-dark px-3">Logout</a>
        </div>
      </div>
    </nav>

    <!-- Main block -->
    <div class="container-fluid py-2">
      {block name="main"}{/block}
    </div>

  </main>

  <!-- JS -->
  <script src="{$base_url}assets/js/core/popper.min.js"></script>
  <script src="{$base_url}assets/js/core/bootstrap.min.js"></script>
  <script src="{$base_url}assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="{$base_url}assets/js/plugins/smooth-scrollbar.min.js"></script>

  <script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const overlay = document.getElementById('sidebar-overlay');

    toggleSidebar.onclick = () => {
      if (window.innerWidth <= 991) document.body.classList.toggle("sidebar-show");
      else document.body.classList.toggle("sidebar-collapsed");
    };

    overlay.onclick = () => document.body.classList.remove("sidebar-show");
  </script>

  {block name="scripts"}{/block}

</body>
</html>
