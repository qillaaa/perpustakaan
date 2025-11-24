<?php
/* Smarty version 5.6.0, created on 2025-11-20 18:48:02
  from 'file:C:\laragon\www\perpustakaan\app\Views\user/books_view.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691f62624c0234_84242292',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db9178fc938f09a857e6b2122a27c749d9adb060' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user/books_view.tpl',
      1 => 1763664477,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691f62624c0234_84242292 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2030951056691f6262450d05_88672381', 'main_content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layout_user.tpl', $_smarty_current_dir);
}
/* {block 'main_content'} */
class Block_2030951056691f6262450d05_88672381 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\user';
?>

<div class="py-5 container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="background-color:#fff; border:1px solid #000; border-radius:8px; padding:0.5rem 1rem;">
            <li class="breadcrumb-item"><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/dashboard" class="text-decoration-none" style="color:#000;">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/books" class="text-decoration-none" style="color:#000;">Koleksi Buku</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color:#555;"><?php echo (($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? 'Detail Buku' ?? null : $tmp);?>
</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Gambar Buku -->
        <div class="col-md-4 text-center">
            <img src="<?php if ((true && (true && null !== ($_smarty_tpl->getValue('book')['cover'] ?? null))) && $_smarty_tpl->getValue('book')['cover']) {
echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('book')['cover'];
} else {
echo $_smarty_tpl->getValue('base_url');?>
assets/img/no-cover.png<?php }?>" 
                 alt="<?php echo (($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" 
                 class="img-fluid rounded-4 mb-3"
                 style="max-height:400px; object-fit:cover;">
        </div>

        <!-- Info Buku -->
        <div class="col-md-8">
            <h2 class="fw-bold mb-2" style="color:#000;"><?php echo (($tmp = $_smarty_tpl->getValue('book')['judul'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</h2>
            <p class="mb-1" style="color:#000;"><strong>Penulis:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('book')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</p>
            <p class="mb-1" style="color:#000;"><strong>Kategori:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('book')['nama_kategori'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</p>
            <p class="mb-1" style="color:#000;"><strong>Tahun Terbit:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('book')['tahun_terbit'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</p>
            <p class="mb-1" style="color:#000;">
                <strong>Akses:</strong> 
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('book')['stok'] ?? null))) && $_smarty_tpl->getValue('book')['stok'] > 0) {?>
                    <span style="color:#28a745;">Tersedia</span>
                <?php } else { ?>
                    <span style="color:#dc3545;">Ditutup</span>
                <?php }?>
            </p>
            <hr style="border-color:#000;">
            <h5 style="color:#000;">Deskripsi</h5>
            <p style="color:#333;"><?php echo (($tmp = $_smarty_tpl->getValue('book')['deskripsi'] ?? null)===null||$tmp==='' ? 'Deskripsi buku belum tersedia.' ?? null : $tmp);?>
</p>

            <!-- Tombol Aksi -->
            <div class="mt-4 d-flex flex-wrap gap-2">
                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('book')['stok'] ?? null))) && $_smarty_tpl->getValue('book')['stok'] > 0) {?>
                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/books/borrow/<?php echo $_smarty_tpl->getValue('book')['book_id'];?>
" 
                       class="btn" 
                       style="background-color:#000; color:#fff; border:1px solid #000; transition:all 0.2s;"
                       onmouseover="this.style.backgroundColor='#fff'; this.style.color='#000';"
                       onmouseout="this.style.backgroundColor='#000'; this.style.color='#fff';">
                        <i class="bi bi-bookmark-plus me-1"></i> Pinjam Buku
                    </a>
                <?php } else { ?>
                    <button class="btn" disabled
                            style="background-color:#6c757d; color:#fff; border:1px solid #6c757d;">
                        <i class="bi bi-bookmark-plus me-1"></i> Akses Ditutup
                    </button>
                <?php }?>

                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/cart/add/<?php echo $_smarty_tpl->getValue('book')['book_id'];?>
" 
                   class="btn" 
                   style="background-color:#fff; color:#000; border:1px solid #000; transition:all 0.2s;"
                   onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                    <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                </a>

                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/books/favorite/<?php echo $_smarty_tpl->getValue('book')['book_id'];?>
" 
                   class="btn" 
                   style="border:1px solid #000; background-color:#fff; color:#000; transition:all 0.2s;"
                   onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                    <i class="bi <?php if ((true && ($_smarty_tpl->hasVariable('isFavorited') && null !== ($_smarty_tpl->getValue('isFavorited') ?? null))) && $_smarty_tpl->getValue('isFavorited')) {?>bi-heart-fill text-danger<?php } else { ?>bi-heart<?php }?> me-1"></i>
                    <?php if ((true && ($_smarty_tpl->hasVariable('isFavorited') && null !== ($_smarty_tpl->getValue('isFavorited') ?? null))) && $_smarty_tpl->getValue('isFavorited')) {?>Unlike<?php } else { ?>Like<?php }?>
                </a>

                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/books" 
                   class="btn btn-outline-secondary" 
                   style="border:1px solid #000; color:#000; background-color:#fff; transition:all 0.2s;"
                   onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Koleksi
                </a>
            </div>
        </div>
    </div>

    <!-- Rekomendasi Buku -->
    <?php if (!( !$_smarty_tpl->hasVariable('recommendedBooks') || empty($_smarty_tpl->getValue('recommendedBooks')))) {?>
    <div class="mt-5">
        <h4 class="fw-bold mb-4 text-center" style="font-size:1.5rem; color:#000;">
            Rekomendasi Buku Lain di Kategori <?php echo (($tmp = $_smarty_tpl->getValue('book')['nama_kategori'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>

            <span style="display:block;width:80px;height:3px;background-color:#000;margin:10px auto;border-radius:2px;"></span>
        </h4>
        <div class="row g-3">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('recommendedBooks'), 'rec');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rec')->value) {
$foreach0DoElse = false;
?>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="card h-100 shadow-sm rounded-4 border-1" style="border-color:#000;">
                        <img src="<?php if ((true && (true && null !== ($_smarty_tpl->getValue('rec')['cover'] ?? null))) && $_smarty_tpl->getValue('rec')['cover']) {
echo $_smarty_tpl->getValue('base_url');?>
uploads/covers/<?php echo $_smarty_tpl->getValue('rec')['cover'];
} else {
echo $_smarty_tpl->getValue('base_url');?>
assets/img/no-cover.png<?php }?>" 
                             class="card-img-top rounded-top-4" 
                             alt="<?php echo (($tmp = $_smarty_tpl->getValue('rec')['judul'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"
                             style="height:180px; object-fit:cover;">
                        <div class="card-body d-flex flex-column p-2">
                            <h6 class="card-title text-truncate fw-semibold mb-1" style="color:#000;"><?php echo (($tmp = $_smarty_tpl->getValue('rec')['judul'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</h6>
                            <p class="card-text small mb-2" style="color:#333;">
                                <i class="bi bi-person me-1"></i><?php echo (($tmp = $_smarty_tpl->getValue('rec')['penulis'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</p>

                                                        <?php if ((true && (true && null !== ($_smarty_tpl->getValue('rec')['stok'] ?? null)))) {?>
                                <span class="badge mb-2" style="background-color:<?php if ($_smarty_tpl->getValue('rec')['stok'] > 0) {?>#28a745<?php } else { ?>#dc3545<?php }?>; color:#fff; font-size:0.75rem;">
                                    Akses: <?php if ($_smarty_tpl->getValue('rec')['stok'] > 0) {?>Tersedia<?php } else { ?>Ditutup<?php }?>
                                </span>
                            <?php }?>

                            <div class="d-flex gap-1 mt-auto">
                                <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/books/view/<?php echo $_smarty_tpl->getValue('rec')['book_id'];?>
" 
                                   class="btn btn-sm flex-grow-1"
                                   style="border:1px solid #000; background-color:#fff; color:#000; transition:all 0.2s;"
                                   onmouseover="this.style.backgroundColor='#000'; this.style.color='#fff';"
                                   onmouseout="this.style.backgroundColor='#fff'; this.style.color='#000';">
                                    Lihat
                                </a>

                                <?php if ((true && (true && null !== ($_smarty_tpl->getValue('rec')['stok'] ?? null))) && $_smarty_tpl->getValue('rec')['stok'] > 0) {?>
                                    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
user/books/borrow/<?php echo $_smarty_tpl->getValue('rec')['book_id'];?>
" 
                                       class="btn btn-sm"
                                       style="border:1px solid #000; background-color:#000; color:#fff; transition:all 0.2s;"
                                       onmouseover="this.style.backgroundColor='#fff'; this.style.color='#000';"
                                       onmouseout="this.style.backgroundColor='#000'; this.style.color='#fff';">
                                        <i class="bi bi-bookmark-plus me-1"></i> Pinjam
                                    </a>
                                <?php } else { ?>
                                    <button class="btn btn-sm" disabled
                                            style="border:1px solid #6c757d; background-color:#6c757d; color:#fff;">
                                        Akses Ditutup
                                    </button>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    </div>
    <?php }?>

</div>
<?php
}
}
/* {/block 'main_content'} */
}
