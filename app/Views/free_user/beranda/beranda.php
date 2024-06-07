<!DOCTYPE html>
<html lang="en">

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Hapus atau ganti favicon -->
        <title>Beranda</title>
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
                                    <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/sejarah') ?>">Sejarah Sekolah</a></li>
                                        <li class="nav-item"><a class="nav-link" href="/visi_misi">Visi Misi & Tujuan</a></li>
                                        <li class="nav-item"><a class="nav-link" href="/struktur">Struktur Organisasi</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="/tendik">Tenaga Pendidik</a></li>
                                <li class="nav-item"><a class="nav-link" href="/pendaftaran">Pendaftaran</a></li>
                                <li class="nav-item"><a class="nav-link" href="/pengumuman">Pengumuman</a></li>
                                <li class="nav-item"><a class="nav-link" href="/kegiatan">Kegiatan</a></li>
                                <li class="nav-item submenu dropdown ml-auto login">
                                    <a href="<?= base_url('login'); ?>" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
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
            </tbody>
            </table>
        </div>

    </body>

    </html>
    
    <!-- DEBUG-VIEW ENDED 1 APPPATH\Views\layout\header-user.php -->
    <!-- DEBUG-VIEW START 2 APPPATH\Views\pages\User\beranda.php -->
    <div class="container-fluid">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col">
                    <img src="<?= base_url() ?>/img/logo TK.png" alt="logo TK.png" class="img-fluid">
                </div>
                <div class="col">
                    <h4>Latar Belakang TK Kartika V-38</h4>
                    <p class="card-text" style="text-align: justify">Latar belakang lembaga ini didirikan adalah untuk menampung anak-anak prajurit TNI yang akan sekolah Taman Kanak-Kanak agar tidak jauh-jauh keluar dari asrama. Taman Kanak-Kanak Kartika V-38 berada dibawah naungan yayasan Kartika Jaya Cabang V Daerah Mulawarman. Yayasan ini bergerak dibidang pendidikan mulai dari PAUD sampai dengan Perguruan Tinggi.</p>
                    <div class="container text-center">
                        <div class="row align-items-start">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center  m-5">
            <div class="row">

                <div class="card col-lg-6">
                    <div class="card-body">
                        <h5 class="card-title">Visi</h5>
                        <!-- <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6> -->
                        <p class="card-text" style="text-align: justify">Mewujudkan generasi yang Beriman dan Bertaqwa, Gotong Royong, Toleransi, dan Berkarakter.</p>
                    </div>
                </div>
                <div class="card col-lg-6">
                    <div class="card-body">
                        <h5 class="card-title">Misi</h5>
                        <!-- <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6> -->
                        <ol class="card-text" style="text-align: justify">
                            <li> Menanamkan lingkungan belajar yang menumbuhkan keimanan dan ketakwaan pada Tuhan yang Maha Esa.</li>
                            <li> Menanamkan lingkungan belajar yang menumbuhkan sikap gotong royong.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="justify-content-center text-center">Kegiatan</h1>
        <div style="margin-bottom: 30px; margin-top: 50px;" class="container text-center">
            <div class="row ">
                <div class="card" style="width: 18rem;">
                    <img src="<?= base_url() ?>/img/pembuatan jasuke.jpg" class="card-img-top" alt="...">
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="<?= base_url() ?>/img/pembuatan jus.jpg" class="card-img-top" alt="...">
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="<?= base_url() ?>/img/persiapan pulang.jpg" class="card-img-top" alt="...">
                </div>
            </div>
        </div>
        <!-- DEBUG-VIEW ENDED 2 APPPATH\Views\pages\User\beranda.php -->
        <!-- DEBUG-VIEW START 3 APPPATH\Views\layout\footer.php -->
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
                            <p class="text-footer kuning" class="alamat">Kel Angsau Kec. Pelaihari Kab. Tanah Laut, di Jl. A Yani Km 2 Kompi Senapan C 623</p>
                            <p class="text-footer">
                            <p><br></p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="/script/script.js"></script>

</body>

</html>