<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <!-- Detail Laporan Penjualan -->
            <div class="paper mt-4">
                <div class="card-body">
                    <h4><?= $laporan['created_at']; ?></h4>
                    <p><strong>Total Pendapatan:</strong> Rp. <?= $laporan['total_penjualan_bulanan']; ?></p>
                    <p><strong>Detail Laporan:</strong></p>

                    <!-- Link untuk Download Laporan -->
                    <a href="<?= base_url('admin/laporan/kirim_laporan_harian/' . $laporan['id']); ?>" class="btn btn-primary">
                        <i class="fas fa-download"></i> Download Laporan
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>
