<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="table-container">
                <div class="form-header">
                    Form Edit Data Profil
                </div>
                <div class="form-container">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="sejarah_sekolah">Sejarah Sekolah</label>
                            <input type="text" value="<?= $data[0]['sejarah_sekolah'] ?>" class="form-control" id="sejarah_sekolah" name="sejarah_sekolah" placeholder="Masukan Sejarah Sekolah" required>
                        </div>
                        <div class="form-group">
                            <label for="visi">Visi</label>
                            <input type="text" value="<?= $data[0]['visi_misi'] ?>" class="form-control" id="visi" name="visi" placeholder="Masukkan Visi Sekolah" required>
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" value="<?= $data[0]['tujuan'] ?>" class="form-control" id="tujuan" name="tujuan" placeholder="Masukkan Tujuan Sekolah" required>
                        </div>
                        <div class="form-group">
                            <label for="struktur_organisasi">Struktur Organisasi</label>
                            <input type="file" value="<?= $data[0]['struktur_organisasi'] ?>" class="form-control" id="struktur_organisasi" name="struktur_organisasi" placeholder="Masukkan Struktur Organisasi">
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.content-wrapper -->


    <?= $this->endSection(); ?>