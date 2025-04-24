<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">

        <div class="container-fluid">

            <!-- Tabel Laporan Penjualan -->
            <?php if (isset($laporan) && count($laporan) > 0) : ?>
                <div class="paper mt-4">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                    <?php endif; ?>
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
                            <!-- Tombol Download Laporan Harian -->
                            <a href="<?= base_url('admin/laporan/download_laporan_harian?tanggal=' . ($tanggal ?? date('Y-m-d'))); ?>" class="btn btn-primary">
                                <i class="fas fa-download"></i> Arsip / Download Laporan Harian
                            </a>

                            <!-- Tombol Kirim Laporan Harian -->
                            <form id="laporanForm" action="<?= base_url('admin/laporan/kirim_laporan_harian'); ?>" method="post">
                                <button type="submit" class="btn btn-success" id="submitButton">
                                    <i class="fab fa-whatsapp"></i> Kirim Laporan Harian
                                </button>
                            </form>
                        </div>
                    </div>

                    <form method="get" action="<?= base_url('admin/laporan/laporan_harian'); ?>" class="mb-3 d-flex gap-2 align-items-end">
                        <div>
                            <label for="tanggal" class="form-label mb-1">Filter Tanggal:</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?= esc($_GET['tanggal'] ?? date('Y-m-d')) ?>">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-filter"></i> Tampilkan
                            </button>
                        </div>
                    </form>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Produk Terjual</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                $totalKeseluruhan = 0;
                                $totalJumlahTerjual = 0;
                                $totalHargaSatuan = 0; ?>
                                <?php foreach ($laporan as $order): ?>
                                    <?php
                                    // Format tanggal order
                                    $date = new DateTime($order['created_at'], new DateTimeZone('UTC'));
                                    $date->setTimezone(new DateTimeZone('Asia/Makassar'));
                                    $tanggalOrder = $date->format('d F Y H:i');
                                    ?>

                                    <?php foreach ($order['items'] as $item): ?>
                                        <?php
                                        // Tambahkan total penjualan
                                        $totalKeseluruhan += $item['total_harga'];
                                        // Tambahkan jumlah terjual dan harga satuan
                                        $totalJumlahTerjual += $item['jumlah'];
                                        $totalHargaSatuan += ($item['total_harga'] / $item['jumlah']);
                                        ?>
                                        <tr class="text-center align-middle">
                                            <td><?= $no++; ?></td>
                                            <td><?= $tanggalOrder; ?></td>
                                            <td class="text-start"><?= esc($item['nama_produk']); ?></td>
                                            <td><?= esc($item['jumlah']); ?> pcs</td>
                                            <td>Rp <?= number_format($item['total_harga'] / $item['jumlah'], 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total Keseluruhan</th>
                                    <th class="text-center"><?= $totalJumlahTerjual; ?> pcs</th>
                                    <th class="text-center"></th> <!-- Kolom Harga Satuan dikosongkan -->
                                    <th class="text-center">Rp <?= number_format($totalKeseluruhan, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <!-- Pesan jika tidak ada laporan yang ditemukan -->
                <div class="alert alert-warning">
                    Tidak ada data penjualan untuk tanggal yang dipilih.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
