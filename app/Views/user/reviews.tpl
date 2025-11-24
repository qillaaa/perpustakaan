{extends file="layout_user.tpl"}

{block name="main_content"}

<style>
.table thead th {
    background-color: #f0f0f0;
    color: #000;
}
.table tbody tr:hover {
    background-color: #f9f9f9;
}
.card {
    background-color: #fff;
    border: 1px solid #000;
    color: #000;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-radius: 12px;
    transition: all 0.2s;
}
.card:hover {
    transform: translateY(-3px);
}
.text-warning {
    color: #ffb700 !important;
}
.text-muted {
    color: #555 !important;
}
.alert-info {
    background-color: #f8f8f8 !important;
    color: #000 !important;
    border: 1px solid #000;
}
</style>

<div class="container py-5">

    <h2 class="fw-bold mb-4 text-center">📚 Daftar Buku yang Dipinjam</h2>

    {if $borrowedBooks|@count > 0}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Ulasan</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$borrowedBooks item=book name=idx}
                <tr>
                    <td>{$smarty.foreach.idx.index+1}</td>
                    <td>
                        {if isset($book.cover) && $book.cover != ''}
                            {assign var=cover value="uploads/covers/`$book.cover`"}
                        {else}
                            {assign var=cover value="assets/images/default-book.png"}
                        {/if}
                        <img src="{$base_url}{$cover}" style="width:60px;height:90px;object-fit:cover;" class="rounded">
                    </td>
                    <td>{$book.judul|default:'-'|escape}</td>
                    <td>{$book.tgl_pinjam|default:'-'}</td>
                    <td>{$book.tgl_kembali|default:'-'}</td>
                    <td>
                        {if $book.can_review}
                            <a href="{$base_url}/user/reviews/add/{$book.peminjaman_id}" class="btn btn-sm btn-primary">Beri Ulasan</a>
                        {else}
                            <span class="text-success">Sudah Diulas</span>
                        {/if}
                    </td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
    {else}
    <div class="alert alert-info text-center">Belum ada buku yang dipinjam 😢</div>
    {/if}

    <h2 class="fw-bold mb-4 text-center mt-5">📝 Riwayat Ulasan Kamu</h2>

    {if $reviews|@count > 0}
    <div class="row">
        {foreach from=$reviews item=row}
        <div class="col-md-6 mb-4">
            <div class="card p-3 d-flex flex-row gap-3 align-items-start">
                {if isset($row.cover) && $row.cover != ''}
                    {assign var=cover value="uploads/covers/`$row.cover`"}
                {else}
                    {assign var=cover value="assets/images/default-book.png"}
                {/if}
                <img src="{$base_url}{$cover}" style="width:80px;height:110px;object-fit:cover;" class="rounded">

                <div>
                    <h5 class="fw-bold mb-1">{$row.judul_buku|default:'-'|escape}</h5>
                    <div class="text-warning mb-1">⭐ {$row.rating|default:'0'} / 5</div>
                    <p class="mb-1">{$row.komentar|default:'-'|escape}</p>
                    <small class="text-muted">{$row.created_at|default:'-'}</small>
                </div>
            </div>
        </div>
        {/foreach}
    </div>
    {else}
    <div class="alert alert-info text-center">Kamu belum membuat ulasan buku 😢</div>
    {/if}

</div>

{/block}
