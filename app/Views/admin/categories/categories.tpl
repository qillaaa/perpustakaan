{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-4 border-0 bg-white">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Data Kategori Buku</h5>

            <a href="{$base_url}admin/categories/create" 
               class="btn btn-dark btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                ➕ Tambah Kategori
            </a>
        </div>
    </div>

    {if $success}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {$success}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    {/if}

    <!-- Search Input Panjang -->
    <div class="mb-3">
        <form method="get" action="{$base_url}admin/categories" class="d-flex align-items-center w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari kategori..." 
                   value="{$q|default:''}" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                 Cari
            </button>
            {if $q}
                <a href="{$base_url}admin/categories" 
                   class="btn btn-outline-secondary rounded-pill ms-2 py-1" 
                   style="height:38px; font-size:0.9rem;">Reset</a>
            {/if}
        </form>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Buku</th>
                            <th>Total Akses</th>
                            <th style="width:150px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {foreach from=$categories item=cat name=loop}
                            <tr>
                                <td>{$smarty.foreach.loop.index+1}</td>
                                <td>{$cat.nama_kategori}</td>
                                <td>{$cat.jumlah_buku|default:0}</td>
                                <td>{$cat.total_stok|default:0}</td>
                                <td>
                                    <a href="{$base_url}admin/categories/edit/{$cat.kategori_id}" 
                                       class="btn btn-sm btn-dark rounded-pill px-3 mb-1 shadow-sm">
                                        ✏️ Edit
                                    </a>

                                    <a href="{$base_url}admin/categories/delete/{$cat.kategori_id}" 
                                       class="btn btn-sm btn-danger rounded-pill px-3 mb-1 shadow-sm"
                                       onclick="return confirm('Yakin mau hapus kategori ini?')">
                                        🗑️ Hapus
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="material-symbols-rounded d-block mb-2 fs-1 opacity-50">category</i>
                                    Belum ada kategori buku
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
