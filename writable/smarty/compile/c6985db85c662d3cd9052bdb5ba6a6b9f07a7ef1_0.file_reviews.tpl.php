<?php
/* Smarty version 5.6.0, created on 2025-11-19 04:06:34
  from 'file:user/reviews.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691d424a1804d7_76899605',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6985db85c662d3cd9052bdb5ba6a6b9f07a7ef1' => 
    array (
      0 => 'user/reviews.tpl',
      1 => 1763111489,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691d424a1804d7_76899605 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_189384241691d4249cade72_29439728', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_189384241691d4249cade72_29439728 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>

<div class="container py-5">

    <h2 class="fw-bold mb-4 text-center">📚 Daftar Buku yang Dipinjam</h2>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('borrowedBooks')) > 0) {?>
    <div class="row">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('borrowedBooks'), 'book');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('book')->value) {
$foreach0DoElse = false;
?>
        <div class="col-md-6 mb-4">
            <div class="card p-3 shadow-sm d-flex flex-row align-items-center gap-3">
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('book')['cover'] ?? null))) && $_smarty_tpl->getValue('book')['cover'] != '') {?>
                    <?php $_smarty_tpl->assign('cover', "uploads/covers/".((string)$_smarty_tpl->getValue('book')['cover']), false, NULL);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->assign('cover', "assets/images/default-book.png", false, NULL);?>
                <?php }?>
                <img src="<?php echo $_smarty_tpl->getValue('base_url');
echo $_smarty_tpl->getValue('cover');?>
" style="width:80px;height:110px;object-fit:cover;" class="rounded">

                <div>
                    <h5 class="fw-bold mb-1"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h5>
                    <small class="text-muted">Tanggal Pinjam: <?php echo (($tmp = $_smarty_tpl->getValue('book')['tgl_pinjam'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</small><br>
                    <small class="text-muted">Tanggal Kembali: <?php echo (($tmp = $_smarty_tpl->getValue('book')['tgl_kembali'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</small>
                </div>
            </div>
        </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
    <?php } else { ?>
    <div class="alert alert-info text-center">Belum ada buku yang dipinjam 😢</div>
    <?php }?>

    <h2 class="fw-bold mb-4 text-center">📝 Riwayat Ulasan Kamu</h2>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('reviews')) > 0) {?>
    <div class="row">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'row');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('row')->value) {
$foreach1DoElse = false;
?>
        <div class="col-md-6 mb-4">
            <div class="card p-3 shadow-sm d-flex flex-row gap-3 align-items-start">
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
