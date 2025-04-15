<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<style>
.card-header .row {
    display: flex;
    justify-content: space-between;
    /* Tombol tambah di kiri dan pencarian di kanan */
    align-items: center;
    /* Menyelaraskan elemen secara vertikal */
}

.card-header .col-6 {
    padding: 0;
    /* Mengurangi padding agar tidak ada jarak yang besar */
}

.card-header .d-flex {
    display: flex;
    justify-content: flex-end;
    /* Posisikan elemen di kanan */
    align-items: center;
}

.card-header .input-group {
    max-width: 250px;
    /* Lebar kolom pencarian lebih kecil */
}

.card-header label {
    font-weight: bold;
    /* Menambah penekanan pada label "Cari:" */
}

.card-header .col-6.text-right {
    text-align: right;
    /* Menjaga kolom pencarian tetap di kanan */
}
</style>


<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="paper my-4">

                <!-- Pesan sukses dan error -->
                <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php endif ?>
                <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
                <?php endif ?>
                <!-- Kolom Pencarian dan Button Tambah Data Sejajar -->
                <div class="card-header">
                    <div class="row">
                        <!-- Tombol Tambah Data (di kiri) -->
                        <div class="col-6">
                            <button type="button" class="btn btn-green" data-toggle="modal"
                                data-target="#addModal">Tambah Data</button>
                        </div>

                        <!-- Kolom Pencarian (di kanan) -->
                        <div class="col-6 text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <label for="searchInput" class="mr-2">Cari:</label>
                                <div class="input-group">
                                    <input type="text" id="searchInput" class="form-control form-control-sm"
                                        placeholder="Penjualan...">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Tabel Data Penjualan -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Penjualan</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Terjual</th>
                            <th>Harga Satuan</th>
                            <th>Total Penjualan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($penjualan as $data) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['tanggal_penjualan'] ?></td>
                            <td><?= $data['nama_produk'] ?></td>
                            <td><?= esc($data['jumlah_terjual']) ?> pcs</td>
                            <td>Rp <?= number_format($data['harga'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($data['total_penjualan'], 0, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm edit-btn" data-toggle="modal"
                                    data-target="#editModal" data-id="<?= $data['id_penjualan'] ?>"
                                    data-nama="<?= $data['nama_produk'] ?>" data-jumlah="<?= $data['jumlah_terjual'] ?>"
                                    data-harga="<?= $data['harga'] ?>" data-total="<?= $data['total_penjualan'] ?>"
                                    data-tanggal="<?= $data['tanggal_penjualan'] ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $data['id_penjualan'] ?>">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('admin/penjualan/store') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal Penjualan</label>
                        <input type="date" class="form-control" name="tanggal_penjualan" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Terjual</label>
                        <input type="text" id="jumlah_terjual" name="jumlah_terjual" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Satuan</label>
                        <input type="text" id="harga" name="harga" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Total Penjualan</label>
                        <input type="text" id="total_penjualan" name="total_penjualan" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('admin/penjualan/update') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id"> <!-- Hidden input for ID -->
                    <div class="form-group">
                        <label>Tanggal Penjualan</label>
                        <input type="date" class="form-control" id="edit-tanggal_penjualan" name="tanggal_penjualan"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" id="edit-nama_produk" name="nama_produk" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Terjual</label>
                        <input type="text" id="edit-jumlah_terjual" name="jumlah_terjual" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Satuan</label>
                        <input type="text" id="edit-harga" name="harga" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Total Penjualan</label>
                        <input type="text" id="edit-total_penjualan" name="total_penjualan" class="form-control"
                            readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    let jumlahInput = document.getElementById('jumlah_terjual');
    let hargaInput = document.getElementById('harga');
    let totalInput = document.getElementById('total_penjualan');
    let editJumlahInput = document.getElementById('edit-jumlah_terjual'); // Modal Edit
    let editHargaInput = document.getElementById('edit-harga'); // Modal Edit
    let editTotalInput = document.getElementById('edit-total_penjualan'); // Modal Edit

    // Fungsi untuk format angka dengan 'pcs'
    function formatPcs(value) {
        let angka = value.replace(/\D/g, ''); // Hanya angka
        return angka ? angka + " pcs" : "";
    }

    // Fungsi untuk mendapatkan angka murni dari input dengan 'pcs'
    function getNumberFromPcs(value) {
        return parseInt(value.replace(/\D/g, '')) ||
            0; // Menghapus karakter non-angka dan mengonversi ke integer
    }

    // Fungsi untuk menghitung total penjualan
    function hitungTotal() {
        let jumlah = getNumberFromPcs(jumlahInput.value); // Ambil jumlah terjual
        let harga = getNumberFromPcs(hargaInput.value); // Ambil harga satuan
        let total = jumlah * harga; // Hitung total
        totalInput.value = total; // Set nilai total penjualan pada input yang biasa
    }

    // Fungsi untuk menghitung total penjualan di modal edit
    function hitungTotalEdit() {
        let jumlah = getNumberFromPcs(editJumlahInput.value); // Ambil jumlah terjual
        let harga = getNumberFromPcs(editHargaInput.value); // Ambil harga satuan
        let total = jumlah * harga; // Hitung total
        editTotalInput.value = total; // Set nilai total penjualan pada input modal edit
    }

    // Event listener untuk input jumlah terjual
    jumlahInput.addEventListener('input', function() {
        this.value = formatPcs(this.value); // Format input dengan 'pcs'
        hitungTotal(); // Hitung total penjualan
    });

    // Event listener untuk input harga satuan
    hargaInput.addEventListener('input', function() {
        let angka = this.value.replace(/\D/g, ''); // Hanya ambil angka
        this.value = angka ? angka : ""; // Format ulang dengan angka murni
        hitungTotal(); // Hitung total penjualan
    });

    // Edit Modal
    const editBtns = document.querySelectorAll('.edit-btn');
    editBtns.forEach(button => {
        button.addEventListener('click', function() {
            // Ambil data dari data-attributes
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const jumlah = this.getAttribute('data-jumlah');
            const harga = this.getAttribute('data-harga');
            const total = this.getAttribute('data-total');
            const tanggal = this.getAttribute('data-tanggal');

            // Isi form modal dengan data yang diambil
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-tanggal_penjualan').value = tanggal;
            document.getElementById('edit-nama_produk').value = nama;
            document.getElementById('edit-jumlah_terjual').value = jumlah;
            document.getElementById('edit-harga').value = harga;
            document.getElementById('edit-total_penjualan').value =
                ''; // Reset total penjualan ketika modal dibuka

            // Menghitung total penjualan di modal jika harga atau jumlah berubah
            hitungTotalEdit
                (); // Panggil fungsi hitungTotal agar total langsung dihitung di modal edit
        });
    });

    // Event listener untuk input jumlah terjual di modal
    editJumlahInput.addEventListener('input', function() {
        hitungTotalEdit(); // Menghitung ulang total penjualan saat jumlah terjual diubah
    });

    // Event listener untuk input harga satuan di modal
    editHargaInput.addEventListener('input', function() {
        hitungTotalEdit(); // Menghitung ulang total penjualan saat harga satuan diubah
    });


    // Pencarian di Tabel
    document.getElementById('searchInput').addEventListener('input', function() {
        let searchQuery = this.value.toLowerCase();
        let rows = document.querySelectorAll('.table tbody tr'); // Ambil semua baris tabel

        rows.forEach(row => {
            let namaProduk = row.querySelector('td:nth-child(3)').textContent
                .toLowerCase(); // Ambil kolom "Nama Produk"
            if (namaProduk.includes(searchQuery)) {
                row.style.display = ''; // Tampilkan baris yang sesuai
            } else {
                row.style.display = 'none'; // Sembunyikan baris yang tidak sesuai
            }
        });
    });


    // Hapus Data dengan Konfirmasi
    let deleteBtn = null; // Tombol Hapus yang dipilih

    const deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(button => {
        button.addEventListener('click', function() {
            deleteBtn = this; // Simpan tombol Hapus yang dipilih
            $('#deleteModal').modal('show'); // Tampilkan modal konfirmasi
        });
    });



    // Konfirmasi Hapus Data
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteBtn) {
            const id = deleteBtn.getAttribute('data-id');
            window.location.href = "/admin/penjualan/delete/" + id; // Arahkan ke rute hapus
        }
    });

});
</script>




<?= $this->endSection(); ?>