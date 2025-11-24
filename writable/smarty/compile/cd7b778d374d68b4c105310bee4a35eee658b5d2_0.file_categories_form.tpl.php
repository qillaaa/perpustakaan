<?php
/* Smarty version 5.6.0, created on 2025-11-19 03:28:46
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/categories/categories_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691d396ee1b515_80568165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd7b778d374d68b4c105310bee4a35eee658b5d2' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/categories/categories_form.tpl',
      1 => 1763522921,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691d396ee1b515_80568165 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\categories';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1978495228691d396ee067b0_21558572', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_1978495228691d396ee067b0_21558572 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\categories';
?>

<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-0">
                <?php if ((true && ($_smarty_tpl->hasVariable('category') && null !== ($_smarty_tpl->getValue('category') ?? null)))) {?> Edit Kategori <?php } else { ?> Tambah Kategori <?php }?>
            </h5>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-4">

            <form method="post"
                action="<?php if ((true && ($_smarty_tpl->hasVariable('category') && null !== ($_smarty_tpl->getValue('category') ?? null)))) {
echo $_smarty_tpl->getValue('base_url');?>
admin/categories/update/<?php echo $_smarty_tpl->getValue('category')['kategori_id'];
} else {
echo $_smarty_tpl->getValue('base_url');?>
admin/categories/store<?php }?>">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control"
                        value="<?php echo (($tmp = $_smarty_tpl->getValue('category')['nama_kategori'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/categories" class="btn btn-secondary px-4">← Kembali</a>

                    <button type="submit" class="btn btn-dark px-5 fw-semibold">
                        💾 Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
<?php
}
}
/* {/block "main"} */
}
