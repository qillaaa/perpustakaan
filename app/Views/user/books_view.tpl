{extends file='layout_user.tpl'}

{block name='main_content'}
<div class="py-5 container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="background-color:#fff; border:1px solid #000; border-radius:8px; padding:0.5rem 1rem;">
            <li class="breadcrumb-item"><a href="{$base_url}user/dashboard" class="text-decoration-none" style="color:#000;">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{$base_url}user/books" class="text-decoration-none" style="color:#000;">Koleksi Buku</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color:#555;">{$book['judul']|default:'Detail Buku'}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Gambar Buku -->
        <div class="col-md-4 text-center">
            <img src="{if isset($book['cover']) && $book['cover']}{$base_url}uploads/covers/{$book['cover']}{else}{$base_url}assets/img/no-cover.png{/if}" 
                 alt="{$book['judul']|default:''}" 
                 class="img-fluid rounded-4 mb-3"
                 style="max-height:400px; object-fit:cover;">
        </div>

        <!-- Info Buku -->
        <div class="col-md-8">
            <h2 class="fw-bold mb-2" style="color:#000;">{$book['judul']|default:'-'}</h2>
            <p class="mb-1" style="color:#000;"><strong>Penulis:</strong> {$book['penulis']|default:'-'}</p>
            <p class="mb-1" style="color:#000;"><strong>Kategori:</strong> {$book['nama_kategori']|default:'-'}</p>
            <p class="mb-1" style="color:#000;"><strong>Tahun Terbit:</strong> {$book['tahun_terbit']|default:'-'}</p>
            <p class="mb-1" style="color:#000;">
                <strong>Akses:</strong> 
                {if isset($book['stok']) && $book['stok'] > 0}
                    <span style="color:#28a745;">Tersedia</span>
                {else}
                    <span style="color:#dc3545;">Ditutup</span>
                {/if}
            </p>
            <hr style="border-color:#000;">
            <h5 style="color:#000;">Deskripsi</h5>
            <p style="color:#333;">{$book['deskripsi']|default:'Deskripsi buku belum tersedia.'}</p>

            <!-- Tombol Aksi -->
            <div class="mt-4 d-flex flex-wrap gap-2">
                {if isset($book['stok']) && $book['stok'] > 0}
                    <a href="{$base_url}user/books/borrow/{$book['book_id']}" 
                       class="btn" 
                       style="background-color:#000; color:#fff; border:1px solid #000; transition:all 0.2s;"
                       onmouseover="this.style.backgroundColor='#fff'; this.style.color='#000';"
                       onmouseout="this.style.backgroundColor='#000'; this.style.color='#fff';">
                        <i class="bi bi-bookmark-plus me-1"></i> Pinjam Buku
                    </a>
                {else}
                    <button class="btn" disabled
                            style="background-color:#6c757d; color:#fff; border:1px solid #6c757d;">
                        <i class="bi bi-bookmark-plus me-1"></i> Akses Ditutup
                    </button>
                {/if}

                <a href="{$base_url}user/cart/add/{$book['book_id']}" 
                   class="btn" 
                   style="background-color:#fff; color:#000; border:1px solid #000; transition:all 0.2s;"
                   onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                    <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                </a>

                <a href="{$base_url}user/books/favorite/{$book['book_id']}" 
                   class="btn" 
                   style="border:1px solid #000; background-color:#fff; color:#000; transition:all 0.2s;"
                   onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                    <i class="bi {if isset($isFavorited) && $isFavorited}bi-heart-fill text-danger{else}bi-heart{/if} me-1"></i>
                    {if isset($isFavorited) && $isFavorited}Unlike{else}Like{/if}
                </a>

                <a href="{$base_url}user/books" 
                   class="btn btn-outline-secondary" 
                   style="border:1px solid #000; color:#000; background-color:#fff; transition:all 0.2s;"
                   onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Koleksi
                </a>
            </div>
        </div>
    </div>

    <!-- Rekomendasi Buku -->
    {if !empty($recommendedBooks)}
    <div class="mt-5">
        <h4 class="fw-bold mb-4 text-center" style="font-size:1.5rem; color:#000;">
            Rekomendasi Buku Lain di Kategori {$book['nama_kategori']|default:'-'}
            <span style="display:block;width:80px;height:3px;background-color:#000;margin:10px auto;border-radius:2px;"></span>
        </h4>
        <div class="row g-3">
            {foreach $recommendedBooks as $rec}
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="card h-100 shadow-sm rounded-4 border-1" style="border-color:#000;">
                        <img src="{if isset($rec['cover']) && $rec['cover']}{$base_url}uploads/covers/{$rec['cover']}{else}{$base_url}assets/img/no-cover.png{/if}" 
                             class="card-img-top rounded-top-4" 
                             alt="{$rec['judul']|default:''}"
                             style="height:180px; object-fit:cover;">
                        <div class="card-body d-flex flex-column p-2">
                            <h6 class="card-title text-truncate fw-semibold mb-1" style="color:#000;">{$rec['judul']|default:''}</h6>
                            <p class="card-text small mb-2" style="color:#333;">
                                <i class="bi bi-person me-1"></i>{$rec['penulis']|default:'-'}</p>

                            {* Akses badge *}
                            {if isset($rec['stok'])}
                                <span class="badge mb-2" style="background-color:{if $rec['stok']>0}#28a745{else}#dc3545{/if}; color:#fff; font-size:0.75rem;">
                                    Akses: {if $rec['stok']>0}Tersedia{else}Ditutup{/if}
                                </span>
                            {/if}

                            <div class="d-flex gap-1 mt-auto">
                                <a href="{$base_url}user/books/view/{$rec['book_id']}" 
                                   class="btn btn-sm flex-grow-1"
                                   style="border:1px solid #000; background-color:#fff; color:#000; transition:all 0.2s;"
                                   onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
                                   onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                                    Lihat
                                </a>

                                {if isset($rec['stok']) && $rec['stok']>0}
                                    <a href="{$base_url}user/books/borrow/{$rec['book_id']}" 
                                       class="btn btn-sm"
                                       style="border:1px solid #000; background-color:#000; color:#fff; transition:all 0.2s;"
                                       onmouseover="this.style.backgroundColor='#fff'; this.style.color='#000';"
                                       onmouseout="this.style.backgroundColor='#000'; this.style.color='#fff';">
                                        <i class="bi bi-bookmark-plus me-1"></i> Pinjam
                                    </a>
                                {else}
                                    <button class="btn btn-sm" disabled
                                            style="border:1px solid #6c757d; background-color:#6c757d; color:#fff;">
                                        Akses Ditutup
                                    </button>
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
    {/if}

</div>
{/block}
