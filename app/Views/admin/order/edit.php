<?= $this->extend('template/template_user'); ?>
<?= $this->section('konten'); ?>

<div class="container mt-4">
    <h4>Detail Penjualan</h4>

    <div class="card p-4">
        <div class="mb-3">
            <label class="form-label fw-semibold">Produk</label>
            <input type="text" class="form-control" value="<?= esc($penjualan['nama_produk']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jumlah</label>
            <input type="number" class="form-control" value="<?= esc($penjualan['jumlah']) ?>" readonly>
        </div>

        <a href="<?= base_url('user/penjualan') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<?= $this->endSection(); ?>
