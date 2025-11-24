{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-3 border-0 bg-white">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-0">Daftar Ulasan Buku</h5>
        </div>
    </div>

    <!-- Search Box -->
    <div class="mb-3 d-flex align-items-center">
        <form method="get" action="{$base_url}admin/ulasan" class="d-flex w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari ulasan berdasarkan username, judul, rating, atau tanggal..." 
                   value="{$q|default:''}" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                Cari
            </button>
            {if $q}
                <a href="{$base_url}admin/ulasan" 
                   class="btn btn-outline-secondary rounded-pill ms-2 py-1" 
                   style="height:38px; font-size:0.9rem;">Reset</a>
            {/if}
        </form>
    </div>

    {if $message}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {$message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    {/if}

    <!-- Tabel Ulasan -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Username</th>
                            <th>Judul Buku</th>
                            <th style="width:100px;">Rating</th>
                            <th>Komentar</th>
                            <th style="width:150px;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$ulasan item=u key=index}
                        <tr>
                            <td>{$index+1}</td>
                            <td>{$u.user|escape}</td>
                            <td>{$u.buku|escape}</td>
                            <td>
                                <span class="badge bg-dark text-white">{$u.rating} / 5</span>
                            </td>
                            <td>{$u.komentar|escape}</td>
                            <td>{$u.created_at}</td>
                        </tr>
                        {/foreach}
                        {if $ulasan|@count == 0}
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Belum ada ulasan
                            </td>
                        </tr>
                        {/if}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
{/block}
