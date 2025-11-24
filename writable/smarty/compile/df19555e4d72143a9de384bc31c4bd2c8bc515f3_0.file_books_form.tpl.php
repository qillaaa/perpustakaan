<?php
/* Smarty version 5.6.0, created on 2025-11-20 18:51:07
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/books/books_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691f631b44d696_93975782',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df19555e4d72143a9de384bc31c4bd2c8bc515f3' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/books/books_form.tpl',
      1 => 1763664572,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691f631b44d696_93975782 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\books';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1068261608691f631b3fb4f2_77750309', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "scripts"} */
class Block_542548235691f631b444bc0_60430657 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\books';
?>

<?php echo '<script'; ?>
 src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
ClassicEditor.create(document.querySelector('#editor'))
    .catch(error => console.error(error));
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "scripts"} */
/* {block "main"} */
class Block_1068261608691f631b3fb4f2_77750309 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\books';
?>

<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-0">
                <?php if ((true && ($_smarty_tpl->hasVariable('book') && null !== ($_smarty_tpl->getValue('book') ?? null)))) {?> Edit Buku <?php } else { ?> Tambah Buku <?php }?>
            </h5>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-4">

            <form method="post"
                action="<?php if ((true && ($_smarty_tpl->hasVariable('book') && null !== ($_smarty_tpl->getValue('book') ?? null)))) {
echo $_smarty_tpl->getValue('base_url');?>
admin/books/update/<?php echo (($tmp = $_smarty_tpl->getValue('book')['book_id'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);
} else {
echo $_smarty_tpl->getValue('base_url');?>
admin/books/store<?php }?>"
                enctype="multipart/form-data">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul Buku</label>
                        <input type="text" name="judul" class="form-control" value="<?php echo (($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penulis</label>
                        <input type="text" name="penulis" class="form-control" value="<?php echo (($tmp = $_smarty_tpl->getValue('book')['penulis'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" value="<?php echo (($tmp = $_smarty_tpl->getValue('book')['penerbit'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control" value="<?php echo (($tmp = $_smarty_tpl->getValue('book')['tahun_terbit'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <?php if ((true && ($_smarty_tpl->hasVariable('categories') && null !== ($_smarty_tpl->getValue('categories') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('categories')) > 0) {?>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'cat');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('cat')->value) {
$foreach0DoElse = false;
?>
                                    <option value="<?php echo $_smarty_tpl->getValue('cat')['kategori_id'];?>
" <?php if ((true && ($_smarty_tpl->hasVariable('book') && null !== ($_smarty_tpl->getValue('book') ?? null))) && $_smarty_tpl->getValue('book')['kategori_id'] == $_smarty_tpl->getValue('cat')['kategori_id']) {?>selected<?php }?>>
                                        <?php echo $_smarty_tpl->getValue('cat')['nama_kategori'];?>

                                    </option>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </select>
                        <?php } else { ?>
                            <div class="alert alert-warning mb-0">Kategori tidak tersedia. Silakan tambah kategori terlebih dahulu.</div>
                        <?php }?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" id="editor" rows="6" class="form-control"><?php echo (($tmp = $_smarty_tpl->getValue('book')['deskripsi'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">File Buku (PDF)</label>
                        <input type="file" name="file_buku" class="form-control">

                        <?php if ((true && ($_smarty_tpl->hasVariable('book') && null !== ($_smarty_tpl->getValue('book') ?? null))) && $_smarty_tpl->getValue('book')['file_buku']) {?>
                            <small>File saat ini: 
                                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/ebooks/<?php echo $_smarty_tpl->getValue('book')['file_buku'];?>
" target="_blank">
                                    <?php echo $_smarty_tpl->getValue('book')['file_buku'];?>

                                </a>
                            </small>
                        <?php }?>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Cover Buku</label>
                        <input type="file" name="cover" class="form-control">

                        <?php if ((true && ($_smarty_tpl->hasVariable('book') && null !== ($_smarty_tpl->getValue('book') ?? null))) && $_smarty_tpl->getValue('book')['cover']) {?>
                            <small>
                                Cover saat ini: 
                                <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('book')['cover'];?>
" width="60">
                            </small>
                        <?php }?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Akses Buku</label>
                    <input type="number" name="stok" class="form-control" value="<?php echo (($tmp = $_smarty_tpl->getValue('book')['stok'] ?? null)===null||$tmp==='' ? 1 ?? null : $tmp);?>
" min="1">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/books" class="btn btn-secondary px-4">← Kembali</a>
                    <button type="submit" class="btn btn-dark px-5 fw-semibold">
                        <?php if ((true && ($_smarty_tpl->hasVariable('book') && null !== ($_smarty_tpl->getValue('book') ?? null)))) {?> Update Buku <?php } else { ?> Simpan Buku <?php }?>
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_542548235691f631b444bc0_60430657', "scripts", $this->tplIndex);
?>


<?php
}
}
/* {/block "main"} */
}
