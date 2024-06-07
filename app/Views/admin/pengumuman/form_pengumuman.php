<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="table-container">
                <div class="form-header">
                    Form Tambah Data Pengumuman
                </div>
                <div class="form-container">
                    <form action="simpan_pendaftaran" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul_pengumuman">Judul Pengumuman:</label>
                            <input type="text" class="form-control" id="judul_pengumuman" name="judul_pengumuman" placeholder="Masukkan Judul Pengumuman" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pengumuman">Tanggal Pengumuman:</label>
                            <input type="date" class="form-control" id="tanggal_pengumuman" name="tanggal_pengumuman" placeholder="2003-11-22" required>
                        </div>

                        <div class="form-group">
                            <label for="file_pengumuman">File Pengumuman:</label>
                            <input type="file" class="form-control" id="file_pengumuman" name="file_pengumuman" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi:</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" required>
                        </div>

                        <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.content-wrapper -->

<?= $this->endSection(); ?>
