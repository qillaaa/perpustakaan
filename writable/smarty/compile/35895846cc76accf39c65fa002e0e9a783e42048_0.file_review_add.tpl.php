<?php
/* Smarty version 5.6.0, created on 2025-11-20 07:55:24
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/review_add.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691ec96c3d81d7_34202069',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35895846cc76accf39c65fa002e0e9a783e42048' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/review_add.tpl',
      1 => 1763623368,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691ec96c3d81d7_34202069 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_408004517691ec96c25bde2_86166062', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_408004517691ec96c25bde2_86166062 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>

<div class="container py-5">
    <h2 class="text-center mb-4">⭐ Beri Ulasan: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('book_title'), ENT_QUOTES, 'UTF-8', true);?>
</h2>

    <div class="card shadow-sm p-4 mx-auto" style="max-width: 500px; border-radius:15px;">
        <form action="<?php echo $_smarty_tpl->getValue('base_url');?>
user/reviews/save" method="post">
            <input type="hidden" name="book_id" value="<?php echo $_smarty_tpl->getValue('book_id');?>
">

            <?php if ($_smarty_tpl->getValue('book_cover')) {?>
            <div class="text-center mb-4">
                <img src="<?php echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('book_cover');?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('book_title'), ENT_QUOTES, 'UTF-8', true);?>
" 
                     style="height:220px; width:auto; object-fit:cover; border-radius:10px;">
            </div>
            <?php }?>

            <!-- Rating bintang -->
            <div class="mb-4 text-center">
                <label class="form-label d-block mb-2 fw-semibold">Rating:</label>
                <div class="rating-stars">
                    <?php
$_smarty_tpl->assign('i', null);$_smarty_tpl->tpl_vars['i']->step = -1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 1+1 - (5) : 5-(1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 5, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                        <input type="radio" name="rating" id="star<?php echo $_smarty_tpl->getValue('i');?>
" value="<?php echo $_smarty_tpl->getValue('i');?>
">
                        <label for="star<?php echo $_smarty_tpl->getValue('i');?>
" title="<?php echo $_smarty_tpl->getValue('i');?>
 stars">★</label>
                    <?php }
}
?>
                </div>
            </div>

            <!-- Komentar -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Komentar:</label>
                <textarea name="komentar" class="form-control" rows="4" placeholder="Tulis komentar..." 
                          style="border-radius:10px; resize:none;"></textarea>
            </div>

            <button type="submit" class="btn btn-warning w-100 fw-bold shadow-sm">
                <i class="bi bi-star-fill"></i> Kirim Ulasan
            </button>
        </form>
    </div>
</div>

<style>
/* ====================== Rating Stars ====================== */
.rating-stars {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    font-size: 2.2rem;
    transition: transform 0.2s;
}
.rating-stars input {
    display: none;
}
.rating-stars label {
    cursor: pointer;
    color: #ccc;
    transition: color 0.25s ease-in-out, transform 0.2s ease;
}
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    color: gold;
    transform: scale(1.2);
}
.rating-stars input:checked ~ label {
    color: gold;
}

/* ====================== Card Hover ====================== */
.card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease-in-out;
}
</style>
<?php
}
}
/* {/block "main_content"} */
}
