<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <div class="paper mt-4">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>

                <div class="alert alert-info" style="background-color: #a7c7e7; color: #3b3b3b; border-color: #8da9c4;">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong> Catatan:</strong> Saat Anda mendownload laporan bulanan, file juga secara otomatis akan masuk ke dalam arsip sistem.
                </div>

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
                        <a href="<?= base_url('admin/laporan/download_laporan_bulanan/' . $bulan . '/' . $tahun); ?>" class="btn btn-primary">
                            <i class="fas fa-download"></i> Download Laporan Bulanan
                        </a>

                        <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>

                            <!-- Tombol Kirim Laporan Bulanan -->
                            <form id="laporanForm" action="<?= base_url('admin/laporan/kirim_laporan_bulanan'); ?>" method="post">
                                <!-- Hidden field untuk bulan dan tahun yang difilter -->
                                <input type="hidden" name="bulan" value="<?= esc($bulan ?? date('m')) ?>">
                                <input type="hidden" name="tahun" value="<?= esc($tahun ?? date('Y')) ?>">
                                <button type="submit" class="btn btn-success" id="submitButton">
                                    <i class="fab fa-whatsapp"></i> Kirim Laporan Bulanan
                                </button>
                            </form>

                        <?php endif; ?>

                    </div>

                </div>
                <form method="get" action="<?= base_url('admin/laporan/laporan_bulanan'); ?>">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <strong>Filter Bulan dan Tahun untuk Mencari Data yang diinginkan:</strong>
                        </div>
                        <div class="card-body">


                            <div class="row mb-3">
                                <!-- Bulan Dropdown -->
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="form-group">
                                        <label for="bulan" class="font-weight-bold text-muted">Bulan</label>
                                        <select name="bulan" id="bulan" class="form-control form-control-sm">
                                            <?php foreach ($listBulan as $key => $value): ?>
                                                <option value="<?= $key; ?>" <?= ($bulan == $key) ? 'selected' : ''; ?>><?= $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tahun Dropdown -->
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="form-group">
                                        <label for="tahun" class="font-weight-bold text-muted">Tahun</label>
                                        <select name="tahun" id="tahun" class="form-control form-control-sm">
                                            <?php foreach ($listTahun as $key => $value): ?>
                                                <option value="<?= $key; ?>" <?= ($tahun == $key) ? 'selected' : ''; ?>><?= $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tombol Cari -->
                                <div class="col-md-2 d-flex align-items-end">
                                    <div class="form-group w-100">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-search"></i> Cari

                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>


                <div class="card-body">
                    <?php if (empty($laporan)) : ?>
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Bulan Produk Terjual</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Penjualan</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak tersedia</td>
                                </tr>
                            </tfoot>
                        </table>
                    <?php else: ?>
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Bulan Produk Terjual</th>
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
                                    $bulanProdukTerjual = '-';
                                    if (!empty($item['created_at'])) {
                                        $date = new DateTime($item['created_at'], new DateTimeZone('UTC'));
                                        $date->setTimezone(new DateTimeZone('Asia/Makassar'));
                                        $bulanProdukTerjual = $date->format('F Y'); // Contoh: April 2025
                                    }
                                    ?>
                                    <tr class="text-center align-middle">
                                        <td><?= $no++; ?></td>
                                        <td><?= $bulanProdukTerjual; ?></td>
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
                                    <th colspan="3" class="text-start">Total Keseluruhan Jumlah Terjual</th>
                                    <th class="text-center"><?= $totalJumlahTerjual; ?> pcs</th>
                                    <th class="text-center"></th>
                                    <th class="text-center">Rp <?= number_format($totalKeseluruhan, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>