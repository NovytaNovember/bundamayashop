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
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif ?>

                <!-- Tombol Tambah Data Produk -->
                <div class="card-header">
                    <button type="button" class="btn btn-green" data-toggle="modal" data-target="#addModal">Tambah
                        Produk</button>
                </div>

                <!-- Tabel Data Produk -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($produk as $data) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama_produk'] ?></td>
                                <td><?= $data['deskripsi'] ?></td>
                                <td><?= $data['nama_kategori'] ?></td>
                                <td>Rp<?= number_format($data['harga'], 0, ',', '.') ?></td>
                                <td><img src="<?= base_url('uploads/' . $data['gambar']) ?>" width="100" /></td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn" data-toggle="modal"
                                        data-target="#editModal"
                                        data-id="<?= $data['id_produk'] ?>"
                                        data-nama="<?= $data['nama_produk'] ?>"
                                        data-deskripsi="<?= $data['deskripsi'] ?>"
                                        data-kategori-id="<?= $data['id_kategori'] ?>"
                                        data-harga="<?= $data['harga'] ?>"
                                        data-gambar="<?= $data['gambar'] ?>">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>

                                    <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $data['id_produk'] ?>">
                                        <i class="fa fa-trash"></i> Hapus
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

<!-- Modal Tambah Produk -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('admin/produk/store') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Pilih Kategori</label>
                        <select class="form-control" name="id_kategori" id="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $kat) : ?>
                                <option value="<?= $kat['id_kategori'] ?>">
                                    <?= $kat['nama_kategori'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar Produk</label>
                        <input type="file" class="form-control" name="gambar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Produk -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/produk/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_produk" id="edit-id_produk">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-nama">Nama Produk</label>
                        <input type="text" class="form-control" id="edit-nama" name="nama_produk" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="edit-deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-kategori">Kategori</label>
                        <select class="form-control" id="edit-kategori" name="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $kat) : ?>
                                <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-harga">Harga</label>
                        <input type="number" class="form-control" id="edit-harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-gambar">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="edit-gambar">
                        <span id="edit-gambar-lama"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Edit Produk
        const editBtns = document.querySelectorAll('.edit-btn');
        editBtns.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const deskripsi = this.getAttribute('data-deskripsi');
                const kategoriId = this.getAttribute('data-kategori-id');
                const harga = this.getAttribute('data-harga');
                const gambar = this.getAttribute('data-gambar');

                document.getElementById('edit-id_produk').value = id;
                document.getElementById('edit-nama').value = nama;
                document.getElementById('edit-deskripsi').value = deskripsi;
                document.getElementById('edit-kategori').value = kategoriId;
                document.getElementById('edit-harga').value = harga;
                document.getElementById('edit-gambar-lama').textContent = gambar;
            });
        });

        // Hapus Produk
        const deleteBtns = document.querySelectorAll('.delete-btn');
        deleteBtns.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
                confirmDeleteBtn.onclick = function () {
                    window.location.href = `<?= base_url('admin/produk/delete/') ?>/${id}`;
                };
                $('#deleteModal').modal('show');
            });
        });
    });
</script>

<?= $this->endSection(); ?>
