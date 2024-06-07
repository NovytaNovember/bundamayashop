<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url()?>/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url()?>/template/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url()?>/template/AdminLTE-3.2.0/docs/assets/css/adminlte.min.css">
    <style>
        .table-container {
            margin: 20px;
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container th, .table-container td {
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

  <!-- Main content -->
  <div class="content-wrapper">
  <div class="content">
      <div class="container-fluid">
          <div class="table-container">
              <a href="form_pendaftaran" class="btn btn-green" onclick="addData()">Tambah</a>
              <div class="search-box">
                  <label for="search">Search: </label>
                  <input type="text" id="search">
              </div>
              <table>
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Calon Peserta Didik</th>
                          <th>Tempat Lahir</th>
                          <th>Tanggal Lahir</th>
                          <th>Jenis Kelamin</th>
                          <th>Agama</th>
                          <th>Detail</th>
                          <th>Aksi</th>
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
                          <td><a href="detail_pendaftaran " class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a></td>
                          <td>
                              <a href="form_edit_pendaftaran" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                              <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                          </td>
                      </tr>
                    
                     
                      <!-- End of additional minimal example rows -->
                  </tbody>
              </table>


          </div>
      </div><!-- /.container-fluid -->
  </div><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- Content End -->


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
                       
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                            <i class="fas fa-user"></i>
                                <p>Profil</p>
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

  <?= $this->endSection(); ?>

