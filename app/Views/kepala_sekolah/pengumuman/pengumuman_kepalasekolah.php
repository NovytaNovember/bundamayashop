
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
        
        /* CSS untuk menghapus tanda bullet dan memberi jarak antara teks dan gambar di bawahnya */
        .card-body li {
            list-style-type: none; /* Menghapus tanda bulat */
            margin-bottom: 20px; /* Memberikan jarak antara teks dan gambar di bawahnya */
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

<div class="container-fluid">
    <!-- <div class="container text-start">
        <div class="row">
            <div class="col-sm-4">
                <img src="/img/illustrasi2.png" class="img-fluid" alt="...">
            </div>
            <div class="col-sm-8">
                <h5>
                    Selamat datang di Satuan Satgas Pencegahan dan Penanganan Kekerasan Seksual Politeknik Negeri Tanah Laut
                </h5>
                <p class="paragraph">
                    Kami dengan tulus mengucapkan selamat datang dan berterima kasih atas kunjungan Anda ke platform ini. Website ini didedikasikan untuk memberikan suara kepada mereka yang mungkin telah mengalami kekerasan seksual atau berada dalam situasi yang meresahkan.
                </p>
                <p class="paragraph">
                    Kekerasan seksual adalah masalah serius yang memengaruhi banyak individu di seluruh dunia. Kami menyadari betapa pentingnya memberikan sumber daya, dukungan, dan pelaporan yang tepat untuk korban kekerasan seksual. Di sini, kami menawarkan berbagai sumber daya, informasi, dan panduan yang dapat membantu Anda dalam menghadapi situasi yang sulit ini.
                </p>
                <p class="paragraph">
                    Kami percaya bahwa setiap cerita penting, dan kami siap mendengarkan dan mendukung Anda. Kami juga menyediakan alat pelaporan yang aman dan terpercaya untuk membantu pihak berwenang menindaklanjuti tindakan kekerasan seksual.
                </p>
                <hr>
                <h5>Tujuan Satgas PPKS ULM <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                    </svg></h5>
                Meningkatkan pemenuhan perlindungan dan penghargaan pada hak-hak mahasiswa/i dalam rangka mencapai program Merdeka belajar. Tes 123                <hr>
                <h5>Visi : </h5>
                <p class="paragraph">
                    Mewujudkan pemenuhan hak-hak dasar/ asasi mahasiswa untuk mencapai Kesejahteraan,Perlindungan dan Penghapusan segala bentuk tindak kekerasan terhadap Mahasiswa/i dalam kehidupan kampus, bermasyarakat, berbangsa dan bernegara.                </p>
                <h5>Misi : </h5>
                <ol><li><span style="color: rgb(68, 68, 68); font-family: Raleway, sans-serif; text-align: justify; background-color: rgb(255, 255, 255);">Meningkatkan pemenuhan perlindungan hak-hak mahasiswa untuk </span><span style="color: inherit; font-family: inherit; text-align: justify; background-color: rgb(255, 255, 255);">terciptanya zona merdeka belajar.</span></li><li><span style="color: inherit; font-family: inherit; text-align: justify; background-color: rgb(255, 255, 255);">Penghapusan segala bentuk tindak kekerasan terhadap mahasiswa/i</span></li><li><span style="color: inherit; font-family: inherit; text-align: justify; background-color: rgb(255, 255, 255);">Peningkatan kemampuan kelembagaan dalam melaksanakan program <span style="color: inherit; font-family: inherit; font-weight: 600;">sesuai amanah Kemendikbud No. 30 Tahun 2021 untuk menghapus </span><span style="color: inherit; font-family: inherit; font-weight: 600;">segala bentuk kekerasan seksual di Universitas Lambung Mangkurat </span><span style="color: inherit; font-family: inherit;">Tes</span><br></span><br></li></ol>            </div>
        </div>
    </div> -->
    <div class="card text-center">
  <div class="card-body">
  <div class="content">
  
    <div class="col">
                <img src="<?= base_url()?>/img/logo TK.png" alt="logo TK.png" class="img-fluid">
            </div>

    <h4>Belum Ada Pengumuman</h4>
    <li> Belum ada yang melakukan pendaftaran untuk saat ini</li>

    <div class="justify-content-center">
        <img src="/img/background.jpg" class="img-fluid" alt="..." style="width: 60%">
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