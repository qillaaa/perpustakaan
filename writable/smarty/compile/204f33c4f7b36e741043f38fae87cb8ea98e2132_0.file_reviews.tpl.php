<?php
/* Smarty version 5.6.0, created on 2025-11-20 17:28:07
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691f4fa72a16c7_01326130',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '204f33c4f7b36e741043f38fae87cb8ea98e2132' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/reviews.tpl',
      1 => 1763659681,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691f4fa72a16c7_01326130 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1475620585691f4fa7260cd5_99466030', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_1475620585691f4fa7260cd5_99466030 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>


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

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('borrowedBooks')) > 0) {?>
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
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('borrowedBooks'), 'book', false, NULL, 'idx', array (
  'index' => true,
));
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('book')->value) {
$foreach0DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_idx']->value['index']++;
?>
                <tr>
                    <td><?php echo ($_smarty_tpl->getValue('__smarty_foreach_idx')['index'] ?? null)+1;?>
</td>
                    <td>
                        <?php if ((true && (true && null !== ($_smarty_tpl->getValue('book')['cover'] ?? null))) && $_smarty_tpl->getValue('book')['cover'] != '') {?>
                            <?php $_smarty_tpl->assign('cover', "uploads/covers/".((string)$_smarty_tpl->getValue('book')['cover']), false, NULL);?>
                        <?php } else { ?>
                            <?php $_smarty_tpl->assign('cover', "assets/images/default-book.png", false, NULL);?>
                        <?php }?>
                        <img src="<?php echo $_smarty_tpl->getValue('base_url');
echo $_smarty_tpl->getValue('cover');?>
" style="width:60px;height:90px;object-fit:cover;" class="rounded">
                    </td>
                    <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo (($tmp = $_smarty_tpl->getValue('book')['tgl_pinjam'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</td>
                    <td><?php echo (($tmp = $_smarty_tpl->getValue('book')['tgl_kembali'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</td>
                    <td>
                        <?php if ($_smarty_tpl->getValue('book')['can_review']) {?>
                            <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/user/reviews/add/<?php echo $_smarty_tpl->getValue('book')['peminjaman_id'];?>
" class="btn btn-sm btn-primary">Beri Ulasan</a>
                        <?php } else { ?>
                            <span class="text-success">Sudah Diulas</span>
                        <?php }?>
                    </td>
                </tr>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
    </div>
    <?php } else { ?>
    <div class="alert alert-info text-center">Belum ada buku yang dipinjam 😢</div>
    <?php }?>

    <h2 class="fw-bold mb-4 text-center mt-5">📝 Riwayat Ulasan Kamu</h2>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('reviews')) > 0) {?>
    <div class="row">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'row');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('row')->value) {
$foreach1DoElse = false;
?>
        <div class="col-md-6 mb-4">
            <div class="card p-3 d-flex flex-row gap-3 align-items-start">
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('row')['cover'] ?? null))) && $_smarty_tpl->getValue('row')['cover'] != '') {?>
                    <?php $_smarty_tpl->assign('cover', "uploads/covers/".((string)$_smarty_tpl->getValue('row')['cover']), false, NULL);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->assign('cover', "assets/images/default-book.png", false, NULL);?>
                <?php }?>
                <img src="<?php echo $_smarty_tpl->getValue('base_url');
echo $_smarty_tpl->getValue('cover');?>
" style="width:80px;height:110px;object-fit:cover;" class="rounded">

                <div>
                    <h5 class="fw-bold mb-1"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('row')['judul_buku'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h5>
                    <div class="text-warning mb-1">⭐ <?php echo (($tmp = $_smarty_tpl->getValue('row')['rating'] ?? null)===null||$tmp==='' ? '0' ?? null : $tmp);?>
 / 5</div>
                    <p class="mb-1"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('row')['komentar'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <small class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('row')['created_at'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</small>
                </div>
            </div>
        </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
    <?php } else { ?>
    <div class="alert alert-info text-center">Kamu belum membuat ulasan buku 😢</div>
    <?php }?>

</div>

<?php
}
}
/* {/block "main_content"} */
}
