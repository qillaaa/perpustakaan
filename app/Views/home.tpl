{block name="main"}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perpusku - Perpustakaan Digital</title>

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  {literal}
  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #f5f6f8; margin: 0; }
    h3,h4 { color: #333; }
/* Navbar */
.navbar-custom {
    background-color: #fff !important;
    border-bottom: 1px solid #ddd;
    padding: 0.6rem 1rem;
}

.navbar-custom .navbar-brand {
    color: #000 !important;
    font-weight: 700;
    font-size: 1.6rem;
}

.navbar-custom .nav-link {
    color: #000 !important;
    font-weight: 500;
    transition: 0.2s;
}

.navbar-custom .nav-link:hover {
    background-color: #000;
    color: #fff !important;
    border-radius: 6px;
    padding-left: 6px;
    padding-right: 6px;
}

/* Button Login / Logout */
.btn-login-custom {
    background-color: #fff;
    color: #1b1b1b;
    font-weight: 600;
    padding: 0.35rem 0.95rem;
    border-radius: 6px;
    border: 1px solid #ccc;
    transition: all 0.2s;
}

.btn-login-custom:hover {
    background-color: #000;
    color: #fff;
    border-color: #000;
}

/* Username NAV */
.navbar-custom .user-text {
    color: #000;
    font-weight: 600;
}

/* On dark mode nav (if used navbar-dark) force white icons */
.navbar-custom .bi {
    color: #000;
}


    /* Header Banner */
    .header-banner { position: relative; height: 300px; overflow: hidden; border-radius: 12px; margin: 20px auto 0 auto; max-width: 1200px; box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
    .header-banner img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .header-text { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: rgba(0,0,0,0.6); color: #fff; padding: 15px 25px; border-radius: 10px; text-align: center; }
    .header-text h2 { margin-bottom: 5px; font-size: 1.8rem; }

    /* Main Content */
    .main-content-area { margin-top: 30px; padding: 40px 15px 60px 15px; }

    /* Search Box */
    .search-container { max-width: 750px; margin: 0 auto 3rem auto; padding: 15px; background: #fff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
    .search-input { border-radius: 8px 0 0 8px !important; border: 1px solid #ccc; padding: 0.65rem 1rem; }
    .search-btn { background-color: #000; border: 1px solid #000; color: #fff; border-radius: 0 8px 8px 0 !important; font-weight: 600; padding: 0.65rem 1.5rem; }
    .search-btn:hover { background-color: #333; border-color: #333; }

    /* Kategori */
    .kategori-group { display: flex; flex-wrap: wrap; justify-content: center; gap: 0.5rem; margin-bottom: 3rem; }
    .category-btn { border: 1px solid #ccc; border-radius: 50px; padding: 0.5rem 1.6rem; background-color: #fff; color: #444; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 5px; transition: all 0.2s; }
    .category-btn:hover, .category-btn:focus { background-color: #000; color: #fff; border-color: #000; box-shadow: 0 3px 8px rgba(0,0,0,0.4); }

    /* Buku */
    .popular-section h4 { font-weight: 600; text-align: center; margin-bottom: 2rem; position: relative; padding-bottom: 10px; font-size: 1.6rem; }
    .popular-section h4::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background-color: #000; border-radius: 2px; }
    .book-card { text-align: center; padding: 10px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.2s; min-width:150px; flex: 0 0 auto; }
    .book-card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.12); }
    .book-cover { width: 100%; height: 240px; object-fit: cover; border-radius: 10px; margin-bottom: 10px; }
    .book-title { font-weight: 600; font-size: 1rem; margin-bottom: 0.2rem; height: 2.5rem; overflow: hidden; }
    .book-author { font-size: 0.85rem; color: #666; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 5px; }
    .btn-lihat-buku { background-color: #fff; color: #444; border: 1px solid #ccc; border-radius: 8px; font-weight: 500; width: 85%; transition: all 0.2s; }
    .btn-lihat-buku:hover { background-color: #000; color: #fff; border-color: #000; }

    /* Rating */
    .book-rating i { font-size: 0.85rem; }

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
    /* Scrollbar popular */
    .popular-scroll { overflow-x: auto; padding-bottom: 10px; -webkit-overflow-scrolling: touch; scroll-behavior: smooth; display: flex; gap: 1rem; }
    .popular-scroll::-webkit-scrollbar { height: 6px; }
    .popular-scroll::-webkit-scrollbar-thumb { background-color: #000; border-radius: 3px; }
    .popular-scroll::-webkit-scrollbar-track { background: rgba(0,0,0,0.05); }

    /* Media query */
    @media (max-width: 576px) {
      .book-card { min-width: 120px; }
      .book-cover { height: 180px; }
      .btn-lihat-buku { width: 100%; font-size: 0.85rem; }
    }
  </style>
  {/literal}
</head>
<body>

  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold fs-4" href="{$base_url}">
            <i class="bi bi-book-half me-2"></i>Perpusku
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-center">

                {if $isLoggedIn}
                    <li class="nav-item me-3 d-flex align-items-center">
                        <i class="bi bi-person-circle fs-5 me-1 text-dark"></i>
                        <span class="user-text">Hai, {$userName|escape}</span>
                    </li>

                    <li class="nav-item">
                        <a href="{$base_url}logout" class="btn btn-login-custom d-flex align-items-center">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </a>
                    </li>

                {else}
                    <li class="nav-item">
                        <a href="{$base_url}login" class="btn btn-login-custom d-flex align-items-center">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                {/if}

            </ul>
        </div>
    </div>
</nav>


  <!-- Header Banner -->
  <div class="header-banner position-relative">
    <img src="{$base_url}uploads/covers/banner.jpeg" alt="Banner Perpustakaan" class="w-100 h-100" style="object-fit:cover;">
    <div class="header-text">
      <h2 class="mb-2">Selamat Datang di Perpustakaan Digital</h2>
      <p class="mb-0">Temukan dan pinjam buku favoritmu dengan mudah!</p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container main-content-area">
    <h3 class="fw-bold text-center mb-4">Jelajahi Koleksi Buku</h3>

    <!-- Search -->
    <div class="search-container">
      <form method="get" action="{if $isLoggedIn}{$base_url}search{else}{$base_url}login{/if}" class="d-flex">
        <input type="text" class="form-control search-input" name="q" placeholder="Cari buku, majalah, komik..." required>
        <button class="btn search-btn" type="submit">Cari</button>
      </form>
      <p class="text-center text-muted mt-2 small">Contoh: Dongeng, Teknologi, Sains</p>
    </div>

    <!-- Kategori -->
    <div class="kategori-group">
      {foreach from=$categories item=cat}
        <a href="{if $isLoggedIn}{$base_url}category/{$cat.kategori_id}{else}{$base_url}login{/if}" class="category-btn">
          {$cat.nama_kategori}
        </a>
      {/foreach}
    </div>

    <!-- Populer -->
    {foreach from=['Populer'=>$popular_books,'Terbaru'=>$latest_books,'Rating'=>$rated_books] key=section item=books}
      <div class="popular-section mt-5">
        <h4>{if $section=='Populer'}Yang Populer di Antara Koleksi Kami{elseif $section=='Terbaru'}Tambahan Buku Terbaru{else}Buku dengan Rating Terbaik{/if}</h4>
        {if $books}
          <div class="popular-scroll">
            {foreach from=$books item=book}
              <div class="book-card">
                <img src="{$base_url}uploads/covers/{$book.cover|default:'no-image.jpg'}" alt="Cover {$book.judul|escape}" class="book-cover">
                <p class="book-title" title="{$book.judul|escape}">{$book.judul|escape}</p>
                <p class="book-author"><i class="bi bi-person"></i> {$book.penulis|escape}</p>

                {if $section=='Rating'}
                  <p class="book-rating mb-2">
                    {for $i=1 to 5}
                      {if $i <= round($book.rating|default:0)}
                        <i class="bi bi-star-fill text-warning"></i>
                      {else}
                        <i class="bi bi-star text-warning"></i>
                      {/if}
                    {/for}
                    <span class="ms-1">({$book.rating|default:0})</span>
                  </p>
                {/if}

                <a href="{if $isLoggedIn}{$base_url}book/{$book.book_id}{else}{$base_url}login{/if}" class="btn btn-lihat-buku btn-sm"><i class="bi bi-eye"></i> Lihat Buku</a>
              </div>
            {/foreach}
          </div>
        {else}
          <p class="text-center text-muted mt-5">Belum ada buku di kategori ini.</p>
        {/if}
      </div>
    {/foreach}
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
{/block}
