<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <!-- jika berhasil  -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <!-- jika gagal  -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>


            <div class="table-container">
                <div class="form-header">
                    Form Tambah Data Kegiatan
                </div>

                <div class="form-container">
                    <form action="<?= base_url('tambah_kegiatan_kepsek'); ?>" method="post">
                        <div class="form-group">
                            <label for="nama">Judul</label>
                            <input type="text" class="form-control" id="nama" name="judul" placeholder="Masukan Judul" required>
                        </div>
                        <div class="form-group">
                            <label for="tendik" class="form-label">Tendik</label>
                            <select aria-label="Default select example" name="id_tendik">
                                <?php foreach ($tendik as $row) : ?>
                                    <option value="<?= $row['id_tendik'] ?>"><?= $row['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select aria-label="Default select example" name="status">
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_dibuat">Tanggal dibuat</label>
                            <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" placeholder="2024-04-23" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Unggah Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" placeholder="Masukkan gambar">
                        </div>

                        <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.content-wrapper -->

    <?= $this->endSection(); ?>