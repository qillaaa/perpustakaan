<?php
/* Smarty version 5.6.0, created on 2025-11-20 17:55:16
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691f560413ea76_25579407',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0aa7b8936dfc492df918fcf7473f01d29d2fd93e' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/dashboard.tpl',
      1 => 1763661310,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691f560413ea76_25579407 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1093888205691f56040fe9d1_05990291', 'main_content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout_user.tpl', $_smarty_current_dir);
}
/* {block 'main_content'} */
class Block_1093888205691f56040fe9d1_05990291 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>

<div class="py-4 main-content-area position-relative">

    <!-- Welcome -->
    <div class="text-center mb-5 mt-3">
        <h2 class="fw-bold">
            Hai! 
            <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/user/profile" class="text-decoration-none text-dark">
                <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('userName') ?? null)===null||$tmp==='' ? 'Tamu' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
 👋
            </a>
        </h2>
        <p class="text-muted">
            Selamat datang di <strong>Dashboard Pengguna</strong> Perpusku!
        </p>
    </div>

    <!-- Statistik -->
    <div class="row g-4 text-center mb-5">
        <div class="col-md-4">
            <div class="card rounded-4 p-4 h-100 hover-shadow">
                <i class="bi bi-book display-6 mb-2"></i>
                <h5 class="fw-semibold">Total Buku</h5>
                <h2 class="fw-bold"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('totalBooks') ?? null)===null||$tmp==='' ? 0 ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-4 p-4 h-100 hover-shadow">
                <i class="bi bi-bookmark-fill display-6 mb-2"></i>
                <h5 class="fw-semibold">Buku Dipinjam</h5>
                <h2 class="fw-bold"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('borrowedBooks') ?? null)===null||$tmp==='' ? 0 ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-4 p-4 h-100 hover-shadow">
                <i class="bi bi-heart-fill display-6 mb-2"></i>
                <h5 class="fw-semibold">Buku Favorit</h5>
                <h2 class="fw-bold"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('favoriteBooks') ?? null)===null||$tmp==='' ? 0 ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h2>
            </div>
        </div>
    </div>

    <!-- Buku Terbaru -->
    <div class="mb-5">
        <h4 class="mb-4 pb-2 fw-bold text-center" style="font-size:1.6rem;">Buku Terbaru</h4>
        <div class="row g-3">
            <?php if (!( !$_smarty_tpl->hasVariable('latestBooks') || empty($_smarty_tpl->getValue('latestBooks')))) {?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('latestBooks'), 'book');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('book')->value) {
$foreach0DoElse = false;
?>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card h-100 rounded-4 hover-shadow">
                            <img src="<?php if (!( !true || empty($_smarty_tpl->getValue('book')['cover']))) {
echo $_smarty_tpl->getValue('base_url');?>
/uploads/covers/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('book')['cover'], ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->getValue('base_url');?>
/assets/img/no-cover.png<?php }?>"  
                                 class="card-img-top rounded-top-4" 
                                 alt="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                 title="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                 style="height:240px; object-fit:cover;">
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title text-truncate fw-semibold mb-1"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('book')['judul'], ENT_QUOTES, 'UTF-8', true);?>
</h6>
                                <p class="card-text text-muted small mb-3">
                                    <i class="bi bi-person me-1"></i><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                                </p>
                                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/user/books/view/<?php echo $_smarty_tpl->getValue('book')['book_id'];?>
" class="btn btn-sm btn-outline-secondary mt-auto w-100">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <div class="col-12 text-center">
                    <p class="text-muted mt-3">Belum ada buku terbaru.</p>
                </div>
            <?php }?>
        </div>
    </div>

    <!-- Buku Populer Ber-Rating -->
    <div class="mb-5">
        <h4 class="mb-4 pb-2 fw-bold text-center" style="font-size:1.6rem;">⭐ Buku Populer & Ber-Rating</h4>
        <div class="row g-3">
            <?php if (!( !$_smarty_tpl->hasVariable('ratedBooks') || empty($_smarty_tpl->getValue('ratedBooks')))) {?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('ratedBooks'), 'book');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('book')->value) {
$foreach1DoElse = false;
?>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card h-100 rounded-4 hover-shadow">
                            <img src="<?php if (!( !true || empty($_smarty_tpl->getValue('book')['cover']))) {
echo $_smarty_tpl->getValue('base_url');?>
/uploads/covers/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('book')['cover'], ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->getValue('base_url');?>
/assets/img/no-cover.png<?php }?>"  
                                 class="card-img-top rounded-top-4" 
                                 alt="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                 title="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                 style="height:240px; object-fit:cover;">
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title text-truncate fw-semibold mb-1"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('book')['judul'], ENT_QUOTES, 'UTF-8', true);?>
</h6>
                                <p class="card-text text-muted small mb-1">
                                    <i class="bi bi-person me-1"></i><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                                </p>
                                <span class="badge bg-dark mb-2">Rating: <?php echo round((float) $_smarty_tpl->getValue('book')['avg_rating'], (int) 1, (int) 1);?>
</span>
                                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/user/books/view/<?php echo $_smarty_tpl->getValue('book')['book_id'];?>
" class="btn btn-sm btn-outline-secondary mt-auto w-100">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <div class="col-12 text-center">
                    <p class="text-muted mt-3">Belum ada buku ber-rating.</p>
                </div>
            <?php }?>
        </div>
    </div>

</div>
<?php
}
}
/* {/block 'main_content'} */
}
