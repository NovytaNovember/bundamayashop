<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tabel Data Kegiatan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="table-container">
                <a class="btn btn-green" href="<?= base_url('tambah_kegiatan'); ?>">Tambah</a>
                <div class="search-box">
                    <label for="search">Search: </label>
                    <input type="text" id="search">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diubah</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $no = 1; ?>
                    <?php foreach ($kegiatan as $row) : ?>
                        <tbody>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['judul']; ?></td>
                                <td><?= $row['status']; ?></td>
                                <td><?= $row['tanggal_dibuat']; ?></td>
                                <td><?= $row['tanggal_diubah']; ?></td>
                                <td>
                                    <div class="card" style="width: 8rem;">
                                        <img src="<?= base_url() ?>/img/pembuatan jus.jpg" class="card-img-top" alt="..." div>
                                </td>
                                <td>
                                    <a href="<?= base_url('edit_kegiatan/' . $row['id_kegiatan']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <!-- <a id="hapus" href="<?= base_url('hapus_kegiatan/' . $row['id_kegiatan']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a> -->
                                    <a id="hapusButton" data-idkegiatan="<?= $row['id_kegiatan'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                </table>
                <script>
                    var idkegiatan;
                    const deleteButton = document.getElementById('hapusButton')
                    deleteButton.addEventListener('click', function(event) {
                        event.preventDefault(); // prevent default action of button click
                        idkegiatan = deleteButton.dataset.idkegiatan
                        let confirmResponse = confirm('Apakah anda yakin data ingin dihapus?')
                        if (confirmResponse) {
                            window.location.href = '<?= base_url('hapus_kegiatan/') ?>' + idkegiatan;
                        } else {
                            console.log('halo')
                        }
                    })
                </script>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<?= $this->endSection(); ?>