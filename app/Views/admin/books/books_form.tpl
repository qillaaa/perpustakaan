{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-0">
                {if isset($book)} Edit Buku {else} Tambah Buku {/if}
            </h5>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-4">

            <form method="post"
                action="{if isset($book)}{$base_url}admin/books/update/{$book.book_id|default:''}{else}{$base_url}admin/books/store{/if}"
                enctype="multipart/form-data">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul Buku</label>
                        <input type="text" name="judul" class="form-control" value="{$book.judul|default:''}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penulis</label>
                        <input type="text" name="penulis" class="form-control" value="{$book.penulis|default:''}">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" value="{$book.penerbit|default:''}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control" value="{$book.tahun_terbit|default:''}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        {if isset($categories) && $categories|@count > 0}
                            <select name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                {foreach from=$categories item=cat}
                                    <option value="{$cat.kategori_id}" {if isset($book) && $book.kategori_id == $cat.kategori_id}selected{/if}>
                                        {$cat.nama_kategori}
                                    </option>
                                {/foreach}
                            </select>
                        {else}
                            <div class="alert alert-warning mb-0">Kategori tidak tersedia. Silakan tambah kategori terlebih dahulu.</div>
                        {/if}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" id="editor" rows="6" class="form-control">{$book.deskripsi|default:''}</textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">File Buku (PDF)</label>
                        <input type="file" name="file_buku" class="form-control">

                        {if isset($book) && $book.file_buku}
                            <small>File saat ini: 
                                <a href="{$base_url}uploads/ebooks/{$book.file_buku}" target="_blank">
                                    {$book.file_buku}
                                </a>
                            </small>
                        {/if}
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Cover Buku</label>
                        <input type="file" name="cover" class="form-control">

                        {if isset($book) && $book.cover}
                            <small>
                                Cover saat ini: 
                                <img src="{$base_url}uploads/covers/{$book.cover}" width="60">
                            </small>
                        {/if}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Akses Buku</label>
                    <input type="number" name="stok" class="form-control" value="{$book.stok|default:1}" min="1">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{$base_url}admin/books" class="btn btn-secondary px-4">← Kembali</a>
                    <button type="submit" class="btn btn-dark px-5 fw-semibold">
                        {if isset($book)} Update Buku {else} Simpan Buku {/if}
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

{block name="scripts"}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#editor'))
    .catch(error => console.error(error));
</script>
{/block}

{/block}
