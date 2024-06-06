<?= $this->extend('template/template_kepsek_kegiatan'); ?>

  <?= $this->section('konten'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="table-container">
                        <div class="form-header">
                            Form Tambah Data Kegiatan
                        </div>
                        <div class="form-container">
                        <form action="simpan_kegiatan" method="post">
                                <div class="form-group">
                                    <label for="nama">Judul</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Judul" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" placeholder="Masukan Status" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_dibuat">Tanggal dibuat</label>
                                    <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" placeholder="2024-04-23" required>
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Unggah Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" placeholder="Masukkan gambar" required>
                                </div>

                                <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.content-wrapper -->

            <?= $this->endSection(); ?>          