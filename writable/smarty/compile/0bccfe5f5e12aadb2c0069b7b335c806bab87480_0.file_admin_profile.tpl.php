<?php
/* Smarty version 5.6.0, created on 2025-11-20 05:49:02
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/admin_profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691eabce493fd6_40177515',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bccfe5f5e12aadb2c0069b7b335c806bab87480' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/admin_profile.tpl',
      1 => 1763617737,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691eabce493fd6_40177515 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1065049035691eabce475c01_62879695', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_1065049035691eabce475c01_62879695 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
?>

<div class="container py-4">

    <h3 class="fw-bold mb-4 text-center">Profil Admin</h3>

    <div class="row g-4">

                                <div class="col-md-4">
            <div class="card p-4 shadow-sm text-center bg-white">

                <img src="<?php echo (($tmp = $_smarty_tpl->getValue('user')['avatar_url'] ?? null)===null||$tmp==='' ? 'assets/img/default-avatar.png' ?? null : $tmp);?>
" 
                     class="rounded-circle shadow-sm mx-auto my-3"
                     width="140" height="140"
                     style="object-fit: cover;">

                <h5 class="fw-bold mb-0"><?php echo $_smarty_tpl->getValue('user')['username'];?>
</h5>
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('user')['status_message'] ?? null))) && $_smarty_tpl->getValue('user')['status_message']) {?>
                    <p class="text-muted small mb-3"><?php echo $_smarty_tpl->getValue('user')['status_message'];?>
</p>
                <?php }?>

                <hr>

                <p class="mb-1"><strong>User ID:</strong> <?php echo $_smarty_tpl->getValue('user')['id'];?>
</p>
                <p class="mb-1"><strong>Email:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('user')['email'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
                <p class="mb-1"><strong>Role:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('user')['role'] ?? null)===null||$tmp==='' ? 'Admin' ?? null : $tmp);?>
</p>

                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('user')['created_at'] ?? null))) && $_smarty_tpl->getValue('user')['created_at']) {?>
                    <p class="mb-1"><strong>Bergabung:</strong> <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('user')['created_at'],"%d %b %Y");?>
</p>
                <?php }?>
            </div>
        </div>

                                <div class="col-md-8">
            <div class="card p-4 shadow-sm bg-white">

                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null))) && $_smarty_tpl->getValue('error')) {?>
                    <div class="alert alert-danger"><?php echo $_smarty_tpl->getValue('error');?>
</div>
                <?php }?>

                <?php if ((true && ($_smarty_tpl->hasVariable('success') && null !== ($_smarty_tpl->getValue('success') ?? null))) && $_smarty_tpl->getValue('success')) {?>
                    <div class="alert alert-success"><?php echo $_smarty_tpl->getValue('success');?>
</div>
                <?php }?>

                <form action="<?php echo $_smarty_tpl->getValue('base_url');?>
/admin/profile/update" method="post" enctype="multipart/form-data">

                    <label class="fw-semibold mt-2">Username:</label>
                    <input type="text" class="form-control" name="username"
                           value="<?php echo $_smarty_tpl->getValue('user')['username'];?>
" required>

                    <label class="fw-semibold mt-3">Email:</label>
                    <input type="email" class="form-control" name="email"
                           value="<?php echo (($tmp = $_smarty_tpl->getValue('user')['email'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>

                    <label class="fw-semibold mt-3">Password (kosongkan jika tidak ingin diubah):</label>
                    <input type="password" class="form-control" name="password">

                    <label class="fw-semibold mt-3">Status Message:</label>
                    <input type="text" class="form-control" name="status_message"
                           value="<?php echo (($tmp = $_smarty_tpl->getValue('user')['status_message'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

                    <label class="fw-semibold mt-3">Avatar:</label>
                    <input type="file" class="form-control" name="avatar" accept="image/*">

                    <button type="submit" class="btn btn-dark mt-4 w-100">
                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
<?php
}
}
/* {/block "main"} */
}
