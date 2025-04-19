<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bunda Maya Shop</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/template/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/template/AdminLTE-3.2.0/docs/assets/css/adminlte.min.css">
    <style>
        .paper {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .section {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            margin-right: 10px;
        }

        .table-container {
            margin: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table-container th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .table-container td .btn {
            margin-right: 5px;
        }

        .table-container .search-box {
            float: right;
            margin-bottom: 10px;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-blue {
            background-color: #007bff;
            color: white;
        }

        .btn-blue:hover {
            background-color: #0056b3;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .table-container {
            margin: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table-container th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .table-container td .btn {
            margin-right: 5px;
        }

        .table-container .search-box {
            float: right;
            margin-bottom: 10px;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .form-table {
            width: 100%;
            border: 1px solid #ddd;
            border-collapse: collapse;
        }

        .form-table th,
        .form-table td {
            border: 1px solid #ddd;
            padding: 15px;
            vertical-align: top;
        }

        .form-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px 5px 0 0;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .form-container form {
            flex: 1;
        }

        .form-container form .btn-primary {
            align-self: flex-end;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            margin-right: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .table-container {
            margin: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table-container th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .table-container td .btn {
            margin-right: 5px;
        }

        .table-container .search-box {
            float: right;
            margin-bottom: 10px;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">
                        <i class="fas fa-list"></i>
                        <span class="font-weight-bold" style="font-size: 1.2em;"><?= $judul; ?></span>

                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Info -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-info-circle"></i>
                        <span class="ml-1">Info</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Info Pengguna</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-key mr-2"></i> Level: Admin
                        </a>
                        <a href="/akun" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> Daftar Akun
                        </a>
                        <a href="/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="/img/logo_BM.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Bunda Maya Shop</span>
            </a>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/kategori" class="nav-link">
                            <i class="fas fa-th-list"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="/admin/produk" class="nav-link">
                            <i class="fas fa-birthday-cake"></i>
                            <p>Produk</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/order" class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Order</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/laporan/laporan_harian" class="nav-link">
                            <i class="fas fa-file-alt"></i>
                            <p>Laporan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/arsip_laporan/arsip_laporan_perhari" class="nav-link">
                            <i class="fas fa-archive"></i>
                            <p>Arsip Laporan</p>
                        </a>
                    </li>

                </ul>
            </nav>

    </div>
    </aside>

    <!-- Konten Start -->

    <?= $this->renderSection('konten')  ?>

    <!-- Konten End -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    </div><!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/template/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/template/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/template/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>



    <!-- PENCARIAN UNTUK FORM PENDAFATRAN ADMIN -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('input', function() {
                const searchText = this.value
                    .toLowerCase(); // Ambil teks pencarian dan ubah menjadi huruf kecil
                const tableRows = document.querySelectorAll(
                    '.table-container tbody tr'); // Ambil semua baris tabel
                tableRows.forEach(function(row) {
                    const namaCalon = row.querySelector('td:nth-child(2)').textContent
                        .toLowerCase(); // Ambil teks nama calon dari setiap baris tabel dan ubah menjadi huruf kecil
                    const tempatLahir = row.querySelector('td:nth-child(3)').textContent
                        .toLowerCase(); // Ambil teks tempat lahir dari setiap baris tabel dan ubah menjadi huruf kecil
                    const tanggalLahir = row.querySelector('td:nth-child(4)').textContent
                        .toLowerCase(); // Ambil teks tanggal lahir dari setiap baris tabel dan ubah menjadi huruf kecil
                    const jenisKelamin = row.querySelector('td:nth-child(5)').textContent
                        .toLowerCase(); // Ambil teks jenis kelamin dari setiap baris tabel dan ubah menjadi huruf kecil
                    const agama = row.querySelector('td:nth-child(6)').textContent
                        .toLowerCase(); // Ambil teks agama dari setiap baris tabel dan ubah menjadi huruf kecil

                    // Cek apakah teks pencarian ada dalam salah satu kolom tabel
                    if (namaCalon.includes(searchText) || tempatLahir.includes(searchText) ||
                        tanggalLahir.includes(searchText) || jenisKelamin.includes(searchText) ||
                        agama.includes(searchText)) {
                        row.style.display = ''; // Jika ada, tampilkan baris
                    } else {
                        row.style.display = 'none'; // Jika tidak, sembunyikan baris
                    }
                });
            });
        });
    </script>

</body>

</html>