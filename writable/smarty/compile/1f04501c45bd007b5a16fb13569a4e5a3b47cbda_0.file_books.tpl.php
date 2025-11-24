<?php
/* Smarty version 5.6.0, created on 2025-11-20 18:50:40
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/books/books.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691f6300155108_71176797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f04501c45bd007b5a16fb13569a4e5a3b47cbda' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/books/books.tpl',
      1 => 1763664553,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691f6300155108_71176797 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\books';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1506423949691f62ffaa11e5_24111689', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_1506423949691f62ffaa11e5_24111689 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\books';
?>

<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-4 border-0 bg-white">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">
                <i class="material-symbols-rounded me-2">menu_book</i> Data Buku
            </h5>

            <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/books/create" 
               class="btn btn-dark btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                <i class="material-symbols-rounded me-1">add</i> Tambah Buku
            </a>
        </div>
    </div>

    <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null)))) {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_smarty_tpl->getValue('success');?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }?>

    <!-- Search -->
    <div class="mb-3">
        <form method="get" action="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/books" class="d-flex align-items-center w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari buku..." 
                   value="<?php echo (($tmp = $_smarty_tpl->getValue('q') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                 Cari
            </button>
            <?php if ($_smarty_tpl->getValue('q')) {?>
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/books" 
                   class="btn btn-outline-secondary rounded-pill ms-2 py-1" 
                   style="height:38px; font-size:0.9rem;">Reset</a>
            <?php }?>
        </form>
    </div>

    <!-- Tabel Buku -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">ID</th>
                            <th style="width:80px;">Cover</th>
                            <th class="text-start">Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th>Akses</th>
                            <th>File</th>
                            <th style="width:130px;">Aksi</th>
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
                                <td><?php echo $_smarty_tpl->getValue('book')['book_id'];?>
</td>
                                <td>
                                    <?php if ($_smarty_tpl->getValue('book')['cover']) {?>
                                        <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('book')['cover'];?>
" 
                                             class="rounded-3 shadow-sm" 
                                             style="width:60px; height:80px; object-fit:cover;">
                                    <?php } else { ?>
                                        <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
assets/img/no-cover.png" 
                                             class="rounded-3 shadow-sm" 
                                             style="width:60px; height:80px; object-fit:cover;">
                                    <?php }?>
                                </td>
                                <td class="text-start fw-semibold"><?php echo $_smarty_tpl->getValue('book')['judul'];?>
</td>
                                <td><?php echo (($tmp = $_smarty_tpl->getValue('book')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</td>
                                <td><?php echo (($tmp = $_smarty_tpl->getValue('book')['penerbit'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</td>
                                <td><?php echo (($tmp = $_smarty_tpl->getValue('book')['tahun_terbit'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</td>
                                <td><?php echo (($tmp = $_smarty_tpl->getValue('book')['kategori'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</td>
                                <td>
                                    <?php $_smarty_tpl->assign('stokDipinjam', $_smarty_tpl->getValue('book')['stok']-$_smarty_tpl->getValue('book')['dipinjam'], false, NULL);?>
                                    <?php echo (($tmp = $_smarty_tpl->getValue('stokDipinjam') ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>

                                </td>
                                <td>
                                    <?php if ($_smarty_tpl->getValue('book')['file_buku']) {?>
                                        <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/ebooks/<?php echo $_smarty_tpl->getValue('book')['file_buku'];?>
" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                            <i class="material-symbols-rounded me-1">visibility</i> Lihat
                                        </a>
                                    <?php } else { ?>
                                        <span class="text-muted">-</span>
                                    <?php }?>
                                </td>
                                <td>
                                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/books/edit/<?php echo $_smarty_tpl->getValue('book')['book_id'];?>
" 
                                       class="btn btn-sm btn-dark rounded-pill px-3 mb-1 shadow-sm">
                                        <i class="material-symbols-rounded">edit</i>
                                    </a>
                                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/books/delete/<?php echo $_smarty_tpl->getValue('book')['book_id'];?>
" 
                                       class="btn btn-sm btn-danger rounded-pill px-3 mb-1 shadow-sm"
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
                                <td colspan="10" class="text-center text-muted py-4">
                                    <i class="material-symbols-rounded d-block mb-2 fs-1 opacity-50">menu_book</i>
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
<?php
}
}
/* {/block "main"} */
}
