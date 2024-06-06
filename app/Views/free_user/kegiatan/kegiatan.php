<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Hapus atau ganti favicon -->
    <title>Kegiatan</title>
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
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="/sejarah">Sejarah Sekolah</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/visimisi">Visi Misi & Tujuan</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/struktur">Struktur Organisasi</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="/tendik">Tenaga Pendidik</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pendaftaran">Pendaftaran</a></li>
                            <li class="nav-item"><a class="nav-link" href="/pengumuman">Pengumuman</a></li>
                            <li class="nav-item"><a class="nav-link" href="/kegiatan_freeuser">Kegiatan</a></li>
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
        <div class="filters-content">
				<div class="row portfolio-grid justify-content-center">
					<div class="col-lg-4 col-md-6 all latest">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p1.jpg" alt="">
								<div class="overlay"></div>
								<a href="/public//template/satner-master/img/p1.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4><a href="portfolio-details.html">minimal design</a></h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 all popular">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p2.jpg" alt="">
								<div class="overlay"></div>
								<a href="/template/satner-master/img/portfolio/p2.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4><a href="portfolio-details.html">Paint wall</a></h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 all latest">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p3.jpg" alt="">
								<div class="overlay"></div>
								<a href="/template/satner-master/img/portfolio/p3.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4><a href="portfolio-details.html">female light</a></h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 all popular">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p4.jpg" alt="">
								<div class="overlay"></div>
								<a href="/template/satner-master/img/portfolio/p4.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4><a href="portfolio-details.html">fourth air</a></h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 all following">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p6.jpg" alt="">
								<div class="overlay"></div>
								<a href="/template/satner-master/img/portfolio/p5.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4><a href="portfolio-details.html">together sign</a></h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 all upcoming">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p5.jpg" alt="">
								<div class="overlay"></div>
								<a href="/template/satner-master/img/portfolio/p6.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4><a href="portfolio-details.html">multiply fowl</a></h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 all upcoming following">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p7.jpg" alt="">
								<div class="overlay"></div>
								<a href="/template/satner-master/img/portfolio/p7.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4><a href="portfolio-details.html">green heaven</a></h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 all following">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p8.jpg" alt="">
								<div class="overlay"></div>
								<a href="/template/satner-master/img/portfolio/p8.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4>fly male</h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 all upcoming">
						<div class="portfolio_box">
							<div class="single_portfolio">
								<img class="img-fluid w-100" src="/template/satner-master/img/portfolio/p9.jpg" alt="">
								<div class="overlay"></div>
								<a href="/template/satner-master/img/portfolio/p9.jpg" class="img-gal">
									<div class="icon">
										<span class="lnr lnr-cross"></span>
									</div>
								</a>
							</div>
							<div class="short_info">
								<h4><a href="portfolio-details.html">season face</a></h4>
								<p>Animated, portfolio</p>
							</div>
						</div>
					</div>
				</div>
			</div>
</body>
</html>