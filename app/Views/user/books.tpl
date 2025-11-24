{extends file="layout_user.tpl"}

{block name="main_content"}
<h2 class="fw-bold mb-4 text-center" style="color:#000;">📚 Koleksi Buku</h2>

{if $books|@count > 0}
<div class="books-grid" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:15px;">
    {foreach from=$books item=book}
        <div class="book-card" style="background-color:#fff; border:1px solid #000; border-radius:10px; padding:10px; text-align:center; transition:all 0.2s;">
            {if isset($book.cover) && $book.cover}
                <img src="{$base_url}uploads/covers/{$book.cover}" 
                     class="book-cover" 
                     alt="{$book.judul|default:'Judul Tidak Diketahui'|escape}" 
                     style="width:100%; height:220px; object-fit:cover; border-radius:6px;">
            {else}
                <img src="{$base_url}assets/img/no-cover.png" 
                     class="book-cover" 
                     alt="{$book.judul|default:'Judul Tidak Diketahui'|escape}" 
                     style="width:100%; height:220px; object-fit:cover; border-radius:6px;">
            {/if}

            <div class="book-title" style="font-weight:600; color:#000; margin-top:10px;">{$book.judul|default:'Judul Tidak Diketahui'|escape}</div>
            <div class="book-author" style="font-size:0.85rem; color:#333; margin-bottom:10px;">{$book.penulis|default:'Pengarang Tidak Diketahui'|escape}</div>

            <!-- Tombol Lihat -->
            <a href="{$base_url}/user/books/view/{$book.book_id}" 
               class="btn btn-sm w-100 rounded-pill mt-2"
               style="border:1px solid #000; background-color:#fff; color:#000; transition:all 0.2s;"
               onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
               onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                <i class="bi bi-eye me-1"></i> Lihat
            </a>
        </div>
    {/foreach}
</div>
{else}
    <p class="text-center text-muted" style="color:#555;">Belum ada buku yang tersedia.</p>
{/if}
{/block}
