<?php
/* Smarty version 5.6.0, created on 2025-11-20 18:51:35
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/categories/categories.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691f63376f6e80_10887717',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b98d84ad3ea5d94c18e5fa9d4929ae65e88a1b6' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/categories/categories.tpl',
      1 => 1763664624,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691f63376f6e80_10887717 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\categories';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_720679206691f633768d554_78752173', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_720679206691f633768d554_78752173 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\categories';
?>

<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-4 border-0 bg-white">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Data Kategori Buku</h5>

            <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/categories/create" 
               class="btn btn-dark btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                ➕ Tambah Kategori
            </a>
        </div>
    </div>

    <?php if ($_smarty_tpl->getValue('success')) {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_smarty_tpl->getValue('success');?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }?>

    <!-- Search Input Panjang -->
    <div class="mb-3">
        <form method="get" action="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/categories" class="d-flex align-items-center w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari kategori..." 
                   value="<?php echo (($tmp = $_smarty_tpl->getValue('q') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                 Cari
            </button>
            <?php if ($_smarty_tpl->getValue('q')) {?>
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/categories" 
                   class="btn btn-outline-secondary rounded-pill ms-2 py-1" 
                   style="height:38px; font-size:0.9rem;">Reset</a>
            <?php }?>
        </form>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Buku</th>
                            <th>Total Akses</th>
                            <th style="width:150px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'cat', false, NULL, 'loop', array (
  'index' => true,
));
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('cat')->value) {
$foreach0DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_loop']->value['index']++;
?>
                            <tr>
                                <td><?php echo ($_smarty_tpl->getValue('__smarty_foreach_loop')['index'] ?? null)+1;?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('cat')['nama_kategori'];?>
</td>
                                <td><?php echo (($tmp = $_smarty_tpl->getValue('cat')['jumlah_buku'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</td>
                                <td><?php echo (($tmp = $_smarty_tpl->getValue('cat')['total_stok'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</td>
                                <td>
                                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/categories/edit/<?php echo $_smarty_tpl->getValue('cat')['kategori_id'];?>
" 
                                       class="btn btn-sm btn-dark rounded-pill px-3 mb-1 shadow-sm">
                                        ✏️ Edit
                                    </a>

                                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/categories/delete/<?php echo $_smarty_tpl->getValue('cat')['kategori_id'];?>
" 
                                       class="btn btn-sm btn-danger rounded-pill px-3 mb-1 shadow-sm"
                                       onclick="return confirm('Yakin mau hapus kategori ini?')">
                                        🗑️ Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php
}
if ($foreach0DoElse) {
?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="material-symbols-rounded d-block mb-2 fs-1 opacity-50">category</i>
                                    Belum ada kategori buku
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php
}
}
/* {/block "main"} */
}
