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

    .card {
        position: relative;
        text-align: center;
    }

    /* Styling harga produk */
    .product-price {
        font-size: 16px;
        color: #28a745;
        font-weight: bold;
        margin-top: 10px;
        background-color: #f0f8ff;
        padding: 8px 15px;
        border-radius: 5px;
        display: inline-block;
    }

    .product-price::before {
        content: " ";
        font-weight: normal;
    }

    .product-info {
        padding: 15px;
    }

    .product-title {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
    }

    .jumlah-wrapper {
        margin-top: 10px;
    }

    /* Styling untuk gambar produk */
    .card img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="content">
            <div class="container-fluid my-4">
                <div class="paper p-4 shadow-sm bg-white rounded">
                    <form action="<?= base_url('admin/produk_terjual/update/' . $produkTerjual['id_produk_terjual']); ?>" method="POST">
                        <input type="hidden" name="produk_terjual_id" value="<?= $produkTerjual['id_produk_terjual']; ?>">

                        <h5> Produk Terjual yang Dipilih:</h5>
                        <div class="row">
                            <?php foreach ($produkItems as $item):
                                // Ambil data produk berdasarkan ID produk
                                $produk = $produkModel->find($item['id_produk']);
                            ?>
                                <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm text-center p-2">
                                        <div class="product-info">
                                            <div class="d-flex justify-content-center">
                                                <img src="<?= base_url('uploads/' . $produk['gambar']) ?>"
                                                    class="img-thumbnail mb-2"
                                                    style="width: 200px; height: 200px; object-fit: cover;"
                                                    alt="<?= esc($produk['nama_produk']) ?>">
                                            </div>

                                            <div class="d-flex justify-content-center mb-2">
                                                <label class="form-check-label fw-semibold product-title">
                                                    <?= esc($produk['nama_produk']); ?>
                                                </label>
                                            </div>

                                            <div class="product-price">
                                                Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>/pcs
                                            </div>

                                            <div class="jumlah-wrapper mt-1">
                                                <label for="jumlah<?= $produk['id_produk'] ?>">Jumlah:</label>
                                                <div class="d-flex justify-content-center align-items-center jumlah-group-kustom mt-1">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="ubahJumlah('jumlah<?= $produk['id_produk'] ?>', -1)">-</button>
                                                    <input type="number" id="jumlah<?= $produk['id_produk'] ?>" name="jumlah[]" class="form-control text-center mx-2 input-jumlah-kecil no-arrow" min="1" value="<?= $item['jumlah']; ?>" required>
                                                    <input type="hidden" name="produk_id[]" value="<?= $produk['id_produk']; ?>">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="ubahJumlah('jumlah<?= $produk['id_produk'] ?>', 1)">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= base_url('admin/produk_terjual'); ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                 Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleJumlah(checkbox) {
        const wrapper = checkbox.closest('.card').querySelector('.jumlah-wrapper');
        const inputJumlah = wrapper.querySelector('input');

        if (checkbox.checked) {
            wrapper.classList.remove('d-none');
            inputJumlah.classList.remove('d-none');
            inputJumlah.required = true;
        } else {
            wrapper.classList.add('d-none');
            inputJumlah.classList.add('d-none');
            inputJumlah.value = 1;
            inputJumlah.required = false;
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
