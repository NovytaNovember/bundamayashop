<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="paper my-4">
                <!-- Flashdata -->
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif ?>

                <!-- Tombol Perhitungan Perbulan, Perhari, dan Tambah -->
                <div class="d-flex justify-content-between mb-3">
                    <!-- Tombol Tambah Modal -->
                    <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>
                        <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus me-1"></i> Tambah Modal Penjualan
                        </button>
                    <?php endif; ?>

                    <!-- Tombol Kembali ke Halaman Perhitungan Perbulan -->
                    <a href="<?= base_url('admin/perhitungan_perbulan'); ?>" class="btn btn-secondary">
                        Kembali <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

                <!-- Tabel Data Modal History -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Modal</th>
                            <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($modal_history as $data) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['tanggal']; ?></td>
                                <td>Rp <?= number_format($data['modal'], 0, ',', '.'); ?></td>
                                <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $data['id_modal']; ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?= $data['id_modal']; ?>">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal<?= $data['id_modal']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="<?= base_url('admin/modal_penjualan/update'); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id_modal" value="<?= $data['id_modal']; ?>">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="modal">Modal</label>
                                                    <input type="number" name="modal" class="form-control" value="<?= $data['modal']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="deleteModal<?= $data['id_modal']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="<?= base_url('admin/modal_penjualan/delete/' . $data['id_modal']); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data modal ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/modal_penjualan/store'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Modal</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="modal">Modal</label>
                        <input type="number" name="modal" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>