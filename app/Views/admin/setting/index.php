<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="content">
            <div class="container-fluid my-4">
                <div class="paper my-4">

                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('pesan'); ?></div>
                    <?php endif; ?>

                    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-plus me-1"></i> Tambah Pengaturan
                    </button>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Toko</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Jam Operasional</th>
                                <th>Logo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($settings as $setting) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $setting['nama_toko'] ?></td>
                                    <td><?= $setting['alamat'] ?></td>
                                    <td><?= $setting['no_hp'] ?></td>
                                    <td><?= $setting['email'] ?></td>
                                    <td><?= $setting['jam_operasional'] ?></td>
                                    <td>
                                        <?php if (!empty($setting['logo'])) : ?>
                                            <img src="<?= base_url('uploads/logo/' . $setting['logo']) ?>" width="50">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"
                                            data-toggle="modal" data-target="#editModal"
                                            data-id="<?= $setting['id_setting'] ?>"
                                            data-nama="<?= $setting['nama_toko'] ?>"
                                            data-alamat="<?= $setting['alamat'] ?>"
                                            data-nohp="<?= $setting['no_hp'] ?>"
                                            data-email="<?= $setting['email'] ?>"
                                            data-jam="<?= $setting['jam_operasional'] ?>"
                                            data-logo="<?= $setting['logo'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        <a href="<?= base_url('admin/setting/delete/' . $setting['id_setting']) ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= base_url('admin/setting/store') ?>" method="post" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengaturan Toko</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- input tambah sama seperti sebelumnya -->
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Operasional</label>
                        <input type="text" name="jam_operasional" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control-file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= base_url('admin/setting/update') ?>" method="post" enctype="multipart/form-data" class="modal-content">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_setting" id="edit-id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengaturan Toko</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- field edit -->
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" id="edit-nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="edit-alamat" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" id="edit-nohp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Operasional</label>
                        <input type="text" name="jam_operasional" id="edit-jam" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Logo</label><br>
                        <input type="file" name="logo" class="form-control-file">
                        <br>
                        <img id="edit-logo-preview" width="100">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-target="#editModal"]').forEach(btn => {
        btn.addEventListener('click', () => {
            const data = btn.dataset;
            document.getElementById('edit-id').value       = data.id;
            document.getElementById('edit-nama').value     = data.nama;
            document.getElementById('edit-alamat').value   = data.alamat;
            document.getElementById('edit-nohp').value     = data.nohp;
            document.getElementById('edit-email').value    = data.email;
            document.getElementById('edit-jam').value      = data.jam;
            document.getElementById('edit-logo-preview').src = data.logo
                ? `<?= base_url('uploads/logo/') ?>${data.logo}`
                : '';
        });
    });
});
</script>

<?= $this->endSection(); ?>
