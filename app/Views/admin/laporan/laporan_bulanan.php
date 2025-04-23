<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
        <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
            <?php endif; ?>

            <div class="paper mt-4">
                <div class="d-flex justify-content-between mb-3">
                    <!-- Tombol Perhari dan Perbulan -->
                    <div class="btn-group">
                        <a class="btn btn-info text-white" href="<?= base_url('admin/laporan/laporan_harian'); ?>">
                            <i class="fas fa-calendar-day"></i> Perhari
                        </a>
                        <a class="btn btn-warning text-dark" href="<?= base_url('admin/laporan/laporan_bulanan'); ?>">
                            <i class="fas fa-calendar-alt"></i> Perbulan
                        </a>
                    </div>

                    <div class="d-flex gap-2">
                        <!-- Tombol Download Laporan Bulanan -->
                        <a href="<?= base_url('admin/laporan/download_laporan_bulanan'); ?>" class="btn btn-primary">
                            <i class="fas fa-download"></i> Download Laporan Bulanan
                        </a>

                        <!-- Tombol Kirim Laporan Bulanan -->
                        <form id="laporanForm" action="<?= base_url('admin/laporan/kirim_laporan_bulanan'); ?>" method="post">
                            <button type="submit" class="btn btn-success" id="submitButton">
                                <i class="fab fa-whatsapp"></i> Kirim Laporan Bulanan
                            </button>
                        </form>

                    </div>


                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light text-center align-middle">
                            <tr>
                                <th>No</th>
                                <th>Bulan Order</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Terjual</th>
                                <th>Harga Satuan</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            $totalKeseluruhan = 0;
                            $totalJumlahTerjual = 0; ?>
                            <?php foreach ($laporan as $item): ?>
                                <?php
                                // Format Bulan dari created_at
                                $bulanOrder = '-';
                                if (!empty($item['created_at'])) {
                                    $date = new DateTime($item['created_at'], new DateTimeZone('UTC'));
                                    $date->setTimezone(new DateTimeZone('Asia/Makassar'));
                                    $bulanOrder = $date->format('F Y'); // Contoh: April 2025
                                }
                                ?>
                                <tr class="text-center align-middle">
                                    <td><?= $no++; ?></td>
                                    <td><?= $bulanOrder; ?></td>
                                    <td class="text-start"><?= esc($item['nama_produk']); ?></td>
                                    <td><?= esc($item['total_jumlah']); ?> pcs</td>
                                    <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                    <td>Rp <?= number_format($item['total_penjualan'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php
                                $totalKeseluruhan += $item['total_penjualan'];
                                $totalJumlahTerjual += $item['total_jumlah'];
                                ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total Keseluruhan Jumlah Terjual</th>
                                <th class="text-center"><?= $totalJumlahTerjual; ?> pcs</th>
                                <th class="text-center"></th>
                                <th class="text-center">Rp <?= number_format($totalKeseluruhan, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>