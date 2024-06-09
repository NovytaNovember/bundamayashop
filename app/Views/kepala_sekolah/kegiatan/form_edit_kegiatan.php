<?= $this->extend('template/template_kepsek_kegiatan'); ?>

<?= $this->section('konten'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="table-container">
                <div class="form-header">
                    Form Edit Data Kegiatan
                </div>
                <div class="form-container">
                    <form action="<?= base_url('edit_kegiatan_kepsek/') . $data['id_kegiatan'] ?>" method="post">
                        <div class="form-group">
                            <label for="nama">Judul</label>
                            <input type="text" value="<?= $data['judul'] ?>" class="form-control" id="nama" name="nama" placeholder="Masukan Judul" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" value="<?= $data['status'] ?>" class="form-control" id="status" name="status" placeholder="Masukan Status" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_dibuat">Tanggal dibuat</label>
                            <input type="date" value="<?= $data['tanggal_dibuat'] ?>" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" placeholder="2024-04-23" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_diubah">Tanggal diubah</label>
                            <input type="date" value="<?= $data['tanggal_diubah'] ?>" class="form-control" id="tanggal_diubah" name="tanggal_diubah" placeholder="2024-04-25" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Unggah Gambar</label>
                            <input type="file" value="<?= $data['gambar'] ?>" class="form-control" id="gambar" name="gambar" accept="image/*" placeholder="Masukkan gambar" required>
                        </div>

                        <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.content-wrapper -->

    <?= $this->endSection(); ?>