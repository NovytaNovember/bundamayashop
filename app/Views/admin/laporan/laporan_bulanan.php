<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <div class="paper mt-4">
                <div class="btn-group">
                    <a class="btn btn-default" href="<?= base_url('admin/laporan/laporan_harian'); ?>"> Perhari </a>
                    <a class="btn btn-default active" href="<?= base_url('admin/laporan/laporan_bulanan'); ?>"> Perbulan </a>
                </div>

                <div class="card-body">
                     <table class="table table-bordered table-hover">
                        <thead class="table-light text-center align-middle">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Terjual</th>
                                <th>Harga Satuan</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($laporan as $item): ?>
                                <tr class="text-center align-middle">
                                    <td><?= $no++; ?></td>
                                    <td class="text-start"><?= esc($item['nama_produk']); ?></td>
                                    <td><?= esc($item['total_jumlah']); ?> buah</td>
                                    <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                    <td>Rp <?= number_format($item['total_penjualan'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total Keseluruhan</th>
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
