<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="paper my-4">

                <!-- Ringkasan Data -->
                <div class="row">

                    <!-- Total Produk -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow rounded-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">Produk</h5>
                                <h3 class="fw-bold"><?= $totalProduk; ?></h3>
                                <p>Total Produk</p>
                                <i class="fas fa-box fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Kategori -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow rounded-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-success">Kategori</h5>
                                <h3 class="fw-bold"><?= $totalKategori; ?></h3>
                                <p>Jenis Kategori</p>
                                <i class="fas fa-tags fa-4x text-success"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tambahan: Total Laporan -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow rounded-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-info">Laporan</h5>
                                <h3 class="fw-bold">-</h3>
                                <p>Laporan Terdata</p>
                                <i class="fas fa-file-alt fa-4x text-info"></i>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Catatan -->
                <div class="alert alert-secondary mt-4 rounded-3 shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    Data ini digunakan sebagai dasar laporan harian dan bulanan. Pastikan data sudah diperbarui sebelum mengirim laporan.
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
