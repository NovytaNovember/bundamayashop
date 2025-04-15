<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php foreach ($produk as $data) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <!-- Menampilkan gambar produk -->
                        <img src="<?= base_url('uploads/' . esc($data['gambar'])) ?>" alt="Gambar Produk"
                            class="card-img-top" width="150" height="150">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($data['nama_produk']) ?></h5>
                            <p class="card-text"><?= esc($data['deskripsi']) ?></p>
                            <a href="#" class="btn btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>