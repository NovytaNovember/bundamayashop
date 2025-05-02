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

                <!-- Tombol Tambah Perhitungan -->
                <div class="card-header">
                    <button type="button" class="btn btn-info text-white" data-toggle="modal" data-target="#addModalHarian">
                        <i class="fas fa-plus me-1"></i> Tambah Perhitungan Harian
                    </button>
                    <button type="button" class="btn btn-warning text-dark" data-toggle="modal" data-target="#addModalBulanan">
                        <i class="fas fa-plus me-1"></i> Tambah Perhitungan Bulanan
                    </button>
                </div>

                <!-- Tabel Data Perhitungan -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Pendapatan</th>
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
                                <td><?= $data['nama_produk'] ?></td>
                                <td>Rp <?= number_format($data['pendapatan'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($data['modal'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($data['keuntungan'], 0, ',', '.') ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn" data-toggle="modal" data-target="#editModal"
                                        data-id="<?= $data['id_perhitungan'] ?>" data-tanggal="<?= $data['tanggal'] ?>"
                                        data-produk="<?= $data['nama_produk'] ?>" data-pendapatan="<?= $data['pendapatan'] ?>"
                                        data-modal="<?= $data['modal'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $data['id_perhitungan'] ?>" data-toggle="modal" data-target="#deleteModal">
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

<!-- Modal Tambah Perhitungan Harian -->
<div class="modal fade" id="addModalHarian" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Perhitungan Harian</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('admin/perhitungan/store') ?>" method="post" id="formTambahPerhitunganHarian">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_produk">Nama Produk</label>
                        <select class="form-control" name="id_produk" id="id_produk" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach ($produk as $prod) : ?>
                                <option value="<?= $prod['id_produk'] ?>" data-kategori="<?= $prod['id_kategori'] ?>">
                                    <?= $prod['nama_produk'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
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

<!-- Modal Edit Perhitungan -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Perhitungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/perhitungan/update') ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_perhitungan" id="edit-id_perhitungan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-pendapatan">Pendapatan</label>
                        <input type="number" class="form-control" id="edit-pendapatan" name="pendapatan" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-modal">Modal</label>
                        <input type="number" class="form-control" id="edit-modal" name="modal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Perhitungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus data perhitungan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Edit, Hapus, dan Pendapatan Otomatis -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit Perhitungan
        const editBtns = document.querySelectorAll('.edit-btn');
        editBtns.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const pendapatan = this.getAttribute('data-pendapatan');
                const modal = this.getAttribute('data-modal');
                
                document.getElementById('edit-id_perhitungan').value = id;
                document.getElementById('edit-pendapatan').value = pendapatan;
                document.getElementById('edit-modal').value = modal;
            });
        });

        // Hapus Perhitungan
        const deleteBtns = document.querySelectorAll('.delete-btn');
        deleteBtns.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
                confirmDeleteBtn.onclick = function() {
                    window.location.href = `<?= base_url('admin/perhitungan/delete/') ?>/${id}`;
                };
                $('#deleteModal').modal('show');
            });
        });

        // Pendapatan Otomatis saat memilih produk
        document.getElementById('id_produk').addEventListener('change', function() {
            const id_produk = this.value;

            if (id_produk) {
                // Mengambil data produk untuk mendapatkan kategori
                fetch(`<?= base_url('admin/perhitungan/getPendapatan') ?>/${id_produk}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('pendapatan').value = data.pendapatan;  // Menampilkan pendapatan yang sudah dihitung
                    });
            } else {
                document.getElementById('pendapatan').value = ''; // Kosongkan jika tidak ada produk yang dipilih
            }
        });
    });
</script>

<?= $this->endSection(); ?>
