<?php
/* Smarty version 5.6.0, created on 2025-11-20 08:12:31
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/cart.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691ecd6ff0e489_59023819',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2d56edca4047cc8deca002b3e970648f3c30cbd' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/cart.tpl',
      1 => 1763620975,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691ecd6ff0e489_59023819 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2106619552691ecd6feea346_99448868', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_2106619552691ecd6feea346_99448868 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>


<style>
.card-item {
    background-color: #fff;
    border: 1px solid #000;
    color: #000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 12px;
    transition: all 0.2s;
}
.card-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.text-muted {
    color: #555 !important;
}
h6.fw-semibold {
    color: #000;
}
.btn-checkout {
    background-color: #000;
    border-color: #000;
    color: #fff;
    transition: all 0.2s;
}
.btn-checkout:hover {
    background-color: #444;
    border-color: #444;
}
</style>

<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center" style="color:#000;">🛒 Konfirmasi Checkout</h2>

  <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('cartItems')) > 0) {?>
    <div class="row">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cartItems'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
        <div class="col-12 mb-3">
          <div class="card-item p-3 d-flex flex-row align-items-center">
            <img src="<?php if ($_smarty_tpl->getValue('item')['cover']) {
echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('item')['cover'], ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->getValue('base_url');?>
assets/img/no-cover.png<?php }?>" 
                 alt="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('item')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" 
                 style="width:80px; height:100px; object-fit:cover; border-radius:8px;">
            <div class="ms-3">
              <h6 class="fw-semibold mb-1"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('item')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h6>
              <p class="text-muted small mb-0"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('item')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</p>
            </div>
          </div>
        </div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>

    <form method="post" action="<?php echo $_smarty_tpl->getValue('base_url');?>
user/cart/checkout" class="mt-4 text-center">
      <button type="submit" class="btn btn-checkout btn-lg px-4 shadow-sm">
        <i class="bi bi-bag-check me-1"></i> Konfirmasi Checkout
      </button>
    </form>
  <?php } else { ?>
    <p class="text-center text-muted mt-5">Keranjangmu kosong 😅</p>
  <?php }?>
</div>

<?php
}
}
/* {/block "main_content"} */
}
