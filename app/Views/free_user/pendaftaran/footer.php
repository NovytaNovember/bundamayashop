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
  <style>
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
      margin-right: 20px;
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

    .content {
      text-align: center;
      margin-top: 20px;
    }

    .content img {
      width: 200px;
      height: auto;
    }

    .content .alert {
      text-align: left;
      margin: 20px auto;
      max-width: 600px;
    }

    .footer {
      padding: 20px 0;
      background-color: #28a745; /* Menggunakan warna hijau yang lebih terang */
      color: white;
    }

    .footer p {
      margin: 0;
    }

    
  </style>
</head>

<body>

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
                            <li class="nav-item"><a class="nav-link" href="/kegiatan">Login</a></li>
                            
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

</table>
</div>

</body>

</html>

      </div>
    </div>
  </nav>
</div>
</div>

  <div class="content">
  
    <div class="col">
                <img src="<?= base_url()?>/img/logo TK.png" alt="logo TK.png" class="img-fluid">
            </div>

    <h4>Sebelum Mengklik Daftar, Silahkan Anda Login Terlebih Dahulu!</h4>
    <button type="button" class="btn btn-success" onclick="location.href='login.html'">Daftar</button>

    <div class="alert alert-success mt-4" role="alert">
      <h5>Persyaratan PPDB Online TK Kartika V-38:</h5>
      <ul>
        <li>Pas photo 3x4 sebanyak 4 lembar (latar belakang merah pakaian bebas)</li>
        <li>Foto copy akte kelahiran 2 lembar</li>
        <li>Foto copy kartu keluarga 2 lembar</li>
      </ul>
    </div>
  </div>

  <footer class="footer text-start mt-4">
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
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="/script/script.js"></script>

</body>

</html>
