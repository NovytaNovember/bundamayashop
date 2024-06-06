<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Profil</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url() ?>/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/AdminLTE-3.2.0/docs/assets/css/adminlte.min.css">
    <style>
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
                        <span class="font-weight-bold" style="font-size: 1.2em;">Profil Admin</span>
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
                        <a href="./index2.html" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> Daftar Akun
                        </a>
                        <a href="./index3.html" class="dropdown-item">
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
                <img src="/template/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/template/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="fas fa-home"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="fas fa-user"></i>
                                <p>
                                    Profil
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <p>Tenaga Pendidik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="fas fa-calendar"></i>
                                <p>Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="form_pendaftaran" class="nav-link">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Pendaftaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="fas fa-bullhorn"></i>
                                <p>Pengumuman</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tabel Data Profil</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="table-container">
                        <div class="search-box">
                            <label for="search">Search: </label>
                            <input type="text" id="search">
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sejarah Sekolah</th>
                                    <th>Visi</th>
                                    <th>Misi</th>
                                    <th>Tujuan Sekolah</th>
                                    <th>Struktur Organisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <p class="card-text" style="text-align: justify">
                                            Taman Kanak-Kanak Kartika V-38 terletak di Kelurahan Angsau Kecamatan Pelaihari Kabupaten Tanah Laut, tepatnya di Jl. A Yani Km 2 Kompi Senapan C 623 sejak tahun 1993. Latar belakang lembaga ini didirikan adalah untuk menampung anak-anak prajurit TNI yang akan sekolah Taman Kanak-Kanak agar tidak jauh-jauh keluar dari asrama.
                                            Gedung atau ruangan yang digunakan untuk ruangan kelas pertama adalah gudang yang ada dibelakang Aula Kompi. Tapi setelah satu tahun berlangsung yaitu pada tahun 1994 akhirnya diberi 3 lokal untuk dijadikan ruangan kelas yang sebelumnya merupakan bangunan milik Kompi Senapan C 623 dan sampai sekarang masih digunakan.
                                            Pada awal berdiri TK Kartika V-38 bernama TK Kartika VI-38. Seiring perkembangan jaman pada tahun 2007 ada perubahan nama dari TK Kartika VI-38 menjadi Kartika V-38.
                                            Pada tahun 1993 awal berdiri Taman Kanak-Kanak Kartika V-38 mempunyai 2 orang guru dan 1 Kepala Sekolah. Dalam perkembangannya TK Kartika V-38 sudah mengalami pergantian Kepala Sekolah sebanyak empat kali. Mulai yang pertama Ibu Siti Rukayah, kedua Ibu Aina, ketiga Ibu Tutik Wirahayu dan yang keempat Ibu Suwarni.
                                            Taman Kanak-Kanak Kartika V-38 berada dibawah naungan yayasan Kartika Jaya Cabang V Daerah Mulawarman. Yayasan ini bergerak dibidang pendidikan mulai dari PAUD sampai dengan Perguruan Tinggi.
                                    </td>
                                    </ol>
                                    <td>
                                        <p class="card-text" style="text-align: justify">Mewujudkan generasi yang Beriman dan Bertaqwa, Gotong Royong, Toleransi, dan Berkarakter</p>.
                                    </td>
                                    </ol>
                                    <td>
                                        <li>Menanamkan lingkungan belajar yang menumbuhkan keimanan dan ketakwaan pada Tuhan yang Maha Esa.</li>
                                        <li>Menanamkan lingkungan belajar yang menumbuhkan sikap gotong royong.</li>
                                        <li>Menanamkan lingkungan belajar yang menumbuhkan sikap saling menghargai dalam perbedaan.</li>
                                        <li>menanamkan lingkungan belajar yang menumbuhkan sikap disiplin, tanggung jawab, jujur, kreatif, dan mandiri.</li>
                                    </td>
                                    <td>
                                        <li>Terwujudnya lingkungan belajar yang menumbuhkan keimanan dan ketakwaan pada Tuhan yang Maha Esa.</li>
                                        <li>Terwujudnya lingkungan belajar yang menumbuhkan sikap gotong royong.</li>
                                        <li>Terwujudnya lingkungan belajar yang menumbuhkan sikap saling menghargai dalam perbedaan.</li>
                                        <li>Terwujudnya pribadi anak yang disiplin, tanggung jawab, jujur, kreatif, dan mandiri.</li>
                                    </td>
                                    <td>
                                        <div class="card" style="width: 8rem;">
                                            <img src="<?= base_url() ?>/img/struktur organisasi.jpg" class="card-img-top" alt="..." div>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>
                                    </td>
                                </tr>
                                <tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.container-fluid -->
            </div><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Contact</strong> 0822-5004-4551 | tk.kompi623@gmail.com
        </footer>

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
</body>

</html>