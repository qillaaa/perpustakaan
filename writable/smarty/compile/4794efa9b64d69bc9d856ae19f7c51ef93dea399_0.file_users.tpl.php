<?php
/* Smarty version 5.6.0, created on 2025-11-19 09:09:56
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/users.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691d89644abf67_23976846',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4794efa9b64d69bc9d856ae19f7c51ef93dea399' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/users.tpl',
      1 => 1763543388,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691d89644abf67_23976846 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_448327013691d8964480576_17539578', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_448327013691d8964480576_17539578 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
?>

<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-3 border-0 bg-white">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-0">Daftar Pengguna</h5>
        </div>
    </div>

    <!-- Search Box -->
    <div class="mb-3 d-flex align-items-center">
        <form method="get" action="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/users" class="d-flex w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari pengguna..." 
                   value="<?php echo (($tmp = $_smarty_tpl->getValue('q') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                Cari
            </button>
            <?php if ($_smarty_tpl->getValue('q')) {?>
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/users" 
                   class="btn btn-outline-secondary rounded-pill ms-2 py-1" 
                   style="height:38px; font-size:0.9rem;">Reset</a>
            <?php }?>
        </form>
    </div>

    <?php if ($_smarty_tpl->getValue('message')) {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_smarty_tpl->getValue('message');?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }?>

    <!-- Tabel Pengguna -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Pinjam Aktif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('users'), 'u', false, 'index');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('index')->value => $_smarty_tpl->getVariable('u')->value) {
$foreach0DoElse = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getValue('index')+1;?>
</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php if ((true && (true && null !== ($_smarty_tpl->getValue('u')['avatar_url'] ?? null))) && $_smarty_tpl->getValue('u')['avatar_url']) {
echo $_smarty_tpl->getValue('base_url');
echo $_smarty_tpl->getValue('u')['avatar_url'];
} else {
echo $_smarty_tpl->getValue('base_url');?>
assets/img/default-avatar.png<?php }?>" 
                                         class="avatar avatar-sm me-2 border-radius-lg" 
                                         alt="avatar"
                                         style="object-fit:cover; width:40px; height:40px;">
                                    <span><?php echo (($tmp = $_smarty_tpl->getValue('u')['username'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</span>
                                </div>
                            </td>
                            <td><?php echo (($tmp = $_smarty_tpl->getValue('u')['role'] ?? null)===null||$tmp==='' ? 'User' ?? null : $tmp);?>
</td>
                            <td class="text-center">
                                <?php if ($_smarty_tpl->getValue('u')['active'] == 1) {?>
                                    <span class="badge bg-dark text-white">Aktif</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary text-white">Nonaktif</span>
                                <?php }?>
                            </td>
                            <td class="text-center"><?php echo (($tmp = $_smarty_tpl->getValue('u')['total_pinjam'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</td>
                        </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('users')) == 0) {?>
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i>Tidak ada pengguna.</i>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php
}
}
/* {/block "main"} */
}
