<?php
/* Smarty version 5.6.0, created on 2025-11-21 11:34:50
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/mybooks.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_69204e5a778990_17881901',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd53fd58183254381103e35b317ec71373a52651f' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/mybooks.tpl',
      1 => 1763724883,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69204e5a778990_17881901 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2463368769204e599fec72_10364714', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_2463368769204e599fec72_10364714 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>


<style>
/* ...style lama tetap sama... */
.stok-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    background-color: #28a745;
    color: #fff;
    margin-bottom: 0.5rem;
    display: inline-block;
}
</style>

<div class="container py-5">

    <h2 class="fw-bold mb-4 text-center" style="color:#000;">📖 Buku Saya</h2>

    <?php if ((true && ($_smarty_tpl->hasVariable('loans') && null !== ($_smarty_tpl->getValue('loans') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('loans')) > 0) {?>
        <div class="books-grid">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('loans'), 'loan');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('loan')->value) {
$foreach0DoElse = false;
?>
                <div class="book-card">
                    <?php if ($_smarty_tpl->getValue('loan')['cover']) {?>
                        <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('loan')['cover'];?>
" class="book-cover">
                    <?php } else { ?>
                        <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
assets/img/no-cover.png" class="book-cover">
                    <?php }?>

                    <div class="book-title" title="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('loan')['judul'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('loan')['judul'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                    <div class="book-author"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('loan')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</div>
                    <div class="mb-1"><small style="color:#000;">Dipinjam: <?php echo (($tmp = $_smarty_tpl->getValue('loan')['tgl_pinjam'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</small></div>
                    <div class="mb-2"><small style="color:#000;">Kembali: <?php echo (($tmp = $_smarty_tpl->getValue('loan')['tgl_kembali'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</small></div>
                    <span class="badge"><?php echo (($tmp = $_smarty_tpl->getValue('loan')['status'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</span>

                                        <?php if ((true && (true && null !== ($_smarty_tpl->getValue('loan')['stok'] ?? null)))) {?>
                        <div class="stok-badge">Akses: <?php if ($_smarty_tpl->getValue('loan')['stok'] > 0) {?>Tersedia<?php } else { ?>Ditutup<?php }?></div>
                    <?php }?>

                                        <?php if ($_smarty_tpl->getValue('loan')['status'] != 'Selesai') {?>
                        <form action="<?php echo $_smarty_tpl->getValue('base_url');?>
user/mybooks/konfirmasi/<?php echo $_smarty_tpl->getValue('loan')['peminjaman_id'];?>
" method="post" class="mb-2 w-100">
                            <input type="hidden" name="<?php echo $_smarty_tpl->getValue('csrf_name');?>
" value="<?php echo $_smarty_tpl->getValue('csrf_hash');?>
">
                            <button type="submit" class="btn btn-sm w-100">
                                <i class="bi bi-check-circle"></i> Konfirmasi Selesai
                            </button>
                        </form>
                    <?php }?>

                    <?php if (!( !true || empty($_smarty_tpl->getValue('loan')['file_buku']))) {?>
                        <a href="<?php echo $_smarty_tpl->getValue('loan')['read_link'];?>
" target="_blank" class="btn btn-sm w-100">
                            <i class="bi bi-book"></i> Baca Buku
                        </a>
                    <?php }?>

                    <?php if ((true && (true && null !== ($_smarty_tpl->getValue('loan')['can_review'] ?? null))) && $_smarty_tpl->getValue('loan')['can_review']) {?>
                        <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/reviews/add/<?php echo $_smarty_tpl->getValue('loan')['peminjaman_id'];?>
" class="btn btn-sm w-100">
                            <i class="bi bi-star"></i> Beri Ulasan
                        </a>
                    <?php }?>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php } else { ?>
        <div class="text-center mb-5">
            <p class="text-muted fs-5">Belum ada buku yang dipinjam 😅</p>
        </div>
    <?php }?>

        <?php if ((true && ($_smarty_tpl->hasVariable('popularBooks') && null !== ($_smarty_tpl->getValue('popularBooks') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('popularBooks')) > 0) {?>
        <h4 class="fw-bold mt-5 mb-3 text-center">Rekomendasi Buku Populer 📚</h4>
        <div class="books-grid">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('popularBooks'), 'rec');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rec')->value) {
$foreach1DoElse = false;
?>
                <div class="book-card">
                    <?php if ($_smarty_tpl->getValue('rec')['cover']) {?>
                        <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('rec')['cover'];?>
" class="book-cover">
                    <?php } else { ?>
                        <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
assets/img/no-cover.png" class="book-cover">
                    <?php }?>
                    <div class="book-title" title="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('rec')['judul'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('rec')['judul'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                    <div class="book-author"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('rec')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</div>

                                        <?php if ((true && (true && null !== ($_smarty_tpl->getValue('rec')['stok'] ?? null)))) {?>
                        <div class="stok-badge">Akses: <?php if ($_smarty_tpl->getValue('rec')['stok'] > 0) {?>Tersedia<?php } else { ?>Ditutup<?php }?></div>
                    <?php }?>

                                        <?php if ((true && (true && null !== ($_smarty_tpl->getValue('rec')['stok'] ?? null))) && $_smarty_tpl->getValue('rec')['stok'] > 0) {?>
                        <form action="<?php echo $_smarty_tpl->getValue('base_url');?>
user/mybooks/borrow/<?php echo $_smarty_tpl->getValue('rec')['book_id'];?>
" method="post" class="w-100 mb-2">
                            <input type="hidden" name="<?php echo $_smarty_tpl->getValue('csrf_name');?>
" value="<?php echo $_smarty_tpl->getValue('csrf_hash');?>
">
                            <button type="submit" class="btn btn-sm w-100">
                                <i class="bi bi-cart-plus"></i> Pinjam Buku
                            </button>
                        </form>
                    <?php } else { ?>
                        <button class="btn btn-sm w-100" disabled>
                            <i class="bi bi-x-circle"></i> Akses Ditutup
                        </button>
                    <?php }?>

                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/books/view/<?php echo $_smarty_tpl->getValue('rec')['book_id'];?>
" class="btn btn-sm w-100 mt-1">
                        <i class="bi bi-book"></i> Lihat Buku
                    </a>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>

</div>

<?php
}
}
/* {/block "main_content"} */
}
