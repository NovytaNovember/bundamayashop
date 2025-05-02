<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<!-- STYLE -->
<style>
    input[type=number].no-arrow::-webkit-inner-spin-button,
    input[type=number].no-arrow::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number].no-arrow {
        -moz-appearance: textfield;
    }

    .jumlah-group-kustom button {
        padding: 2px 6px;
        font-size: 20px;
        width: 30px;
    }

    .input-jumlah-kecil {
        width: 40px;
        padding: 2px;
        font-size: 13px;
    }

    .checkbox-kustom {
        width: 50px;
        height: 18px;
        margin-right: 8px;
        margin-top: 2px;
    }

    .form-check-label {
        font-size: 16px;
        margin-left: 20px;
    }

    /* Styling harga produk */
.product-price {
    font-size: 18px;
    font-weight: bold;
    color: #2a9d8f;
    background-color: #f0f8ff;
    padding: 8px 15px;
    border-radius: 5px;
    display: inline-block;
    margin-top: 10px;
}

.product-price::before {
    content: " ";
    font-weight: normal;
}

.jumlah-wrapper {
    margin-top: 10px;
}

</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="content">
            <!-- Tambahkan margin-top agar terpisah dari header -->
            <div class="container-fluid mt-4 mb-4">
                <div class="paper p-4 shadow-sm bg-white rounded">

                    <h4 class="mb-4">Pilih Produk untuk Produk Terjual :</h4>

                    <form action="<?= base_url('admin/produk_terjual/konfirmasi') ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="row">
                            <?php foreach ($produk as $pr): ?>
                                <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm text-center p-2">

                                        <div class="d-flex justify-content-start align-items-center mb-2">
                                            <input class="form-check-input checkbox-kustom" type="checkbox" name="produk[]" value="<?= $pr['id_produk'] ?>" id="produk<?= $pr['id_produk'] ?>" onchange="toggleJumlah(this)">
                                            <label class="form-check-label fw-semibold" for="produk<?= $pr['id_produk'] ?>">Pilih Produk</label>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <img src="<?= base_url('uploads/' . $pr['gambar']) ?>" 
                                                 class="img-thumbnail mb-2" 
                                                 style="width: 200px; height: 200px; object-fit: cover;" 
                                                 alt="<?= esc($pr['nama_produk']) ?>">
                                        </div>

                                        <h5 class="card-title text-center mb-3"><?= esc($pr['nama_produk']) ?></h5>
                                         <!-- Harga produk -->
                                         <div class="product-price">
                                                Rp <?= number_format($pr['harga'], 0, ',', '.'); ?>/pcs
                                            </div>

                                        <div class="jumlah-wrapper d-none">
                                            <label for="jumlah<?= $pr['id_produk'] ?>">Jumlah:</label>
                                            <div class="d-flex justify-content-center align-items-center jumlah-group-kustom mt-1">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="ubahJumlah('jumlah<?= $pr['id_produk'] ?>', -1)">-</button>
                                                <input type="number" id="jumlah<?= $pr['id_produk'] ?>" name="jumlah[<?= $pr['id_produk'] ?>]" class="form-control text-center mx-2 input-jumlah-kecil no-arrow" min="1" value="1">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="ubahJumlah('jumlah<?= $pr['id_produk'] ?>', 1)">+</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                       <!-- Tombol Kembali & Lanjut -->
                       <div class="mt-4 d-flex justify-content-between">
                            <a href="<?= base_url('admin/produk_terjual') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Lanjut <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    function toggleJumlah(checkbox) {
        const wrapper = checkbox.closest('.card').querySelector('.jumlah-wrapper');
        if (checkbox.checked) {
            wrapper.classList.remove('d-none');
        } else {
            wrapper.classList.add('d-none');
            wrapper.querySelector('input').value = 1;
        }
    }

    function ubahJumlah(inputId, perubahan) {
        const input = document.getElementById(inputId);
        let nilai = parseInt(input.value);
        nilai = isNaN(nilai) ? 1 : nilai + perubahan;
        if (nilai < 1) nilai = 1;
        input.value = nilai;
    }
</script>

<?= $this->endSection(); ?>
