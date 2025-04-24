<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="content">
            <div class="container-fluid my-4">
                <div class="paper p-4 shadow-sm bg-white rounded">
                    <h4 class="mb-4"><?= $judul ?? 'Konfirmasi Produk Terjual'; ?></h4>

                    <?php if (!empty($produk_terpilih)) : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    foreach ($produk_terpilih as $pr):
                                        $subtotal = $pr['jumlah'] * $pr['harga'];
                                        $total += $subtotal;
                                    ?>
                                        <tr class="text-center align-middle">
                                            <td><?= $no++; ?></td>
                                            <td><?= esc($pr['nama_produk']); ?></td>
                                            <td><?= esc($pr['jumlah']); ?></td>
                                            <td>Rp <?= number_format($pr['harga'], 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="fw-bold text-center">
                                        <td colspan="4">Total</td>
                                        <td>Rp <?= number_format($total, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Form Simpan Order -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="<?= base_url('admin/produk_terjual') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <form action="<?= base_url('admin/produk_terjual/simpan') ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="order_id" value="<?= $order_id ?>">
                                <?php foreach ($produk_terpilih as $i => $pr): ?>
                                    <input type="hidden" name="produk[<?= $i ?>][id_produk]" value="<?= $pr['id_produk'] ?>">
                                    <input type="hidden" name="produk[<?= $i ?>][jumlah]" value="<?= $pr['jumlah'] ?>">
                                    <input type="hidden" name="produk[<?= $i ?>][harga]" value="<?= $pr['harga'] ?>">
                                <?php endforeach; ?>
                                <input type="hidden" name="total_harga" value="<?= array_sum(array_column($produk_terpilih, 'subtotal')); ?>">

                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check me-1"></i> Simpan
                                </button>
                            </form>
                        </div>

                    <?php else : ?>
                        <div class="alert alert-warning text-center">
                            Tidak ada produk yang dipilih.
                        </div>
                        <div class="mt-3">
                            <a href="<?= base_url('admin/produk_terjual') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
