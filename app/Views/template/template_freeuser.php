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
        /* CSS untuk tampilan Full Width Image with Text (Struktur Organisasi) */

        /* Container untuk gambar dengan teks overlay */
        .struktur {
            position: relative;
            /* Relatif agar anak-anaknya bisa diatur absolut */
            display: flex;
            /* Menampilkan sebagai flex container */
            justify-content: center;
            /* Pusatkan horizontal */
            align-items: center;
            /* Pusatkan vertikal */
            height: 100vh;
            /* Tinggi sesuai dengan viewport */
            margin: 0;
            /* Hapus margin default */
        }

        /* Gambar responsif */
        .struktur .img-fluid {
            width: 100%;
            /* Lebar sesuai container */
            height: auto;
            /* Tinggi otomatis */
        }

        /* Teks overlay */
        .struktur .text-overlay {
            position: absolute;
            /* Teks posisi absolut di dalam container */
            color: white;
            /* Warna teks putih */
            font-size: 3rem;
            /* Ukuran teks */
            font-weight: bold;
            /* Ketebalan teks */
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
            /* Bayangan teks */
        }



        /* CSS untuk tampilan Full Width Image with Text (Visi Misi dan Tujuan) */

        /* Container untuk gambar dengan teks overlay */
        .visi_misi {
            position: relative;
            /* Relatif agar anak-anaknya bisa diatur absolut */
            display: flex;
            /* Menampilkan sebagai flex container */
            justify-content: center;
            /* Pusatkan horizontal */
            align-items: center;
            /* Pusatkan vertikal */
            height: 100vh;
            /* Tinggi sesuai dengan viewport */
            margin: 0;
            /* Hapus margin default */
        }

        /* Gambar responsif */
        .visi_misi .img-fluid {
            width: 100%;
            /* Lebar sesuai container */
            height: auto;
            /* Tinggi otomatis */
        }

        /* Teks overlay */
        .visi_misi .text-overlay {
            position: absolute;
            /* Teks posisi absolut di dalam container */
            color: white;
            /* Warna teks putih */
            font-size: 3rem;
            /* Ukuran teks */
            font-weight: bold;
            /* Ketebalan teks */
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
            /* Bayangan teks */
        }



        .nav-link {
            transition: color 0.3s;
            color: black !important;
        }

        .nav-link:hover,
        .nav-link:focus,
        .nav-link:active {
            color: green !important;
        }

        .dropdown-menu.show {
            background-color: green !important;
        }

        .dropdown-menu.show .nav-item {
            color: white !important;
        }

        .navbar-nav .ml-auto {
            margin-left: auto;
        }

        .tk-kartika {
            margin-right: 900px;
            margin-left: 20px;
            margin-top: -17px;
        }

        .info-table {
            text-align: center;
        }

        .menu_nav .nav-item {
            margin-right: 15px;
        }

        .login {
            margin-left: auto;
            margin-right: -20px;
        }

        .separator {
            margin-right: auto;
        }

        body html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .sejarah {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .struktur {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .visimisi {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .img-fluid {
            width: 100%;
            height: auto;
        }

        .text-overlay {
            position: absolute;
            color: white;
            font-size: 3rem;
            font-weight: bold;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
        }

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

        /* CSS 2 yang belum ada di CSS 1

         .card-body {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        } */


        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
        }


        .alert-success {
            text-align: left;
            /* Mengatur teks rata kiri */
        }

        .logo {
            margin-bottom: 20px;
            /* Atur margin bawah pada gambar logo */
        }

        .btn-cek {
            margin-top: 20px;
            /* Atur margin atas pada tombol Cek */
        }

        .btn-login {
            background-color: transparent;
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
                                    <li class="nav-item"><a class="nav-link" href="/visimisi">Visi Misi & Tujuan</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/struktur">Struktur Organisasi</a></li>
                                </ul>
                            </li>

                            <li class="nav-item"><a class="nav-link" href="/tendik_freeuser">Tenaga Pendidik</a></li>
                            <?php if (session()->get('level') == 'kepsek') : ?>
                                <li class="nav-item"><a class="nav-link" href="/pendaftaran_kepalasekolah">Pendaftaran</a></li>
                                <li class="nav-item"><a class="nav-link" href="/pengumuman_kepalasekolah">Pengumuman</a></li>
                            <?php elseif (!session()->get('isLogin') || session()->get('level') == 'peserta') : ?>
                                <li class="nav-item"><a class="nav-link" href="/pendaftaran_freeuser">Pendaftaran</a></li>
                                <li class="nav-item"><a class="nav-link" href="/pengumuman_freeuser">Pengumuman</a></li>
                            <?php endif; ?>
                            <li class="nav-item"><a class="nav-link" href="/kegiatan">Kegiatan</a></li>


                            <?php if (session()->get('isLogin') && session()->get('level') == 'peserta') : ?>
                                <form action="/logout" method="get">
                                    <?= csrf_field(); ?>
                                    <li class="nav-item submenu dropdown ml-auto login">
                                        <button type="submit" class="nav-link dropdown-toggle btn btn-login">logout</button>
                                    </li>
                                </form>
                            <?php elseif (!session()->get('isLogin')) : ?>
                                <form action="/login" method="get">
                                    <?= csrf_field(); ?>
                                    <li class="nav-item submenu dropdown ml-auto login">
                                        <button type="submit" class="nav-link dropdown-toggle btn btn-login">Login</button>
                                    </li>
                                </form>

                            <?php elseif (session()->get('isLogin') && session()->get('level') == 'kepsek') : ?>
                                <li class="nav-item submenu dropdown ml-auto login">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-info-circle"></i> Info
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <h4>Info Pengguna</h4>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-key"></i> <?= session()->get('level'); ?></a></li>

                                        <li class="nav-item"><a class="nav-link" href="/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
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



<!-- Konten Start -->

<?= $this->renderSection('konten')  ?>

<!-- Konten End -->

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

<?= $this->renderSection('script') ?>;
</body>