{extends file="layout_user.tpl"}

{block name="main_content"}

<h3 class="fw-bold mb-4">Profil Saya</h3>

<div class="row g-4">

    {* ========================== *}
    {* BAGIAN KIRI: INFO PROFIL  *}
    {* ========================== *}
    <div class="col-md-4">
        <div class="card p-4 shadow-sm text-center">

            {* Default avatar jika user.avatar_url null *}
           {assign var="avatarUrl" value=$user.avatar_url|default:'assets/images/default-avatar.png'}
<img src="{$base_url}/{$avatarUrl}" 
     class="rounded-circle shadow-sm mx-auto my-3"
     width="140" height="140"
     style="object-fit: cover;">

            <h5 class="fw-bold mb-0">{$user.username}</h5>
            <p class="text-muted small mb-3">{$user.email}</p>

            <hr>

            <p class="mb-1"><strong>User ID:</strong> {$user.id}</p>

            {if $user.created_at}
                <p class="mb-1"><strong>Bergabung:</strong> {$user.created_at|date_format:"%d %b %Y"}</p>
            {/if}

        </div>
    </div>


    {* =========================== *}
    {* BAGIAN KANAN: FORM UPDATE   *}
    {* =========================== *}
    <div class="col-md-8">
        <div class="card p-4 shadow-sm">

            {if $error}
                <div class="alert alert-danger">{$error}</div>
            {/if}

            {if $message}
                <div class="alert alert-success">{$message}</div>
            {/if}

            <form action="{$base_url}/user/profile/update" method="post" enctype="multipart/form-data">

                <label class="fw-semibold mt-2">Username:</label>
                <input type="text" class="form-control" name="username"
                       value="{$user.username}" required>

                <label class="fw-semibold mt-3">Email:</label>
                <input type="email" class="form-control" name="email"
                       value="{$user.email}" required>

                <label class="fw-semibold mt-3">Password (kosongkan jika tidak diubah):</label>
                <input type="password" class="form-control" name="password">

                <label class="fw-semibold mt-3">Avatar:</label>
                <input type="file" class="form-control" name="avatar">

                <button type="submit" class="btn btn-dark mt-4 w-100">
                    <i class="bi bi-check-circle me-1"></i> Update Profil
                </button>

            </form>
        </div>
    </div>

</div>

{/block}
