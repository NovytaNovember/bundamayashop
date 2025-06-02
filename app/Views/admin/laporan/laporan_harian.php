<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <!-- Tabel Laporan Penjualan -->
            <div class="paper mt-4">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>

                <div class="alert alert-info" style="background-color: #a7c7e7; color: #3b3b3b; border-color: #8da9c4;">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong> Catatan:</strong> Saat Anda mendownload laporan harian, file juga secara otomatis akan masuk ke dalam arsip sistem.
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
                        <!-- Tombol Download Laporan Harian -->
                        <a href="<?= base_url('admin/laporan/download_laporan_harian?tanggal=' . ($tanggal ?? date('Y-m-d'))); ?>" class="btn btn-primary">
                            <i class="fas fa-download"></i> Download Laporan Harian
                        </a>

                        <!-- Tombol Kirim Laporan Harian -->
                        <form id="laporanForm" action="<?= base_url('admin/laporan/kirim_laporan_harian'); ?>" method="post">
                            <input type="hidden" name="tanggal" value="<?= esc($tanggal) ?>">
                            <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>
                                <button type="submit" class="btn btn-success" id="submitButton">
                                    <i class="fab fa-whatsapp"></i> Kirim Laporan Harian
                                </button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <form method="get" action="<?= base_url('admin/laporan/laporan_harian'); ?>" class="mb-3 d-flex gap-2 align-items-end">
                    <div class="card mb-4 w-100">
                        <div class="card-header bg-light">
                            <strong>Filter Tanggal untuk Mencari Data yang diinginkan:</strong>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="form-group">
                                        <label for="tanggal" class="font-weight-bold text-muted">Tanggal</label>
                                        <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?= esc($_GET['tanggal'] ?? date('Y-m-d')) ?>">
                                    </div>
                                </div>
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
                            <?php
                            $totalKeseluruhan = 0;
                            $totalJumlahTerjual = 0;
                            $totalHargaSatuan = 0;

                            if (count($laporan) > 0):
                                $no = 1;
                                foreach ($laporan as $produk_terjual):

                                    // Array bulan dalam Bahasa Indonesia
                                    $bulanIndonesia = [
                                        'January' => 'Januari',
                                        'February' => 'Februari',
                                        'March' => 'Maret',
                                        'April' => 'April',
                                        'May' => 'Mei',
                                        'June' => 'Juni',
                                        'July' => 'Juli',
                                        'August' => 'Agustus',
                                        'September' => 'September',
                                        'October' => 'Oktober',
                                        'November' => 'November',
                                        'December' => 'Desember'
                                    ];

                                    // Format tanggal produk terjual dalam Bahasa Indonesia
                                    $date = new DateTime($produk_terjual['created_at'], new DateTimeZone('UTC'));
                                    $date->setTimezone(new DateTimeZone('Asia/Makassar'));
                                    $bulanInggris = $date->format('F');
                                    $namaBulan = $bulanIndonesia[$bulanInggris];
                                    $tanggalProdukTerjual = $date->format('d') . ' ' . $namaBulan . ' ' . $date->format('Y H:i');

                                    foreach ($produk_terjual['rincian'] as $rincian):
                                        $totalKeseluruhan += $rincian['total_harga'];
                                        $totalJumlahTerjual += $rincian['jumlah'];
                                        $totalHargaSatuan += ($rincian['total_harga'] / $rincian['jumlah']);
                            ?>
                                        <tr class="text-center align-middle">
                                            <td><?= $no++; ?></td>
                                            <td><?= $tanggalProdukTerjual; ?></td>
                                            <td class="text-start"><?= esc($rincian['nama_produk']); ?></td>
                                            <td><?= esc($rincian['jumlah']); ?> pcs</td>
                                            <td>Rp <?= number_format($rincian['total_harga'] / $rincian['jumlah'], 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($rincian['total_harga'], 0, ',', '.'); ?></td>
                                        </tr>
                            <?php
                                    endforeach;
                                endforeach;
                            else:
                            ?>
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-start">Total Keseluruhan</th>
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
