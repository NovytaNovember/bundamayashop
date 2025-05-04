<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <!-- Tabel Laporan Penjualan -->
            <div class="paper mt-4">
                <div class="d-flex justify-content-between mb-3">
                    <!-- Tombol Perhari dan Perbulan -->
                    <div class="btn-group">
                        <a class="btn btn-info text-white" href="<?= base_url('admin/arsip_laporan/arsip_laporan_perhari'); ?>">
                            <i class="fas fa-calendar-day"></i> Perhari
                        </a>
                        <a class="btn btn-warning text-dark" href="<?= base_url('admin/arsip_laporan/arsip_laporan_perbulan'); ?>">
                            <i class="fas fa-calendar-alt"></i> Perbulan
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light text-center align-middle">
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Total Pendapatan</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $no = 1; ?>
                            <?php foreach ($laporan as $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <!-- Menampilkan nama file laporan -->
                                    <td><?= esc($item['file_laporan']); ?></td>
                                    <!-- Menampilkan bulan dan tahun dari database -->
                                    <td><?= esc($item['bulan']); ?></td>
                                    <td><?= esc($item['tahun']); ?></td>
                                    <td>Rp <?= number_format($item['total_penjualan'], 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="/admin/arsip_laporan/arsip_laporan_perbulan/download/<?= $item['id_laporan'] ?>" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
