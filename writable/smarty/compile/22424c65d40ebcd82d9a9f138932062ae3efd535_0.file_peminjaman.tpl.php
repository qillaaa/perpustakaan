<?php
/* Smarty version 5.6.0, created on 2025-11-20 03:35:15
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/peminjaman/peminjaman.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691e8c73416798_19853378',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22424c65d40ebcd82d9a9f138932062ae3efd535' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/peminjaman/peminjaman.tpl',
      1 => 1763543955,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691e8c73416798_19853378 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\peminjaman';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_905196160691e8c73328815_33464839', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_905196160691e8c73328815_33464839 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\peminjaman';
?>

<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-4 border-0 bg-white">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">
                <i class="material-symbols-rounded me-2">menu_book</i> Data Peminjaman
            </h5>
        </div>
    </div>

    <!-- Alert -->
    <?php if ((true && ($_smarty_tpl->hasVariable('message') && null !== ($_smarty_tpl->getValue('message') ?? null)))) {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_smarty_tpl->getValue('message');?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }?>

    <!-- Search Input -->
    <div class="mb-3">
        <form method="get" action="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/peminjaman" class="d-flex align-items-center w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari username atau judul buku..." 
                   value="<?php echo (($tmp = $_smarty_tpl->getValue('q') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                Cari
            </button>
            <?php if ($_smarty_tpl->getValue('q')) {?>
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/peminjaman" 
                   class="btn btn-outline-secondary rounded-pill ms-2 py-1" 
                   style="height:38px; font-size:0.9rem;">Reset</a>
            <?php }?>
        </form>
    </div>

    <!-- Tabel Peminjaman -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Username</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th style="width:150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('peminjaman'), 'p', false, 'k');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('k')->value => $_smarty_tpl->getVariable('p')->value) {
$foreach0DoElse = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getValue('k')+1;?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('p')['user_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('p')['book_title'];?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('p')['tgl_pinjam'];?>
</td>
                            <td><?php echo (($tmp = $_smarty_tpl->getValue('p')['tgl_kembali'] ?? null)===null||$tmp==='' ? "-" ?? null : $tmp);?>
</td>
                            <td>
                                <span class="badge <?php if ($_smarty_tpl->getValue('p')['status'] == 'Dipinjam') {?>bg-warning text-dark<?php } else { ?>bg-success text-white<?php }?>">
                                    <?php echo $_smarty_tpl->getValue('p')['status'];?>

                                </span>
                            </td>
                            <td>
                                <?php if ($_smarty_tpl->getValue('p')['status'] == 'Dipinjam') {?>
                                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/peminjaman/kembalikan/<?php echo $_smarty_tpl->getValue('p')['peminjaman_id'];?>
"
                                       class="btn btn-sm btn-success"
                                       onclick="return confirm('Konfirmasi pengembalian?')">
                                       ✔ Kembalikan
                                    </a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php
}
if ($foreach0DoElse) {
?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="material-symbols-rounded d-block mb-2 fs-1 opacity-50">menu_book</i>
                                Belum ada data peminjaman
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
