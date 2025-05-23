<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="paper my-4">
                <!-- Pesan sukses dan error -->
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

                <!-- Informasi Modal -->
                <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>
                    <div class="alert alert-info" style="background-color: #a7c7e7; color: #3b3b3b; border-color: #8da9c4;">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Catatan:</strong> Modal yang digunakan dalam perhitungan perbulan ini akan diambil dari data histori modal penjualan yang sudah ada. Pilih modal yang sesuai dari daftar yang tersedia sebelum menyimpan perhitungan.
                        <a href="<?= base_url('admin/modal_penjualan'); ?>" class="btn btn-link" style="color: #007bff; text-decoration: underline;">Klik di sini untuk tambah modal</a>
                    </div>
                <?php endif; ?>

                <!-- Tombol Perhitungan Perbulan dan Tambah -->
                <div class="d-flex flex-column align-items-start gap-3 mb-3">
                    <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>
                        <!-- Tombol Tambah Modal -->
                        <button type="button" class="btn btn-success text-white mt-2" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus me-1"></i> Tambah Perhitungan Perbulan
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Tabel Data Perhitungan -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Pendapatan Hari Ini</th>
                            <th>Modal Penjualan</th>
                            <th>Keuntungan</th>
                            <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($laporan as $data) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <!-- Kolom Tanggal (Bulan & Tanggal) -->
                                <td>
                                    <?php
                                    $bulan = (new \DateTime($data['tanggal']))->format('m');
                                    $bulanIndo = [
                                        '01' => 'Januari',
                                        '02' => 'Februari',
                                        '03' => 'Maret',
                                        '04' => 'April',
                                        '05' => 'Mei',
                                        '06' => 'Juni',
                                        '07' => 'Juli',
                                        '08' => 'Agustus',
                                        '09' => 'September',
                                        '10' => 'Oktober',
                                        '11' => 'November',
                                        '12' => 'Desember'
                                    ];
                                    echo $bulanIndo[$bulan];
                                    ?>
                                </td>
                                <!-- Kolom Tahun -->
                                <td><?= (new \DateTime($data['tanggal']))->format('Y'); ?></td>
                                <td>Rp <?= number_format($data['pendapatan'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($data['modal'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($data['keuntungan'], 0, ',', '.') ?></td>
                                <?php if (in_array(session()->get('level'), ['admin', 'petugas'])) : ?>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $data['id_perhitungan']; ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?= $data['id_perhitungan']; ?>">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Perhitungan Perbulan -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Perhitungan Perbulan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('admin/perhitungan_perbulan/store') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <!-- Bulan Dropdown -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="bulan" class="font-weight-bold text-muted">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    <option value="">Pilih Bulan</option>
                                    <?php foreach ($listBulan as $key => $value): ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Tahun Dropdown -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="tahun" class="font-weight-bold text-muted">Tahun</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    <option value="">Pilih Tahun</option>
                                    <?php foreach ($listTahun as $key => $value): ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Selections -->
                    <div class="form-group">
                        <label for="modal">Modal Penjualan</label>
                        <select class="form-control" name="modal" id="modal" required>
                            <option value="">Pilih Modal Penjualan</option>
                            <?php foreach ($modal_penjualan as $modal) : ?>
                                <option value="<?= $modal['id_modal']; ?>">
                                    Rp <?= number_format($modal['modal'], 0, ',', '.'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Perhitungan Perbulan -->
<?php foreach ($laporan as $data) : ?>
    <div class="modal fade" id="editModal<?= $data['id_perhitungan']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $data['id_perhitungan']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $data['id_perhitungan']; ?>">Edit Perhitungan Perbulan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/perhitungan_perbulan/update') ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_perhitungan" value="<?= $data['id_perhitungan']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Bulan Dropdown -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="bulan<?= $data['id_perhitungan']; ?>" class="font-weight-bold text-muted">Bulan</label>
                                    <select name="bulan" id="bulan<?= $data['id_perhitungan']; ?>" class="form-control" required>
                                        <?php foreach ($listBulan as $key => $value): ?>
                                            <option value="<?= $key; ?>" <?= (date('m', strtotime($data['tanggal'])) == $key) ? 'selected="selected"' : ''; ?>>
                                                <?= $value; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Tahun Dropdown -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="tahun<?= $data['id_perhitungan']; ?>" class="font-weight-bold text-muted">Tahun</label>
                                    <select name="tahun" id="tahun<?= $data['id_perhitungan']; ?>" class="form-control" required>
                                        <?php foreach ($listTahun as $key => $value): ?>
                                            <option value="<?= $key; ?>" <?= (date('Y', strtotime($data['tanggal'])) == $key) ? 'selected="selected"' : ''; ?>>
                                                <?= $value; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Penjualan Dropdown -->
                        <div class="form-group">
                            <label for="modal<?= $data['id_perhitungan']; ?>">Modal Penjualan</label>
                            <select class="form-control" name="modal" id="modal<?= $data['id_perhitungan']; ?>" required>
                                <!-- Opsi modal yang sudah dipilih tetap muncul dan selected -->
                                <option value="<?= $data['modal']; ?>" selected>
                                    Rp <?= number_format($data['modal'], 0, ',', '.'); ?>
                                </option>

                                <!-- Opsi lain dari modal_penjualan tanpa modal yang sudah dipilih -->
                                <?php foreach ($modal_penjualan as $modal) : ?>
                                    <?php if ((string)$modal['id_modal'] !== (string)$data['modal']) : ?>
                                        <option value="<?= $modal['id_modal']; ?>">
                                            Rp <?= number_format($modal['modal'], 0, ',', '.'); ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Hapus Perhitungan -->
<?php foreach ($laporan as $data) : ?>
    <div class="modal fade" id="deleteModal<?= $data['id_perhitungan']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('admin/perhitungan_perbulan/delete/' . $data['id_perhitungan']) ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus perhitungan ini?
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


<?= $this->endSection(); ?>