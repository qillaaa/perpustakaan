{extends file="layout_user.tpl"}

{block name="main_content"}

<style>
/* ...style lama tetap sama... */
.stok-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    background-color: #28a745;
    color: #fff;
    margin-bottom: 0.5rem;
    display: inline-block;
}
</style>

<div class="container py-5">

    <h2 class="fw-bold mb-4 text-center" style="color:#000;">📖 Buku Saya</h2>

    {if isset($loans) && $loans|@count > 0}
        <div class="books-grid">
            {foreach from=$loans item=loan}
                <div class="book-card">
                    {if $loan.cover}
                        <img src="{$base_url}uploads/covers/{$loan.cover}" class="book-cover">
                    {else}
                        <img src="{$base_url}assets/img/no-cover.png" class="book-cover">
                    {/if}

                    <div class="book-title" title="{$loan.judul|escape}">{$loan.judul|escape}</div>
                    <div class="book-author">{$loan.penulis|default:'-'|escape}</div>
                    <div class="mb-1"><small style="color:#000;">Dipinjam: {$loan.tgl_pinjam|default:'-'}</small></div>
                    <div class="mb-2"><small style="color:#000;">Kembali: {$loan.tgl_kembali|default:'-'}</small></div>
                    <span class="badge">{$loan.status|default:'-'}</span>

                    {* Akses tersisa *}
                    {if isset($loan.stok)}
                        <div class="stok-badge">Akses: {if $loan.stok>0}Tersedia{else}Ditutup{/if}</div>
                    {/if}

                    {* Tombol Konfirmasi atau Baca Buku *}
                    {if $loan.status != 'Selesai'}
                        <form action="{$base_url}user/mybooks/konfirmasi/{$loan.peminjaman_id}" method="post" class="mb-2 w-100">
                            <input type="hidden" name="{$csrf_name}" value="{$csrf_hash}">
                            <button type="submit" class="btn btn-sm w-100">
                                <i class="bi bi-check-circle"></i> Konfirmasi Selesai
                            </button>
                        </form>
                    {/if}

                    {if !empty($loan.file_buku)}
                        <a href="{$loan.read_link}" target="_blank" class="btn btn-sm w-100">
                            <i class="bi bi-book"></i> Baca Buku
                        </a>
                    {/if}

                    {if isset($loan.can_review) && $loan.can_review}
                        <a href="{$base_url}user/reviews/add/{$loan.peminjaman_id}" class="btn btn-sm w-100">
                            <i class="bi bi-star"></i> Beri Ulasan
                        </a>
                    {/if}
                </div>
            {/foreach}
        </div>
    {else}
        <div class="text-center mb-5">
            <p class="text-muted fs-5">Belum ada buku yang dipinjam 😅</p>
        </div>
    {/if}

    {* Rekomendasi Buku Populer *}
    {if isset($popularBooks) && $popularBooks|@count > 0}
        <h4 class="fw-bold mt-5 mb-3 text-center">Rekomendasi Buku Populer 📚</h4>
        <div class="books-grid">
            {foreach from=$popularBooks item=rec}
                <div class="book-card">
                    {if $rec.cover}
                        <img src="{$base_url}uploads/covers/{$rec.cover}" class="book-cover">
                    {else}
                        <img src="{$base_url}assets/img/no-cover.png" class="book-cover">
                    {/if}
                    <div class="book-title" title="{$rec.judul|escape}">{$rec.judul|escape}</div>
                    <div class="book-author">{$rec.penulis|default:'-'|escape}</div>

                    {* Tampilkan akses *}
                    {if isset($rec.stok)}
                        <div class="stok-badge">Akses: {if $rec.stok>0}Tersedia{else}Ditutup{/if}</div>
                    {/if}

                    {* Tombol Pinjam hanya muncul jika akses tersedia *}
                    {if isset($rec.stok) && $rec.stok > 0}
                        <form action="{$base_url}user/mybooks/borrow/{$rec.book_id}" method="post" class="w-100 mb-2">
                            <input type="hidden" name="{$csrf_name}" value="{$csrf_hash}">
                            <button type="submit" class="btn btn-sm w-100">
                                <i class="bi bi-cart-plus"></i> Pinjam Buku
                            </button>
                        </form>
                    {else}
                        <button class="btn btn-sm w-100" disabled>
                            <i class="bi bi-x-circle"></i> Akses Ditutup
                        </button>
                    {/if}

                    <a href="{$base_url}user/books/view/{$rec.book_id}" class="btn btn-sm w-100 mt-1">
                        <i class="bi bi-book"></i> Lihat Buku
                    </a>
                </div>
            {/foreach}
        </div>
    {/if}

</div>

{/block}
