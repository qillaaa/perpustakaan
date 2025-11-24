{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-0">
                {if isset($category)} Edit Kategori {else} Tambah Kategori {/if}
            </h5>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-4">

            <form method="post"
                action="{if isset($category)}{$base_url}admin/categories/update/{$category.kategori_id}{else}{$base_url}admin/categories/store{/if}">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control"
                        value="{$category.nama_kategori|default:''}" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{$base_url}admin/categories" class="btn btn-secondary px-4">← Kembali</a>

                    <button type="submit" class="btn btn-dark px-5 fw-semibold">
                        💾 Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
{/block}
