<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="paper my-4">

                <!-- Ringkasan Data -->
                <div class="row">

                    <!-- Total Produk -->
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary">Produk</h5>
                                <h3 class="fw-bold"><?= $totalProduk; ?></h3>
                                <p>Total Produk</p>
                                <i class="fas fa-box fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Kategori -->
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-success">Kategori</h5>
                                <h3 class="fw-bold"><?= $totalKategori; ?></h3>
                                <p>Jenis Kategori</p>
                                <i class="fas fa-tags fa-4x text-success"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Laporan Harian Produk Terjual -->
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-info">Laporan Harian</h5>
                                <h3 class="fw-bold"><?= $totalProdukHarian; ?></h3>  <!-- Menampilkan total produk terjual hari ini -->
                                <p>Total Produk Terjual Hari Ini</p>
                                <i class="fas fa-file-alt fa-4x text-info"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Laporan Bulanan Produk Terjual -->
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <h5 class="card-title text-warning">Laporan Bulanan</h5>
                                <h3 class="fw-bold"><?= $totalProdukBulanan; ?></h3>  <!-- Menampilkan total produk terjual bulan ini -->
                                <p>Total Produk Terjual Bulan Ini</p>
                                <i class="fas fa-file-alt fa-4x text-warning"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
