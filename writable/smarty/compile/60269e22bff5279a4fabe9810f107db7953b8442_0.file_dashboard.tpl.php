<?php
/* Smarty version 5.6.0, created on 2025-11-20 06:06:27
  from 'file:C:\laragon\www\perpustakaan\app\Views\admin/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_691eafe3df3ab6_72297019',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60269e22bff5279a4fabe9810f107db7953b8442' => 
    array (
      0 => 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin/dashboard.tpl',
      1 => 1763618780,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_691eafe3df3ab6_72297019 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1718903408691eafe3dd9cc5_85050022', "main");
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_431368565691eafe3de0958_91060124', "scripts");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "main"} */
class Block_1718903408691eafe3dd9cc5_85050022 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
?>

<div class="container py-4">

    <!-- Statistik -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card card-stat text-center p-4 shadow-sm">
                <i class="material-symbols-rounded mb-2 fs-2 text-primary">menu_book</i>
                <p class="mb-1">Data Buku</p>
                <h4><?php echo $_smarty_tpl->getValue('totalBooks');?>
</h4>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card card-stat text-center p-4 shadow-sm">
                <i class="material-symbols-rounded mb-2 fs-2 text-success">group</i>
                <p class="mb-1">Pengguna</p>
                <h4><?php echo $_smarty_tpl->getValue('totalUsers');?>
</h4>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card card-stat text-center p-4 shadow-sm">
                <i class="material-symbols-rounded mb-2 fs-2 text-warning">inventory_2</i>
                <p class="mb-1">Total Stok</p>
                <h4><?php echo $_smarty_tpl->getValue('totalStock');?>
</h4>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card card-stat text-center p-4 shadow-sm">
                <i class="material-symbols-rounded mb-2 fs-2 text-info">category</i>
                <p class="mb-1">Kategori</p>
                <h4><?php echo $_smarty_tpl->getValue('totalCategories');?>
</h4>
            </div>
        </div>
    </div>

   <!-- Grafik -->
<div class="row">
    <!-- Doughnut Chart -->
    <div class="col-lg-6">
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0">📚 Buku Favorit per Kategori</h6>
            </div>
            <div class="card-body">
                <canvas id="booksChart" height="250" style="max-height:400px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Line Chart -->
    <div class="col-lg-6">
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0">📈 Jumlah Peminjam per Minggu</h6>
            </div>
            <div class="card-body">
                <canvas id="borrowersChart" height="250" style="max-height:400px;"></canvas>
            </div>
        </div>
    </div>
</div>

</div>
<?php
}
}
/* {/block "main"} */
/* {block "scripts"} */
class Block_431368565691eafe3de0958_91060124 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\laragon\\www\\perpustakaan\\app\\Views\\admin';
?>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
// Data dari Controller
const favoriteCategoryLabels = <?php echo json_encode($_smarty_tpl->getValue('favoriteCategoryLabels'));?>
;
const favoriteCategoryCounts = <?php echo json_encode($_smarty_tpl->getValue('favoriteCategoryCounts'));?>
;
const weekLabels = <?php echo json_encode($_smarty_tpl->getValue('weekLabels'));?>
;
const weekBorrowers = <?php echo json_encode($_smarty_tpl->getValue('weekBorrowers'));?>
;

document.addEventListener('DOMContentLoaded', function() {
    // Doughnut Chart
    new Chart(document.getElementById('booksChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: favoriteCategoryLabels,
            datasets: [{
                data: favoriteCategoryCounts,
                backgroundColor: ['#1976d2','#42a5f5','#90caf9','#64b5f6','#1565c0','#2196f3'],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' }, tooltip: { enabled: true } }
        }
    });

    // Line Chart
    new Chart(document.getElementById('borrowersChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: weekLabels,
            datasets: [{
                label: 'Jumlah Peminjam',
                data: weekBorrowers,
                borderColor: '#1976d2',
                backgroundColor: 'rgba(25,118,210,0.15)',
                fill: true,
                tension: 0.3,
                borderWidth: 3,
                pointBackgroundColor: '#1976d2',
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true, mode: 'index', intersect: false }
            },
            interaction: { mode: 'nearest', axis: 'x', intersect: false },
            scales: {
                x: { ticks: { color: '#666' }, grid: { color: '#f0f0f0' } },
                y: { beginAtZero: true, ticks: { color: '#666', stepSize: 1 }, grid: { color: '#f0f0f0' } }
            }
        }
    });
});
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "scripts"} */
}
