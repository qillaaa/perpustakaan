{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-4 border-0 bg-white">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">
                <i class="material-symbols-rounded me-2">menu_book</i> Data Peminjaman
            </h5>
        </div>
    </div>

    <!-- Alert -->
    {if isset($message)}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {$message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    {/if}

    <!-- Search Input -->
    <div class="mb-3">
        <form method="get" action="{$base_url}admin/peminjaman" class="d-flex align-items-center w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari username atau judul buku..." 
                   value="{$q|default:''}" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                Cari
            </button>
            {if $q}
                <a href="{$base_url}admin/peminjaman" 
                   class="btn btn-outline-secondary rounded-pill ms-2 py-1" 
                   style="height:38px; font-size:0.9rem;">Reset</a>
            {/if}
        </form>
    </div>

    <!-- Tabel Peminjaman -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Username</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th style="width:150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$peminjaman item=p key=k}
                        <tr>
                            <td>{$k+1}</td>
                            <td>{$p.user_name}</td>
                            <td>{$p.book_title}</td>
                            <td>{$p.tgl_pinjam}</td>
                            <td>{$p.tgl_kembali|default:"-"}</td>
                            <td>
                                <span class="badge {if $p.status == 'Dipinjam'}bg-warning text-dark{else}bg-success text-white{/if}">
                                    {$p.status}
                                </span>
                            </td>
                            <td>
                                {if $p.status == 'Dipinjam'}
                                    <a href="{$base_url}admin/peminjaman/kembalikan/{$p.peminjaman_id}"
                                       class="btn btn-sm btn-success"
                                       onclick="return confirm('Konfirmasi pengembalian?')">
                                       ✔ Kembalikan
                                    </a>
                                {/if}
                            </td>
                        </tr>
                        {foreachelse}
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="material-symbols-rounded d-block mb-2 fs-1 opacity-50">menu_book</i>
                                Belum ada data peminjaman
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
