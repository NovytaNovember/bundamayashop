<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="paper my-4">
                 <!-- Tombol Perhari dan Perbulan -->
                 <div class="btn-group">
                        <a class="btn btn-info text-white" href="<?= base_url('admin/perhitungan_perhari'); ?>">
                            <i class="fas fa-calendar-day"></i> Perhari
                        </a>
                        <a class="btn btn-warning text-dark" href="<?= base_url('admin/perhitungan_perbulan'); ?>">
                            <i class="fas fa-calendar-alt"></i> Perbulan
                        </a>
                    </div>


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

                <!-- Tombol Tambah Perhitungan -->
                <div class="card-header">
                    <button type="button" class="btn btn-info text-white" data-toggle="modal" data-target="#addModalHarian">
                        <i class="fas fa-plus me-1"></i> Tambah Perhitungan Perhari
                    </button>
                </div>

                <!-- Tabel Data Perhitungan -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pendapatan Hari Ini</th>
                            <th>Modal</th>
                            <th>Keuntungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($laporan as $data) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td>Rp <?= number_format($data['pendapatan'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($data['modal'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($data['keuntungan'], 0, ',', '.') ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn" data-toggle="modal" data-target="#editModal<?= $data['id_perhitungan'] ?>"
                                        data-id="<?= $data['id_perhitungan'] ?>" data-tanggal="<?= $data['tanggal'] ?>"
                                        data-modal="<?= $data['modal'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $data['id_perhitungan'] ?>" data-toggle="modal" data-target="#deleteModal">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit Perhitungan -->
                            <div class="modal fade" id="editModal<?= $data['id_perhitungan'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Perhitungan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('admin/perhitungan_perhari/update') ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" value="<?= $data['id_perhitungan'] ?>" name="id_perhitungan">
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="edit-tanggal">Tanggal</label>
                                                    <input type="date" value="<?= $data['tanggal'] ?>" class="form-control" id="edit-tanggal" name="tanggal" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit-modal">Modal</label>
                                                    <input type="number" value="<?= $data['modal'] ?>" class="form-control" id="edit-modal" name="modal" required>
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

                            <!-- Modal Konfirmasi Hapus -->
                            <!-- Modal Hapus Perhitungan -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="<?= base_url('admin/perhitungan_perhari/delete/' . $data['id_perhitungan']) ?>" id="deleteForm">
                                        <?= csrf_field(); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Perhitungan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data perhitungan ini?
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

<!-- Modal Tambah Perhitungan Harian -->
<div class="modal fade" id="addModalHarian" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Perhitungan Harian</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('admin/perhitungan_perhari/store') ?>" method="post" id="formTambahPerhitunganHarian">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal" class="mr-2">Pilih Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control mr-2" value="<?= $tanggal_terpilih ?? date('Y-m-d') ?>">
                    </div>

                    <div class="form-group">
                        <label for="modal">Modal</label>
                        <input type="number" class="form-control" name="modal" id="modal" required>
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

<!-- Modal Tambah Perhitungan Bulanan -->
<div class="modal fade" id="addModalBulanan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Perhitungan Bulanan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('admin/perhitungan/storeBulanan') ?>" method="post" id="formTambahPerhitunganBulanan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <input type="month" class="form-control" name="bulan" id="bulan" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="tahun" required>
                    </div>
                    <div class="form-group">
                        <label for="modal">Modal</label>
                        <input type="number" class="form-control" name="modal" id="modal" required>
                    </div>
                    <div class="form-group">
                        <label for="pendapatan">Pendapatan (Total Penjualan)</label>
                        <input type="text" class="form-control" name="pendapatan" id="pendapatan" readonly>
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







<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pendapatanHariIniInput = document.getElementById('pendapatan_hariini');
        const modalInput = document.getElementById('modal');
        const pendapatanOutput = document.getElementById('pendapatan');

        function hitungPendapatan() {
            // Ambil nilai dan ubah ke integer
            let pendapatanHariIni = parseInt(pendapatanHariIniInput.value.replace(/\D/g, '')) || 0;
            let modal = parseInt(modalInput.value) || 0;

            // Hitung pendapatan
            let pendapatan = pendapatanHariIni - modal;

            // Tampilkan hasil
            pendapatanOutput.value = pendapatan.toLocaleString('id-ID');
        }

        // Jalankan saat nilai modal berubah
        modalInput.addEventListener('input', hitungPendapatan);
    });
</script>


<?= $this->endSection(); ?>