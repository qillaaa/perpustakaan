<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{$title|default:'Dashboard'} | Perpusku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #fff;
    margin: 0;
    padding-top: 70px; /* navbar fixed-top */
}

/* Navbar */
.navbar-custom {
    background-color: #fff;
    border-bottom: 1px solid #ddd;
    padding: 0.5rem 1rem;
}
.navbar-brand {
    color: #000 !important;
    font-weight: 700;
    font-size: 1.6rem;
}
.nav-link {
    color: #000 !important;
    transition: all 0.2s;
}
.nav-link:hover {
    background-color: #000;
    color: #fff !important;
    border-radius: 4px;
}
.nav-icons a {
    color: #000;
    position: relative;
    margin-left: 0.75rem;
    font-size: 1.4rem;
    transition: 0.2s;
}
.nav-icons a:hover { color: #555; }
.nav-badge {
    position: absolute;
    top: -5px;
    right: -10px;
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    font-size: 0.7rem;
    padding: 2px 5px;
    font-weight: bold;
}
.btn-logout {
    background-color: #000;
    color: #fff;
    font-weight: 600;
    padding: 0.3rem 0.9rem;
    border-radius: 6px;
    border: none;
    transition: all 0.2s;
}
.btn-logout:hover { background-color: #555; }

/* Main Content */
.main-content-area { margin-top: 20px; padding-top: 20px; }

/* Footer Modern */
footer {
    background-color: #f8f9fa;
    color: #333;
    padding: 50px 0;
    font-size: 0.9rem;
}
footer h5 {
    font-weight: 600;
    margin-bottom: 20px;
}
footer a {
    color: #333;
    text-decoration: none;
    transition: color 0.2s;
}
footer a:hover { color: #1a73e8; } /* biru lembut saat hover */
footer .social-icons a {
    display: inline-block;
    margin-right: 10px;
    font-size: 1.2rem;
    color: #333;
    transition: all 0.3s;
}
footer .social-icons a:hover { color: #1a73e8; transform: translateY(-2px); }

/* Card Buku */
.book-card {
    text-align: center;
    padding: 10px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #ddd;
    transition: all 0.2s;
}
.book-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.book-cover {
    width: 100%;
    height: 240px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 10px;
}
.book-title {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.2rem;
    height: 2.5rem;
    overflow: hidden;
}
.book-author {
    font-size: 0.85rem;
    color: #555;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

/* Grid Buku Responsif */
.books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
}
</style>
</head>
<body>

<!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{$base_url}/user/dashboard">
      <i class="bi bi-book-half me-2"></i>Perpusku
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser" aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarUser">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{$base_url}/user/dashboard">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}/user/books">Daftar Buku</a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}/user/mybooks">Buku Saya</a></li>
        <li class="nav-item"><a class="nav-link" href="{$base_url}/user/reviews">Riwayat</a></li>
      </ul>

      <!-- Navbar Search -->
<form id="dashboard-search-form" class="d-flex me-3" method="get">
    <input id="dashboard-search-input" class="form-control me-2" type="search" name="q" placeholder="Cari buku..." aria-label="Search">
    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
</form>

<!-- Hasil Pencarian -->
<div id="dashboard-search-results" class="mt-3">
    <!-- Hasil akan muncul di sini -->
</div>


      <div class="nav-icons d-flex align-items-center">
        <a href="{$base_url}/user/cart" class="position-relative">
          <i class="bi bi-cart3"></i>
          {if isset($cart_count) && $cart_count > 0}
            <span class="nav-badge">{$cart_count}</span>
          {/if}
        </a>
        <a href="{$base_url}/user/favorites" class="position-relative ms-3">
          <i class="bi bi-heart-fill"></i>
          {if isset($fav_count) && $fav_count > 0}
            <span class="nav-badge">{$fav_count}</span>
          {/if}
        </a>
        <a href="{$base_url}/user/profile" class="ms-3">
          <i class="bi bi-person-circle fs-5"></i>
        </a>
        <form action="{$base_url}/logout" method="get" class="ms-3 m-0 d-inline">
          <button type="submit" class="btn btn-logout">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>


<!-- Main Content -->
<div class="container main-content-area">
    {block name='main_content'}{/block}
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row gy-4">
            <!-- Tentang Perpusku -->
            <div class="col-md-4">
                <h5>Tentang Perpusku</h5>
                <p>
                    Perpusku adalah perpustakaan digital yang menyediakan berbagai koleksi buku, majalah, dan komik
                    yang bisa dipinjam dengan mudah. Tujuan kami adalah membuat literasi lebih mudah diakses oleh semua orang.
                </p>
                <div class="social-icons mt-2">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Link Cepat -->
            <div class="col-md-3">
                <h5>Link Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="{$base_url}">Beranda</a></li>
                    <li><a href="{$base_url}/user/books">Koleksi Buku</a></li>
                    <li><a href="{$base_url}/about">Tentang Kami</a></li>
                    <li><a href="{$base_url}/contact">Kontak</a></li>
                </ul>
            </div>

            <!-- Kategori -->
            <div class="col-md-2">
                <h5>Kategori</h5>
                <ul class="list-unstyled">
                    <li>Novel</li>
                    <li>Teknologi</li>
                    <li>Sains</li>
                    <li>Sejarah</li>
                    <li>Komik</li>
                    <li>Dongeng</li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-md-3">
                <h5>Kontak Kami</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt-fill me-2"></i>Jl. Contoh No.123, Kota, Negara</li>
                    <li><i class="bi bi-envelope-fill me-2"></i>info@perpusku.com</li>
                    <li><i class="bi bi-telephone-fill me-2"></i>+62 812 3456 7890</li>
                </ul>
            </div>
        </div>

        <hr style="border-color:#ccc; margin:30px 0;">

        <div class="text-center" style="color:#555;">© 2025 Perpusku. All rights reserved.</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
