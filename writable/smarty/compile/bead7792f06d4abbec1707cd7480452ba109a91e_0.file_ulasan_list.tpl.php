<?php
/* Smarty version 5.6.0, created on 2025-11-19 09:17:27
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/ulasan/ulasan_list.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691d8b27121cd9_29077664',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bead7792f06d4abbec1707cd7480452ba109a91e' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/ulasan/ulasan_list.tpl',
      1 => 1763543841,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691d8b27121cd9_29077664 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\ulasan';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_77033130691d8b270ff803_15529980', "main");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_77033130691d8b270ff803_15529980 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin\\ulasan';
?>

<div class="container py-4">

    <!-- Header Card -->
    <div class="card shadow-sm mb-3 border-0 bg-white">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-0">Daftar Ulasan Buku</h5>
        </div>
    </div>

    <!-- Search Box -->
    <div class="mb-3 d-flex align-items-center">
        <form method="get" action="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/ulasan" class="d-flex w-100">
            <input type="text" name="q" 
                   class="form-control border rounded-pill me-2 py-1 px-3" 
                   placeholder="Cari ulasan berdasarkan username, judul, rating, atau tanggal..." 
                   value="<?php echo (($tmp = $_smarty_tpl->getValue('q') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" 
                   style="height:38px; font-size:0.9rem;">
            <button type="submit" class="btn btn-dark rounded-pill px-3 py-1" style="height:38px; font-size:0.9rem;">
                Cari
            </button>
            <?php if ($_smarty_tpl->getValue('q')) {?>
                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
admin/ulasan" 
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

    <!-- Tabel Ulasan -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Username</th>
                            <th>Judul Buku</th>
                            <th style="width:100px;">Rating</th>
                            <th>Komentar</th>
                            <th style="width:150px;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('ulasan'), 'u', false, 'index');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('index')->value => $_smarty_tpl->getVariable('u')->value) {
$foreach0DoElse = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getValue('index')+1;?>
</td>
                            <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')['user'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                            <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')['buku'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                            <td>
                                <span class="badge bg-dark text-white"><?php echo $_smarty_tpl->getValue('u')['rating'];?>
 / 5</span>
                            </td>
                            <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')['komentar'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                            <td><?php echo $_smarty_tpl->getValue('u')['created_at'];?>
</td>
                        </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('ulasan')) == 0) {?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Belum ada ulasan
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
