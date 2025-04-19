<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="content">
            <div class="container-fluid my-4">
                <div class="paper p-4 shadow-sm bg-white rounded">

                    <!-- Tombol Tambah Order -->
                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <a href="<?= base_url('admin/order/tambah') ?>" class="btn btn-success">
                            <i class="fas fa-plus me-1"></i> Tambah Order
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Order</th>
                                    <th>Produk yang Dibeli</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($orders as $order):
                                    $produkList = [];
                                    $totalHarga = 0;
                                    foreach ($order['items'] as $item) {
                                        $produkList[] = $item['nama_produk'] . ' (' . $item['jumlah'] . ' buah )  = ' . ' (Rp ' . number_format($item['total_harga'], 0, ',', '.') . ')';
                                        $totalHarga += $item['total_harga'];
                                    }
                                    $produkString = implode('<br>', $produkList);

                                    // Format tanggal + jam dengan timezone Asia/Makassar
                                    $date = new DateTime($order['created_at'], new DateTimeZone('UTC'));
                                    $date->setTimezone(new DateTimeZone('Asia/Makassar'));
                                    $tanggalOrder = $date->format('d F Y H:i');
                                ?>
                                    <tr class="text-center align-middle">
                                        <td><?= $no++; ?></td>
                                        <td><?= $tanggalOrder; ?></td>
                                        <td class="text-start"><?= $produkString; ?></td>
                                        <td>Rp <?= number_format($totalHarga, 0, ',', '.'); ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/order/edit/' . $order['id_order']) ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <a href="<?= base_url('admin/order/delete/' . $order['id_order']); ?>"
                                                onclick="return confirm('Yakin ingin menghapus order ini?');"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>