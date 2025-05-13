<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="paper my-4">

                <!-- Flashdata -->
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('pesan'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>

                <!-- Navigasi + Tombol Tambah -->
                <div class="d-flex flex-column align-items-start gap-3 mb-3">
                    <!-- Navigasi -->
                    <div class="btn-group">
                        <a href="<?= base_url('admin/perhitungan_perhari'); ?>" class="btn btn-info text-white">
                            <i class="fas fa-calendar-day"></i> Perhari
                        </a>
                        <a href="<?= base_url('admin/perhitungan_perbulan'); ?>" class="btn btn-warning text-dark">
                            <i class="fas fa-calendar-alt"></i> Perbulan
                        </a>
                    </div>

                    <!-- Tombol Tambah -->
                    <button type="button" class="btn btn-success text-white mt-2" data-toggle="modal" data-target="#addModalHarian">
                        <i class="fas fa-plus me-1"></i> Tambah Perhitungan Perhari
                    </button>
                </div>


                <!-- Tabel Data -->
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
                                <td><?= $no++; ?></td>
                                <td><?= $data['tanggal']; ?></td>
                                <td>Rp <?= number_format($data['pendapatan'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($data['modal'], 0, ',', '.'); ?></td>
                                <td>Rp <?= number_format($data['keuntungan'], 0, ',', '.'); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $data['id_perhitungan']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?= $data['id_perhitungan']; ?>">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal<?= $data['id_perhitungan']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="<?= base_url('admin/perhitungan_perhari/update'); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id_perhitungan" value="<?= $data['id_perhitungan']; ?>">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Perhitungan</h5>
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
                            <div class="modal fade" id="deleteModal<?= $data['id_perhitungan']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="<?= base_url('admin/perhitungan_perhari/delete/' . $data['id_perhitungan']); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini?
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

<!-- Modal Tambah Harian -->
<div class="modal fade" id="addModalHarian" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/perhitungan_perhari/store'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Perhitungan Harian</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= $tanggal_terpilih ?? date('Y-m-d'); ?>" required>
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

<!-- Modal Tambah Bulanan -->
<div class="modal fade" id="addModalBulanan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/perhitungan/storeBulanan'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Perhitungan Bulanan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <input type="month" name="bulan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="number" name="tahun" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="modal">Modal</label>
                        <input type="number" name="modal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pendapatan">Pendapatan (Total Penjualan)</label>
                        <input type="text" name="pendapatan" id="pendapatan" class="form-control" readonly>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pendapatanInput = document.getElementById('pendapatan');
        const modalInput = document.getElementById('modal');
        const pendapatanHariIniInput = document.getElementById('pendapatan_hariini');
z
        function hitungPendapatan() {
            let pendapatanHariIni = parseInt(pendapatanHariIniInput?.value.replace(/\D/g, '')) || 0;
            let modal = parseInt(modalInput?.value) || 0;
            let pendapatan = pendapatanHariIni - modal;
            if (pendapatanInput) {
                pendapatanInput.value = pendapatan.toLocaleString('id-ID');
            }
        }

        modalInput?.addEventListener('input', hitungPendapatan);
        pendapatanHariIniInput?.addEventListener('input', hitungPendapatan);
    });
</script>

<?= $this->endSection(); ?>