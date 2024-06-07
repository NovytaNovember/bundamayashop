
<!-- DEBUG-VIEW START 1 APPPATH\Views\layout\header-user.php -->
<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sejarah Sekolah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/css-public.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/galeri.css">
  <link rel="stylesheet" href="/css/profil.css">
</head>

<body>
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
          /* CSS untuk menyesuaikan lebar tabel persyaratan */
        .alert-success {
            max-width: 300px; /* Sesuaikan lebar maksimum tabel dengan kebutuhan Anda */
            margin-left: auto; /* Menengahkan tabel persyaratan */
            margin-right: auto; /* Menengahkan tabel persyaratan */
        }

        /* CSS untuk membuat footer lebar seperti yang diinginkan */
        .footer {
            width: 100%; /* Mengatur lebar footer menjadi 100% */
        }

        /* CSS untuk memperlebar tabel persyaratan ke samping */
        .alert-success {
            max-width: 600px; /* Sesuaikan lebar maksimum tabel dengan kebutuhan Anda */
            margin-left: auto; /* Menengahkan tabel persyaratan */
            margin-right: auto; /* Menengahkan tabel persyaratan */
        }

        .alert-success ul {
            padding-left: 20px; /* Meratakan teks dengan membuat padding kiri */
        }

        .alert-success ul li {
            text-align: left; /* Menjadikan teks rata awal */
        }

                .content .col img {
            margin-bottom: 30px; /* Menambahkan jarak antara gambar dan teks */
        }

        .content .btn {
            margin-top: 30px; /* Menambahkan jarak antara teks dan tombol */
        }


        font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            width: 100%;
        }
        .container table {
            width: 100%;
            border-collapse: collapse;
        }
        .container table td {
            padding: 8px 0;
        }
        .container table td:first-child {
            width: 150px;
            font-weight: bold;
        }
        .container .button-container {
            text-align: right;
            margin-top: 20px;
        }
        .container .button-container button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .container .button-container button:hover {
            background-color: #218838;

        font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .paper {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 8px 0;
        }
        table td:first-child {
            width: 150px;
            font-weight: bold;
            text-align: left;
        }
        table td:last-child {
            text-align: left;
        }
        .button-container {
            text-align: right;
            margin-top: 20px;
        }
        .button-container button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container button:hover {
            background-color: #218838;
        }


    </style>
</head>

<body>

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
                                    <i class></i> Login
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
        <div class="card text-center ">
            <div class="card-body">
                <div class="content">
                 <div class="col">
                <img src="<?= base_url()?>/img/logo TK.png" alt="logo TK.png" class="img-fluid">
                </div>
            </div>
            <div class="paper">
        <table>
            <tr>
                <td>Nama Anak</td>
                <td>: Novyta Maharani</td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>: Tanah Laut</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: 22-11-2003</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: Perempuan</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: Islam</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: Pelaihari, jl.kasturi rt/rw. 01/02</td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>: Arya Guna</td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>: Fatmayanti</td>
            </tr>
            <tr>
                <td>Pekerjaan Ayah</td>
                <td>: Dosen</td>
            </tr>
            <tr>
                <td>Pekerjaan Ibu</td>
                <td>: Ibu Rumah Tangga</td>
            </tr>
            <tr>
                <td>No Telepon Ayah</td>
                <td>: 085390784244</td>
            </tr>
            <tr>
                <td>No Telepon Ibu</td>
                <td>: 082154657730</td>
            </tr>
        </table>
        <div class="button-container">
            <button>Kembali</button>
        </div>
    </div>
        </div>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="/script/script.js"></script>

</body>

</html>
<!-- DEBUG-VIEW ENDED 4 APPPATH\Views\layout\footer.php -->