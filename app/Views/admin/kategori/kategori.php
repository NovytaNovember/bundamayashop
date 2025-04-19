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
                        <i class="fas fa-plus me-1"></i> Tambah Kategori
                    </button>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kategori as $k) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $k['nama_kategori'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal"
                                            data-id="<?= $k['id_kategori'] ?>" data-nama="<?= $k['nama_kategori'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        <a href="<?= base_url('admin/kategori/delete/' . $k['id_kategori']) ?>"
                                            class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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
            <form action="<?= base_url('admin/kategori/store') ?>" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" required>
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
            <form action="<?= base_url('admin/kategori/update') ?>" method="post" class="modal-content">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_kategori" id="edit-id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nama_kategori" id="edit-nama" class="form-control" required>
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
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('[data-target="#editModal"]');
        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                document.getElementById('edit-id').value = id;
                document.getElementById('edit-nama').value = nama;
            });
        });
    });
</script>

<?= $this->endSection(); ?>