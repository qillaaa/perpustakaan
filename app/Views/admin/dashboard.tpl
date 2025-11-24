{extends file="layout.tpl"}

{block name="main"}
<div class="container py-4">

    <!-- Statistik -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card card-stat text-center p-4 shadow-sm">
                <i class="material-symbols-rounded mb-2 fs-2 text-primary">menu_book</i>
                <p class="mb-1">Data Buku</p>
                <h4>{$totalBooks}</h4>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card card-stat text-center p-4 shadow-sm">
                <i class="material-symbols-rounded mb-2 fs-2 text-success">group</i>
                <p class="mb-1">Pengguna</p>
                <h4>{$totalUsers}</h4>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card card-stat text-center p-4 shadow-sm">
                <i class="material-symbols-rounded mb-2 fs-2 text-warning">inventory_2</i>
                <p class="mb-1">Total Stok</p>
                <h4>{$totalStock}</h4>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card card-stat text-center p-4 shadow-sm">
                <i class="material-symbols-rounded mb-2 fs-2 text-info">category</i>
                <p class="mb-1">Kategori</p>
                <h4>{$totalCategories}</h4>
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
{/block}

{block name="scripts"}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data dari Controller
const favoriteCategoryLabels = {$favoriteCategoryLabels|json_encode|raw};
const favoriteCategoryCounts = {$favoriteCategoryCounts|json_encode|raw};
const weekLabels = {$weekLabels|json_encode|raw};
const weekBorrowers = {$weekBorrowers|json_encode|raw};

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
</script>
{/block}
