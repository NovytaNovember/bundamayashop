<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Hapus atau ganti favicon -->
    <title>Portfolio</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="template/satner-master/css/bootstrap.css">
    <link rel="stylesheet" href="template/satner-master/vendors/linericon/style.css">
    <link rel="stylesheet" href="template/satner-master/css/font-awesome.min.css">
    <link rel="stylesheet" href="template/satner-master/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="template/satner-master/css/magnific-popup.css">
    <link rel="stylesheet" href="template/satner-master/vendors/nice-select/css/nice-select.css">
    <!-- main css -->
    <link rel="stylesheet" href="template/satner-master/css/style.css">

    <!-- Custom CSS untuk warna tombol dan dropdown -->
    <style>
        .nav-link {
            transition: color 0.3s;
            /* Efek transisi */
            color: black !important;
            /* Warna awal */
        }

        .nav-link:hover,
        .nav-link:focus,
        .nav-link:active {
            color: green !important;
            /* Warna saat cursor mengarah padanya dan saat diklik */
        }

        .dropdown-menu.show {
            background-color: green !important;
            /* Mengubah latar belakang dropdown menjadi hijau */
        }

        .dropdown-menu.show .nav-item {
            color: white !important;
            /* Mengubah warna tulisan menjadi putih */
        }

        .navbar-nav .ml-auto {
            margin-left: auto;
        }

        /* Custom CSS untuk menggeser TK Kartika V-38 ke kiri */
        .tk-kartika {
            margin-right: 900px;
            /* menggeser ke kiri */
            margin-left: 20px;
            /* Menghapus margin kiri */
            margin-top: -17px;
            /* menggeser ke atas */
        }

        /* Custom CSS untuk merata-tengah teks dalam tabel */
        .info-table {
            text-align: center;
        }

        /* CSS untuk mengatur ulang margin pada menu dan ikon login */
        .menu_nav .nav-item {
            margin-right: 15px;
            /* Menambahkan jarak antar item menu */
        }

        .login {
            margin-left: auto;
            /* Mengatur margin kiri untuk ikon login */
            margin-right: -20px;
        }

        /* Custom CSS untuk memisahkan TK Kartika V-38 dan Info */
        .separator {
            margin-right: auto;
            /* Memisahkan elemen di kiri dan kanan */
        }

        /* Pinggiran tabel berwarna hijau */
        .table-bordered {
            border: 2px solid green;
        }

        /* Judul form */
        .form-header {
            background-color: green;
            color: white;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 20px;
        }

        /* Form input */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

       /* CSS untuk membuat teks rata pinggir pada judul form */
        .form-header,
        .form-group label {
            text-align: start;
        }

        /* CSS untuk membuat teks rata pinggir pada semua elemen dalam form */
        form {
            text-align: start;
        }

        /* Styling untuk tabel hasil seleksi */
        .table-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .btn {
            background-color: green;
            color: white;
            margin-top: 20px;
            float: right;
        }

    </style>
</head>

<body>

    <!--================ Start Header Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav">
                            <li class="nav-item tk-kartika"><a class="nav-link" href="portfolio.html">TK Kartika V-38</a></li>
                            <li class="separator"></li> <!-- Separator to create space -->
                            <li class="nav-item active"><a class="nav-link" href="/beranda">Beranda</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="/sejarah">Sejarah Sekolah</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/visi_misi">Visi Misi & Tujuan</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/struktur">Struktur Organisasi</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="/tendik">Tenaga Pendidik</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pendaftaran">Pendaftaran</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pengumuman">Pengumuman</a></li>
                            <li class="nav-item"><a class="nav-link" href="/kegiatan">Kegiatan</a></li>
                            <li class="nav-item submenu dropdown ml-auto login">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class=></i> Login
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div style="width: 300px; height:100px"></div>
    <div class="container">
        <div class="table-container">
            <h4 class="text-center">HASIL SELEKSI PESERTA DIDIK BARU YANG DITERIMA<br>TK KARTIKA V-38<br>TAHUN PELAJARAN 2024-2025</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NO FORMULIR</th>
                        <th>NAMA PESERTA DIDIK</th>
                        <th>KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>001</td>
                        <td>RISKA ISTIQOMAH AFIFA</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>002</td>
                        <td>NOVYTA MAHARANI</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>003</td>
                        <td>IMELIA APRIANAH</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>004</td>
                        <td>YUNITA EVA APRILIYANA</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>005</td>
                        <td>NORRAHMAH</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>006</td>
                        <td>MUHAMMAD SURYA ANDHIKA</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>007</td>
                        <td>ARYA GUNA WIBOWO</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>008</td>
                        <td>NAYLA</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>009</td>
                        <td>AZIZAH ZAHRA</td>
                        <td>LULUS</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>010</td>
                        <td>AMIN</td>
                        <td>LULUS</td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group" style="margin-bottom: 80px;">
                <button type="submit" class="btn btn-success" style="float: right;">Kembali</button>
            </div>
            
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<!-- DEBUG-VIEW START 4 APPPATH\Views\layout\footer.php -->
<div class="container-xxl mt-5">
  <div class="footer text-start bg-success text-light mt-4">
    <div class="container text-start">
      <div class="row">
        <div class="col">
          <p class="text-footer">Media Sosial</p>
        </div>
        <div class="col">
          <p>Kontak</p>
          <p class="text-footer">0822-5004-4551</p>
          <p class="text-footer">tk.kompi623@gmail.com</p>
        </div>
        <div class="col">
          <p class="text-footer">TK Kartika V-38</p> 
          <p class="text-footer kuning" class="alamat">Kel. Angsau Kec. Pelaihari Kab. Tanah Laut, di Jl. A Yani Km 2 Kompi Senapan C 623</p>
          <p class="text-footer"><p><br></p></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="/script/script.js"></script>

</body>

</html>
<!-- DEBUG-VIEW ENDED 4 APPPATH\Views\layout\footer.php -->
