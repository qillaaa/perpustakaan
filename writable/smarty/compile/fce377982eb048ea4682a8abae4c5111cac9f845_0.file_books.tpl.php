<?php
/* Smarty version 5.6.0, created on 2025-11-20 18:13:14
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/books.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691f5a3a774306_97034315',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fce377982eb048ea4682a8abae4c5111cac9f845' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/books.tpl',
      1 => 1763662048,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691f5a3a774306_97034315 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_510675269691f5a3a7497a4_36596400', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_510675269691f5a3a7497a4_36596400 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>

<h2 class="fw-bold mb-4 text-center" style="color:#000;">📚 Koleksi Buku</h2>

<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('books')) > 0) {?>
<div class="books-grid" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:15px;">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('books'), 'book');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('book')->value) {
$foreach0DoElse = false;
?>
        <div class="book-card" style="background-color:#fff; border:1px solid #000; border-radius:10px; padding:10px; text-align:center; transition:all 0.2s;">
            <?php if ((true && (true && null !== ($_smarty_tpl->getValue('book')['cover'] ?? null))) && $_smarty_tpl->getValue('book')['cover']) {?>
                <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('book')['cover'];?>
" 
                     class="book-cover" 
                     alt="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" 
                     style="width:100%; height:220px; object-fit:cover; border-radius:6px;">
            <?php } else { ?>
                <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
assets/img/no-cover.png" 
                     class="book-cover" 
                     alt="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" 
                     style="width:100%; height:220px; object-fit:cover; border-radius:6px;">
            <?php }?>

            <div class="book-title" style="font-weight:600; color:#000; margin-top:10px;"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? 'Judul Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</div>
            <div class="book-author" style="font-size:0.85rem; color:#333; margin-bottom:10px;"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('book')['penulis'] ?? null)===null||$tmp==='' ? 'Pengarang Tidak Diketahui' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</div>

            <!-- Tombol Lihat -->
            <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/user/books/view/<?php echo $_smarty_tpl->getValue('book')['book_id'];?>
" 
               class="btn btn-sm w-100 rounded-pill mt-2"
               style="border:1px solid #000; background-color:#fff; color:#000; transition:all 0.2s;"
               onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
               onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                <i class="bi bi-eye me-1"></i> Lihat
            </a>
        </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</div>
<?php } else { ?>
    <p class="text-center text-muted" style="color:#555;">Belum ada buku yang tersedia.</p>
<?php }
}
}
/* {/block "main_content"} */
}
