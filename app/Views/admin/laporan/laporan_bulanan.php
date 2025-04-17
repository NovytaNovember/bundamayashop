<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <div class="paper mt-4">
                <div class="d-flex justify-content-between mb-3">
                    <div class="btn-group">
                        <a class="btn btn-default" href="<?= base_url('admin/laporan/laporan_harian'); ?>"> Perhari </a>
                        <a class="btn btn-default active" href="<?= base_url('admin/laporan/laporan_bulanan'); ?>"> Perbulan </a>
                    </div>
                    <a href="<?= base_url('admin/laporan/kirim_laporan_bulanan'); ?>" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i> Kirim Laporan Bulanan
                    </a>
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
                                    <td><?= esc($item['total_jumlah']); ?> buah</td>
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
                                <th class="text-center"><?= $totalJumlahTerjual; ?> buah</th>
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
