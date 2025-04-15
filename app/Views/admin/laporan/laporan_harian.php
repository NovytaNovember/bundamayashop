<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <!-- Tabel Laporan Penjualan -->
            <?php if (isset($laporan)) : ?>
                <div class="paper mt-4">
                    <div class="btn-group">
                        <a class="btn btn-default" href="<?= base_url('admin/laporan/laporan_harian'); ?>"> Perhari </a>
                        <a class="btn btn-default" href="<?= base_url('admin/laporan/laporan_bulanan'); ?>"> Perbulan </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Order</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($laporan as $order): ?>
                                    <?php
                                    // Format tanggal order
                                    $date = new DateTime($order['created_at'], new DateTimeZone('UTC'));
                                    $date->setTimezone(new DateTimeZone('Asia/Makassar'));
                                    $tanggalOrder = $date->format('d F Y H:i');
                                    ?>

                                    <?php foreach ($order['items'] as $item): ?>
                                        <tr class="text-center align-middle">
                                            <td><?= $no++; ?></td>
                                            <td><?= $tanggalOrder; ?></td>
                                            <td class="text-start"><?= esc($item['nama_produk']); ?></td>
                                            <td><?= esc($item['jumlah']); ?> buah</td>
                                            <td>Rp <?= number_format($item['total_harga'] / $item['jumlah'], 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>