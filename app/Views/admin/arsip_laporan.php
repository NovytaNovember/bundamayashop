<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="paper my-4">
                <!-- Form untuk memilih rentang tanggal -->
                <form action="<?= base_url('laporan/generateLaporan') ?>" method="post">
                    <div class="form-row">
                        <!-- Rentang Tanggal Awal -->
                        <div class="col-md-4 mb-3">
                            <label for="tanggal_awal">Rentang Tanggal Awal:</label>
                            <input type="date" name="tanggal_awal" class="form-control" id="tanggal_awal" required>
                        </div>

                        <!-- Rentang Tanggal Akhir -->
                        <div class="col-md-4 mb-3">
                            <label for="tanggal_akhir">Rentang Tanggal Akhir:</label>
                            <input type="date" name="tanggal_akhir" class="form-control" id="tanggal_akhir" required>
                        </div>

                        <!-- Tombol untuk Menampilkan Laporan -->
                        <div class="col-md-4 mb-3">
                            <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Laporan Penjualan -->
            <?php if (isset($penjualan)) : ?>
            <div class="paper mt-4">
                <div class="card-body">
                    <h3 class="mb-4"><?= $judul ?></h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Penjualan</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Terjual</th>
                                <th>Harga Satuan</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($penjualan as $data) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggal_penjualan'] ?></td>
                                <td><?= $data['nama_produk'] ?></td>
                                <td><?= esc($data['jumlah_terjual']) ?> pcs</td>
                                <td>Rp. <?= number_format($data['harga'], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($data['total_penjualan'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>