{extends file='layout_user.tpl'}

{block name='main_content'}
<div class="py-4 main-content-area position-relative">

    <!-- Welcome -->
    <div class="text-center mb-5 mt-3">
        <h2 class="fw-bold">
            Hai! 
            <a href="{$base_url}/user/profile" class="text-decoration-none text-dark">
                {$userName|default:'Tamu'|escape} 👋
            </a>
        </h2>
        <p class="text-muted">
            Selamat datang di <strong>Dashboard Pengguna</strong> Perpusku!
        </p>
    </div>

    <!-- Statistik -->
    <div class="row g-4 text-center mb-5">
        <div class="col-md-4">
            <div class="card rounded-4 p-4 h-100 hover-shadow">
                <i class="bi bi-book display-6 mb-2"></i>
                <h5 class="fw-semibold">Total Buku</h5>
                <h2 class="fw-bold">{$totalBooks|default:0|escape}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-4 p-4 h-100 hover-shadow">
                <i class="bi bi-bookmark-fill display-6 mb-2"></i>
                <h5 class="fw-semibold">Buku Dipinjam</h5>
                <h2 class="fw-bold">{$borrowedBooks|default:0|escape}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-4 p-4 h-100 hover-shadow">
                <i class="bi bi-heart-fill display-6 mb-2"></i>
                <h5 class="fw-semibold">Buku Favorit</h5>
                <h2 class="fw-bold">{$favoriteBooks|default:0|escape}</h2>
            </div>
        </div>
    </div>

    <!-- Buku Terbaru -->
    <div class="mb-5">
        <h4 class="mb-4 pb-2 fw-bold text-center" style="font-size:1.6rem;">Buku Terbaru</h4>
        <div class="row g-3">
            {if !empty($latestBooks)}
                {foreach $latestBooks as $book}
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card h-100 rounded-4 hover-shadow">
                            <img src="{if !empty($book.cover)}{$base_url}/uploads/covers/{$book.cover|escape}{else}{$base_url}/assets/img/no-cover.png{/if}"  
                                 class="card-img-top rounded-top-4" 
                                 alt="{$book.judul|default:'Judul Tidak Diketahui'|escape}"
                                 title="{$book.judul|default:'Judul Tidak Diketahui'|escape}"
                                 style="height:240px; object-fit:cover;">
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title text-truncate fw-semibold mb-1">{$book.judul|escape}</h6>
                                <p class="card-text text-muted small mb-3">
                                    <i class="bi bi-person me-1"></i>{$book.penulis|default:'-'|escape}
                                </p>
                                <a href="{$base_url}/user/books/view/{$book.book_id}" class="btn btn-sm btn-outline-secondary mt-auto w-100">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                {/foreach}
            {else}
                <div class="col-12 text-center">
                    <p class="text-muted mt-3">Belum ada buku terbaru.</p>
                </div>
            {/if}
        </div>
    </div>

    <!-- Buku Populer Ber-Rating -->
    <div class="mb-5">
        <h4 class="mb-4 pb-2 fw-bold text-center" style="font-size:1.6rem;">⭐ Buku Populer & Ber-Rating</h4>
        <div class="row g-3">
            {if !empty($ratedBooks)}
                {foreach $ratedBooks as $book}
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card h-100 rounded-4 hover-shadow">
                            <img src="{if !empty($book.cover)}{$base_url}/uploads/covers/{$book.cover|escape}{else}{$base_url}/assets/img/no-cover.png{/if}"  
                                 class="card-img-top rounded-top-4" 
                                 alt="{$book.judul|default:'Judul Tidak Diketahui'|escape}"
                                 title="{$book.judul|default:'Judul Tidak Diketahui'|escape}"
                                 style="height:240px; object-fit:cover;">
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title text-truncate fw-semibold mb-1">{$book.judul|escape}</h6>
                                <p class="card-text text-muted small mb-1">
                                    <i class="bi bi-person me-1"></i>{$book.penulis|default:'-'|escape}
                                </p>
                                <span class="badge bg-dark mb-2">Rating: {$book.avg_rating|round:1}</span>
                                <a href="{$base_url}/user/books/view/{$book.book_id}" class="btn btn-sm btn-outline-secondary mt-auto w-100">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                {/foreach}
            {else}
                <div class="col-12 text-center">
                    <p class="text-muted mt-3">Belum ada buku ber-rating.</p>
                </div>
            {/if}
        </div>
    </div>

</div>
{/block}
