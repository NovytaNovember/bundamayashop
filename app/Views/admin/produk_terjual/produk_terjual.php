<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="content">
            <div class="container-fluid my-4">
                <div class="paper p-4 shadow-sm bg-white rounded">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                    <?php endif; ?>
                    <!-- Tombol Tambah Produk Terjual -->
                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <a href="<?= base_url('admin/produk_terjual/tambah') ?>" class="btn btn-success">
                            <i class="fas fa-plus me-1"></i> Tambah Produk Terjual
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Produk Terjual</th>
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
                                        $produkList[] = $item['nama_produk'] . ' (' . $item['jumlah'] . ' pcs )  = ' . ' (Rp ' . number_format($item['total_harga'], 0, ',', '.') . ')';
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
                                            <a href="<?= base_url('admin/produk_terjual/edit/' . $order['id_order']) ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <!-- Tombol Hapus dengan Modal -->
                                            <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $order['id_order'] ?>" data-nama="<?= $produkString ?>">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Produk Terjual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus data produk terjual ?
                <br>
                <strong id="produk-nama"></strong> <!-- Tampilkan nama produk yang relevan -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hapus Produk - Tampilkan Modal Konfirmasi
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const produk = this.getAttribute('data-nama');
                

                // Saat tombol hapus diklik, proses penghapusan produk
                const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
                confirmDeleteBtn.onclick = function() {
                    // Arahkan ke URL penghapusan
                    window.location.href = `<?= base_url('admin/produk_terjual/delete/') ?>/${id}`;
                };

                // Tampilkan modal
                $('#deleteModal').modal('show');
            });
        });
    });
</script>

<?= $this->endSection(); ?>
