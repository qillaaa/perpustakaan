<?php
/* Smarty version 5.6.0, created on 2025-11-18 09:24:48
  from 'file:user/profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691c3b60291555_60442481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9de8ab376f82acf9496a8d670a5f76296c8cc47c' => 
    array (
      0 => 'user/profile.tpl',
      1 => 1763457878,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691c3b60291555_60442481 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_280302067691c3b60282818_87559094', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_280302067691c3b60282818_87559094 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>

<h2><?php echo $_smarty_tpl->getValue('title');?>
</h2>

<?php if ($_smarty_tpl->getValue('error')) {?>
<div class="alert alert-danger"><?php echo $_smarty_tpl->getValue('error');?>
</div>
<?php }?>

<?php if ($_smarty_tpl->getValue('message')) {?>
<div class="alert alert-success"><?php echo $_smarty_tpl->getValue('message');?>
</div>
<?php }?>

<form action="/user/profile/update" method="post" enctype="multipart/form-data">
    <label>Username:</label>
    <input type="text" name="username" value="<?php echo $_smarty_tpl->getValue('user')['username'];?>
" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $_smarty_tpl->getValue('user')['email'];?>
" required>

    <label>Password (kosongkan jika tidak ingin diubah):</label>
    <input type="password" name="password">

    <label>Avatar:</label>
    <input type="file" name="avatar">

    <?php if ($_smarty_tpl->getValue('user')['avatar_url']) {?>
        <div>
            <img src="<?php echo $_smarty_tpl->getValue('user')['avatar_url'];?>
" alt="Avatar" width="100">
        </div>
    <?php }?>

    <button type="submit">Update Profil</button>
</form>
<?php
}
}
/* {/block "main"} */
}
