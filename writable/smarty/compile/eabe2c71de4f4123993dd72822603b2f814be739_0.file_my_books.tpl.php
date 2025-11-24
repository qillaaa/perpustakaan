<?php
/* Smarty version 5.6.0, created on 2025-11-12 04:14:45
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/my_books.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691409b55ab496_44406076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eabe2c71de4f4123993dd72822603b2f814be739' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/my_books.tpl',
      1 => 1762920834,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691409b55ab496_44406076 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1471726434691409b5581976_73740803', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_1471726434691409b5581976_73740803 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>

<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">📖 Buku Saya</h2>

  <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('loans')) > 0) {?>
    <div class="row mt-4">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('loans'), 'loan');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('loan')->value) {
$foreach0DoElse = false;
?>
        <div class="col-6 col-md-4 col-lg-3 mb-4">
          <div class="card h-100 shadow-sm border-0 rounded-4">
            <img src="<?php if ($_smarty_tpl->getValue('loan')['cover']) {
echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('loan')['cover'];
} else {
echo $_smarty_tpl->getValue('base_url');?>
assets/img/no-cover.png<?php }?>" 
                 class="card-img-top rounded-top-4" 
                 alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('loan')['judul'], ENT_QUOTES, 'UTF-8', true);?>
" 
                 style="height:200px; object-fit:cover;">
            <div class="card-body d-flex flex-column text-center">
              <h6 class="fw-semibold text-truncate"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('loan')['judul'], ENT_QUOTES, 'UTF-8', true);?>
</h6>
              <p class="text-muted small mb-1">Dipinjam: <?php echo $_smarty_tpl->getValue('loan')['tgl_pinjam'];?>
</p>
              <p class="text-muted small mb-3">Expired: <?php echo $_smarty_tpl->getValue('loan')['tgl_expired'];?>
</p>
              <span class="badge <?php if ($_smarty_tpl->getValue('loan')['status'] == 'Expired') {?>bg-danger<?php } else { ?>bg-success<?php }?> mb-2"><?php echo $_smarty_tpl->getValue('loan')['status'];?>
</span>
              <?php if ($_smarty_tpl->getValue('loan')['status'] != 'Expired') {?>
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/books/<?php echo $_smarty_tpl->getValue('loan')['file_buku'];?>
" 
                   target="_blank" 
                   class="btn btn-outline-primary btn-sm mt-auto w-100">
                   <i class="bi bi-book"></i> Baca Buku
                </a>
              <?php }?>
            </div>
          </div>
        </div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
  <?php } else { ?>
    <div class="text-center mt-5">
      <p class="text-muted">Belum ada buku yang dipinjam 😅</p>
      <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/books" class="btn btn-outline-success mt-2">
        <i class="bi bi-arrow-left"></i> Jelajahi Buku
      </a>
    </div>
  <?php }?>
</div>
<?php
}
}
/* {/block "main_content"} */
}
