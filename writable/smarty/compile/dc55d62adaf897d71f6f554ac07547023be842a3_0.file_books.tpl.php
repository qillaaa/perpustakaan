<?php
/* Smarty version 5.6.0, created on 2025-11-06 06:39:59
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/books.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_690c42bf5afc55_69777097',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc55d62adaf897d71f6f554ac07547023be842a3' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/books.tpl',
      1 => 1762411055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690c42bf5afc55_69777097 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_462213642690c42bf138c84_63738808', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_462213642690c42bf138c84_63738808 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-gradient-pink text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0"><i class="material-symbols-rounded me-2">menu_book</i> Data Buku</h5>
          <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/books/create" class="btn btn-light text-dark btn-sm rounded-pill px-3">
            <i class="material-symbols-rounded me-1">add</i> Tambah Buku
          </a>
        </div>

        <div class="card-body px-4 py-3">
          <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null)))) {?>
            <div class="alert alert-success"><?php echo $_smarty_tpl->getValue('success');?>
</div>
          <?php }?>

          <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
              <thead class="bg-gradient-pink text-white">
                <tr>
                  <th>ID</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Penerbit</th>
                  <th>Tahun</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('books'), 'book');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('book')->value) {
$foreach0DoElse = false;
?>
                  <tr>
                    <td><?php echo $_smarty_tpl->getValue('book')['id'];?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('book')['judul'];?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('book')['penulis'];?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('book')['penerbit'];?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('book')['tahun_terbit'];?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('book')['kategori'];?>
</td>
                    <td>
                      <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/books/delete/<?php echo $_smarty_tpl->getValue('book')['id'];?>
" 
                         class="btn btn-sm btn-danger rounded-pill px-3"
                         onclick="return confirm('Yakin ingin menghapus buku ini?');">
                        <i class="material-symbols-rounded">delete</i>
                      </a>
                    </td>
                  </tr>
                <?php
}
if ($foreach0DoElse) {
?>
                  <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                      <i class="material-symbols-rounded d-block mb-2">menu_book</i>
                      Belum ada data buku
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
  </div>
</div>
<?php
}
}
/* {/block "main"} */
}
