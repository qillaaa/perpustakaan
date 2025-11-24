<?php if(!empty($books)): ?>
<div class="row">
    <?php foreach($books as $b): ?>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <?php if($b['cover']): ?>
            <img src="<?= base_url('uploads/covers/' . $b['cover']) ?>" class="card-img-top" alt="<?= esc($b['judul']) ?>">
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?= esc($b['judul']) ?></h5>
                <p class="card-text"><?= esc($b['penulis']) ?></p>
                <p class="text-muted small"><?= esc($b['nama_kategori']) ?> | <?= esc($b['tahun_terbit']) ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="text-muted">Buku tidak ditemukan.</div>
<?php endif; ?>
