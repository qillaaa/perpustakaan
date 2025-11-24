<?php
/* Smarty version 5.6.0, created on 2025-11-20 17:16:27
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691f4ceb50c144_02741962',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '456bdc1f162eb26b0859219f2e0d0c346d3902f0' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/profile.tpl',
      1 => 1763658981,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691f4ceb50c144_02741962 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_238428676691f4ceb4e7945_97912438', "main_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout_user.tpl", $_smarty_current_dir);
}
/* {block "main_content"} */
class Block_238428676691f4ceb4e7945_97912438 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>


<h3 class="fw-bold mb-4">Profil Saya</h3>

<div class="row g-4">

                <div class="col-md-4">
        <div class="card p-4 shadow-sm text-center">

                       <?php $_smarty_tpl->assign('avatarUrl', (($tmp = $_smarty_tpl->getValue('user')['avatar_url'] ?? null)===null||$tmp==='' ? 'assets/images/default-avatar.png' ?? null : $tmp), false, NULL);?>
<img src="<?php echo $_smarty_tpl->getValue('base_url');?>
/<?php echo $_smarty_tpl->getValue('avatarUrl');?>
" 
     class="rounded-circle shadow-sm mx-auto my-3"
     width="140" height="140"
     style="object-fit: cover;">

            <h5 class="fw-bold mb-0"><?php echo $_smarty_tpl->getValue('user')['username'];?>
</h5>
            <p class="text-muted small mb-3"><?php echo $_smarty_tpl->getValue('user')['email'];?>
</p>

            <hr>

            <p class="mb-1"><strong>User ID:</strong> <?php echo $_smarty_tpl->getValue('user')['id'];?>
</p>

            <?php if ($_smarty_tpl->getValue('user')['created_at']) {?>
                <p class="mb-1"><strong>Bergabung:</strong> <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('user')['created_at'],"%d %b %Y");?>
</p>
            <?php }?>

        </div>
    </div>


                <div class="col-md-8">
        <div class="card p-4 shadow-sm">

            <?php if ($_smarty_tpl->getValue('error')) {?>
                <div class="alert alert-danger"><?php echo $_smarty_tpl->getValue('error');?>
</div>
            <?php }?>

            <?php if ($_smarty_tpl->getValue('message')) {?>
                <div class="alert alert-success"><?php echo $_smarty_tpl->getValue('message');?>
</div>
            <?php }?>

            <form action="<?php echo $_smarty_tpl->getValue('base_url');?>
/user/profile/update" method="post" enctype="multipart/form-data">

                <label class="fw-semibold mt-2">Username:</label>
                <input type="text" class="form-control" name="username"
                       value="<?php echo $_smarty_tpl->getValue('user')['username'];?>
" required>

                <label class="fw-semibold mt-3">Email:</label>
                <input type="email" class="form-control" name="email"
                       value="<?php echo $_smarty_tpl->getValue('user')['email'];?>
" required>

                <label class="fw-semibold mt-3">Password (kosongkan jika tidak diubah):</label>
                <input type="password" class="form-control" name="password">

                <label class="fw-semibold mt-3">Avatar:</label>
                <input type="file" class="form-control" name="avatar">

                <button type="submit" class="btn btn-dark mt-4 w-100">
                    <i class="bi bi-check-circle me-1"></i> Update Profil
                </button>

            </form>
        </div>
    </div>

</div>

<?php
}
}
/* {/block "main_content"} */
}
