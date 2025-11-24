{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-3 border-0 bg-white">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-0">Daftar Pengguna</h5>
        </div>
    </div>

    <!-- Search Box -->
    <div class="mb-3 d-flex align-items-center">
        <form method="get" action="{$base_url}admin/users" class="d-flex w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari pengguna..." 
                   value="{$q|default:''}" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                Cari
            </button>
            {if $q}
                <a href="{$base_url}admin/users" 
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

    <!-- Tabel Pengguna -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Pinjam Aktif</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$users item=u key=index}
                        <tr>
                            <td>{$index+1}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{if isset($u.avatar_url) && $u.avatar_url}{$base_url}{$u.avatar_url}{else}{$base_url}assets/img/default-avatar.png{/if}" 
                                         class="avatar avatar-sm me-2 border-radius-lg" 
                                         alt="avatar"
                                         style="object-fit:cover; width:40px; height:40px;">
                                    <span>{$u.username|default:'-'}</span>
                                </div>
                            </td>
                            <td>{$u.role|default:'User'}</td>
                            <td class="text-center">
                                {if $u.active == 1}
                                    <span class="badge bg-dark text-white">Aktif</span>
                                {else}
                                    <span class="badge bg-secondary text-white">Nonaktif</span>
                                {/if}
                            </td>
                            <td class="text-center">{$u.total_pinjam|default:0}</td>
                        </tr>
                        {/foreach}
                        {if $users|@count == 0}
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i>Tidak ada pengguna.</i>
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
