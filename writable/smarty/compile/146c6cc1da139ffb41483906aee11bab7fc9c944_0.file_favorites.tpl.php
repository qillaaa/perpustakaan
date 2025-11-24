<?php
/* Smarty version 5.6.0, created on 2025-11-19 06:14:17
  from 'file:user/favorites.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691d60396fd5a9_96266309',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '146c6cc1da139ffb41483906aee11bab7fc9c944' => 
    array (
      0 => 'user/favorites.tpl',
      1 => 1763532851,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691d60396fd5a9_96266309 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2073377528691d60396d2957_89298501', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_2073377528691d60396d2957_89298501 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>

<style>
table {
    width: 100%;
    border-collapse: collapse;
    color: #000;
}
th, td {
    padding: 0.75rem;
    border: 1px solid #000;
    text-align: left;
}
th {
    background-color: #f5f5f5;
}
.btn-unlike {
    background-color: #000;
    color: #fff;
    border: 1px solid #000;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.85rem;
    transition: 0.2s;
}
.btn-unlike:hover {
    background-color: #fff;
    color: #000;
}
.cover-img {
    width: 60px;
    height: 90px;
    object-fit: cover;
    border-radius: 4px;
}
</style>

<div class="container py-4">
    <h4 class="fw-bold mb-3">❤️ Buku Favorit Saya</h4>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('favorites')) == 0) {?>
        <p class="text-muted mt-2">Belum ada buku favorit.</p>
    <?php } else { ?>
    <table>
        <thead>
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('favorites'), 'f');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('f')->value) {
$foreach0DoElse = false;
?>
                <?php $_smarty_tpl->assign('f_id', (($tmp = (($tmp = (($tmp = $_smarty_tpl->getValue('f')['book_id'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('f')['id'] ?? null : $tmp) ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('f')['id_buku'] ?? null : $tmp) ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>
                <?php $_smarty_tpl->assign('f_cover', (($tmp = $_smarty_tpl->getValue('f')['cover'] ?? null)===null||$tmp==='' ? ((string)$_smarty_tpl->getValue('base_url'))."assets/img/no-cover.png" ?? null : $tmp), false, NULL);?>
                <tr>
                    <td><img src="<?php echo $_smarty_tpl->getValue('f_cover');?>
" class="cover-img" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('f')['judul'], ENT_QUOTES, 'UTF-8', true);?>
"></td>
                    <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('f')['judul'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('f')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td>
                        <?php if ($_smarty_tpl->getValue('f_id')) {?>
                        <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/user/favorites/remove/<?php echo $_smarty_tpl->getValue('f_id');?>
" class="btn-unlike">Unlike</a>
                        <?php }?>
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
    <?php }?>
</div>

<?php
}
}
/* {/block "main_content"} */
}
