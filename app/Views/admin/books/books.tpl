{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-4 border-0 bg-white">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">
                <i class="material-symbols-rounded me-2">menu_book</i> Data Buku
            </h5>

            <a href="{$base_url}admin/books/create" 
               class="btn btn-dark btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                <i class="material-symbols-rounded me-1">add</i> Tambah Buku
            </a>
        </div>
    </div>

    {if isset($success)}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {$success}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    {/if}

    <!-- Search -->
    <div class="mb-3">
        <form method="get" action="{$base_url}admin/books" class="d-flex align-items-center w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari buku..." 
                   value="{$q|default:''}" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                 Cari
            </button>
            {if $q}
                <a href="{$base_url}admin/books" 
                   class="btn btn-outline-secondary rounded-pill ms-2 py-1" 
                   style="height:38px; font-size:0.9rem;">Reset</a>
            {/if}
        </form>
    </div>

    <!-- Tabel Buku -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">ID</th>
                            <th style="width:80px;">Cover</th>
                            <th class="text-start">Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th>Akses</th>
                            <th>File</th>
                            <th style="width:130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {foreach from=$books item=book}
                            <tr>
                                <td>{$book.book_id}</td>
                                <td>
                                    {if $book.cover}
                                        <img src="{$base_url}uploads/covers/{$book.cover}" 
                                             class="rounded-3 shadow-sm" 
                                             style="width:60px; height:80px; object-fit:cover;">
                                    {else}
                                        <img src="{$base_url}assets/img/no-cover.png" 
                                             class="rounded-3 shadow-sm" 
                                             style="width:60px; height:80px; object-fit:cover;">
                                    {/if}
                                </td>
                                <td class="text-start fw-semibold">{$book.judul}</td>
                                <td>{$book.penulis|default:'-'}</td>
                                <td>{$book.penerbit|default:'-'}</td>
                                <td>{$book.tahun_terbit|default:'-'}</td>
                                <td>{$book.kategori|default:'-'}</td>
                                <td>
                                    {assign var=stokDipinjam value=$book.stok - $book.dipinjam}
                                    {$stokDipinjam|default:0}
                                </td>
                                <td>
                                    {if $book.file_buku}
                                        <a href="{$base_url}uploads/ebooks/{$book.file_buku}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                            <i class="material-symbols-rounded me-1">visibility</i> Lihat
                                        </a>
                                    {else}
                                        <span class="text-muted">-</span>
                                    {/if}
                                </td>
                                <td>
                                    <a href="{$base_url}admin/books/edit/{$book.book_id}" 
                                       class="btn btn-sm btn-dark rounded-pill px-3 mb-1 shadow-sm">
                                        <i class="material-symbols-rounded">edit</i>
                                    </a>
                                    <a href="{$base_url}admin/books/delete/{$book.book_id}" 
                                       class="btn btn-sm btn-danger rounded-pill px-3 mb-1 shadow-sm"
                                       onclick="return confirm('Yakin ingin menghapus buku ini?');">
                                        <i class="material-symbols-rounded">delete</i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    <i class="material-symbols-rounded d-block mb-2 fs-1 opacity-50">menu_book</i>
                                    Belum ada data buku
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
{/block}
