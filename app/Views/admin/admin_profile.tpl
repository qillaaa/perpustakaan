{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <h3 class="fw-bold mb-4 text-center">Profil Admin</h3>

    <div class="row g-4">

        {* ========================== *}
        {* BAGIAN KIRI: INFO PROFIL  *}
        {* ========================== *}
        <div class="col-md-4">
            <div class="card p-4 shadow-sm text-center bg-white">

                <img src="{$user.avatar_url|default:'assets/img/default-avatar.png'}" 
                     class="rounded-circle shadow-sm mx-auto my-3"
                     width="140" height="140"
                     style="object-fit: cover;">

                <h5 class="fw-bold mb-0">{$user.username}</h5>
                {if isset($user.status_message) && $user.status_message}
                    <p class="text-muted small mb-3">{$user.status_message}</p>
                {/if}

                <hr>

                <p class="mb-1"><strong>User ID:</strong> {$user.id}</p>
                <p class="mb-1"><strong>Email:</strong> {$user.email|default:''}</p>
                <p class="mb-1"><strong>Role:</strong> {$user.role|default:'Admin'}</p>

                {if isset($user.created_at) && $user.created_at}
                    <p class="mb-1"><strong>Bergabung:</strong> {$user.created_at|date_format:"%d %b %Y"}</p>
                {/if}
            </div>
        </div>

        {* =========================== *}
        {* BAGIAN KANAN: FORM UPDATE   *}
        {* =========================== *}
        <div class="col-md-8">
            <div class="card p-4 shadow-sm bg-white">

                {if isset($error) && $error}
                    <div class="alert alert-danger">{$error}</div>
                {/if}

                {if isset($success) && $success}
                    <div class="alert alert-success">{$success}</div>
                {/if}

                <form action="{$base_url}/admin/profile/update" method="post" enctype="multipart/form-data">

                    <label class="fw-semibold mt-2">Username:</label>
                    <input type="text" class="form-control" name="username"
                           value="{$user.username}" required>

                    <label class="fw-semibold mt-3">Email:</label>
                    <input type="email" class="form-control" name="email"
                           value="{$user.email|default:''}" required>

                    <label class="fw-semibold mt-3">Password (kosongkan jika tidak ingin diubah):</label>
                    <input type="password" class="form-control" name="password">

                    <label class="fw-semibold mt-3">Status Message:</label>
                    <input type="text" class="form-control" name="status_message"
                           value="{$user.status_message|default:''}">

                    <label class="fw-semibold mt-3">Avatar:</label>
                    <input type="file" class="form-control" name="avatar" accept="image/*">

                    <button type="submit" class="btn btn-dark mt-4 w-100">
                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
{/block}
