
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


        </tbody>
    </table>
    </div>
    
</body>

</html>

          </div>
        </div>
      </nav>
    </div>
  </div>
<!-- DEBUG-VIEW ENDED 1 APPPATH\Views\layout\header-user.php -->
<!-- DEBUG-VIEW START 2 APPPATH\Views\layout\banner.php -->

<!-- DEBUG-VIEW ENDED 2 APPPATH\Views\layout\banner.php -->
<!-- DEBUG-VIEW START 3 APPPATH\Views\pages\User\pengantar.php -->
<!-- Link Css -->
<link rel="stylesheet" href="/css/pengantarStyle.css">


          <div class="card text-center">
            <div class="card-body">
            <div class="content">
  
            <div class="col">
                <img src="<?= base_url()?>/img/logo TK.png" alt="logo TK.png" class="img-fluid">
         </div>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Anak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .search-box {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .icon {
            text-align: center;
        }
        body {
    font-family: Arial, sans-serif;
}

.table-header {
    display: flex;
    justify-content: flex-end; /* Align the search box to the right */
    margin-bottom: 10px; /* Space between search box and table */
}

.search-box {
    display: flex;
    align-items: center;
}

label {
    margin-right: 10px;
}

input[type="text"] {
    padding: 5px;
}

        


    </style>
</head>
<!-- Banner -->
    <div style="width: 300px; height:100px"></div>
    <div class="container">
        <div class="card text-center">
            <div class="card-body">
                <div class="content">
                   
                  <!-- Table Section -->
                  <div class="table-header">
            <div class="search-box">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search">
            </div>
        </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anak</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Novyta Maharani</td>
                                    <td>Tanah Laut</td>
                                    <td>22-11-2003</td>
                                    <td>Perempuan</td>
                                    <td>Islam</td>
                                    <td class="icon"><a href="#"><img src="https://img.icons8.com/ios-filled/50/000000/visible.png" alt="Detail" width="20"></a></td>
                                </tr>
                                <!-- Tambahkan baris lain sesuai kebutuhan -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





  
<!-- DEBUG-VIEW ENDED 3 APPPATH\Views\pages\User\pengantar.php -->
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