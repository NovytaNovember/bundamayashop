<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <!-- Tabel Laporan Penjualan -->
            <?php if (isset($laporan)) : ?>
                <div class="paper mt-4">
                    <div class="d-flex justify-content-between mb-3">
                        <!-- Tombol Perhari dan Perbulan -->
                        <div class="btn-group">
                            <a class="btn btn-default" href="<?= base_url('admin/laporan/laporan_harian'); ?>"> Perhari </a>
                            <a class="btn btn-default" href="<?= base_url('admin/laporan/laporan_bulanan'); ?>"> Perbulan </a>
                        </div>

                        <a href="<?= base_url('admin/laporan/kirim_laporan_harian'); ?>" class="btn btn-success"><i class="fas fa-paper-plane"></i>Kirim Laporan Harian</a>
                        <!-- Tombol Kirim Laporan Harian -->
                        <!-- <form id="laporanForm" action="<?= base_url('laporan/kirim_laporan_harian'); ?>" method="post">
                            <button type="submit" class="btn btn-success" id="submitButton">
                                <i class="fas fa-paper-plane"></i> Kirim Laporan Harian
                            </button>
                        </form> -->
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
                                            <td><?= esc($item['jumlah']); ?> buah</td>
                                            <td>Rp <?= number_format($item['total_harga'] / $item['jumlah'], 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total Keseluruhan</th>
                                    <th class="text-center"><?= $totalJumlahTerjual; ?> buah</th>
                                    <th class="text-center"></th> <!-- Kolom Harga Satuan dikosongkan -->
                                    <th class="text-center">Rp <?= number_format($totalKeseluruhan, 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- <script>
    // Menggunakan JavaScript untuk mencegah reload halaman
    document.getElementById("laporanForm").addEventListener("submit", function(e) {
        e.preventDefault(); // Mencegah form submit secara default
        
        // Mengirim form menggunakan AJAX
        fetch("<?= base_url('laporan/kirim_laporan_harian'); ?>", {
            method: "POST",
            body: new FormData(this),
        })
        .then(response => {
            if (response.ok) {
                // Jika sukses, tampilkan notifikasi
                alert("Laporan berhasil dikirim dan diunduh.");
                location.reload(); // Reload halaman agar tampilkan pesan baru
            } else {
                alert("Terjadi kesalahan saat mengirim laporan.");
            }
        });
    });
</script> -->

<?= $this->endSection(); ?>