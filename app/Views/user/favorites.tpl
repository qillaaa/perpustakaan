{extends file="layout_user.tpl"}

{block name="main_content"}
<style>
table {
    width: 100%;
    border-collapse: collapse;
    color: #000;
}
th, td {
    padding: 0.75rem;
    border: 1px solid #000;
    text-align: left;
}
th {
    background-color: #f5f5f5;
}
.btn-unlike {
    background-color: #000;
    color: #fff;
    border: 1px solid #000;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.85rem;
    transition: 0.2s;
    cursor: pointer;
}
.btn-unlike:hover {
    background-color: #fff;
    color: #000;
}
.cover-img {
    width: 60px;
    height: 90px;
    object-fit: cover;
    border-radius: 4px;
}
</style>

<div class="container py-4">
    <h4 class="fw-bold mb-3">❤️ Buku Favorit Saya</h4>

    {if $favorites|@count == 0}
        <p class="text-muted mt-2">Belum ada buku favorit.</p>
    {else}
    <table>
        <thead>
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {foreach $favorites as $f}
                {assign var=f_id value=$f.book_id|default:$f.id|default:$f.id_buku|default:''}
                {assign var=f_cover value=$f.cover|default:"{$base_url|escape}assets/img/no-cover.png"}
                <tr>
                    <td><img src="{$f_cover}" class="cover-img" alt="{$f.judul|escape}"></td>
                    <td>{$f.judul|default:'-'|escape}</td>
                    <td>{$f.penulis|default:'-'|escape}</td>
                    <td>
                        {if $f_id}
                        <a href="{$base_url}/user/favorites/remove/{$f_id}" class="btn-unlike">Unlike</a>
                        {/if}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    {/if}
</div>

{/block}
