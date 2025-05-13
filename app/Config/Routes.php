<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute untuk login dan logout
$routes->get('/', 'ValidasiController::login'); // Halaman pertama langsung ke login
$routes->get('/login', 'ValidasiController::login'); // Halaman login
$routes->post('/login', 'ValidasiController::authenticate'); // Proses autentikasi
$routes->get('/logout', 'ValidasiController::logout'); // Halaman logout

// Rute untuk dashboard (admin, petugas, owner)
$routes->get('/admin/dashboard', 'DashboardController::index'); // Dashboard admin
$routes->get('/petugas/dashboard', 'DashboardController::index'); // Dashboard petugas
$routes->get('/owner/dashboard', 'DashboardController::index'); // Dashboard owner


$routes->group('admin', function ($routes) {

    // // Routes untuk Dashboard
    $routes->get('dashboard', 'DashboardController::index'); // Menampilkan dashboard

    // Routes untuk Kategori
    $routes->get('kategori', 'KategoriController::index'); // Menampilkan halaman kategori untuk admin
    $routes->post('kategori/store', 'KategoriController::store'); // Menyimpan kategori
    $routes->post('kategori/update', 'KategoriController::update'); // Update kategori dengan ID kategori sebagai parameter
    $routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1'); // Menghapus kategori berdasrkan ID kategori

    // Routes untuk Produk
    $routes->get('produk', 'ProdukController::index'); // Menampilkan halaman produk untuk admin
    $routes->post('produk/store', 'ProdukController::store'); // Menyimpan produk
    $routes->get('produk/edit/(:num)', 'ProdukController::edit/$1'); // Halaman edit produk
    $routes->post('produk/update', 'ProdukController::update'); // Update produk dengan ID produk sebagai parameter
    $routes->get('produk/delete/(:num)', 'ProdukController::delete/$1'); // Menghapus produk berdasarkan ID produk 

    // Routes untuk Produk Terjual
    $routes->get('produk_terjual', 'ProdukTerjualController::index'); // Menampilkan daftar produk terjual
    $routes->get('produk_terjual/tambah', 'ProdukTerjualController::tambah'); // Halaman tambah produk terjual
    $routes->post('produk_terjual/konfirmasi', 'ProdukTerjualController::konfirmasi'); // Konfirmasi sebelum simpan
    $routes->post('produk_terjual/simpan', 'ProdukTerjualController::simpan'); // Simpan konfirmasi
    $routes->post('produk_terjual/store', 'ProdukTerjualController::store'); // Tambah produk terjual
    $routes->get('produk_terjual/edit/(:num)', 'ProdukTerjualController::edit/$1'); // Halaman edit produk terjual
    $routes->post('produk_terjual/update/(:num)', 'ProdukTerjualController::update/$1'); //Mengedit produk terjual 
    $routes->get('produk_terjual/delete/(:num)', 'ProdukTerjualController::delete/$1'); // Hapus produk terjual

    // Routes untuk Laporan
    $routes->get('laporan/laporan_harian', 'LaporanController::laporan_harian'); // Menampilkan laporan hariam
    $routes->get('laporan/download_laporan_harian', 'LaporanController::download_laporan_harian'); // Routes untuk laporan download dengan filter bulan dan tahun
    $routes->get('laporan/laporan_bulanan', 'LaporanController::laporan_bulanan'); // Menampilkan laporan bulanan
    $routes->get('laporan/laporan_bulanan/(:num)/(:num)', 'LaporanController::laporan_bulanan/$1/$2'); // Menampilkan laporan bulanan
    $routes->get('laporan/download_laporan_bulanan/(:num)/(:num)', 'LaporanController::download_laporan_bulanan/$1/$2');
    $routes->post('laporan/kirim_laporan_harian', 'LaporanController::kirim_laporan_harian'); // Mengirim laporan harian
    $routes->post('laporan/kirim_laporan_bulanan', 'LaporanController::kirim_laporan_bulanan'); // Mengirim laporan bulanan

    // Routes untuk Arsip Laporan
    $routes->get('arsip_laporan/arsip_laporan_perhari', 'ArsipLaporanController::arsipLaporanPerHari'); // Menampilkan arsip laporan perhari
    $routes->get('arsip_laporan/arsip_laporan_perbulan', 'ArsipLaporanController::arsipLaporanPerBulan'); // Menampilkan arsip laporan perbulan
    $routes->post('arsip_laporan/generateLaporan', 'ArsipLaporanController::generateLaporan');
    $routes->get('arsip_laporan/arsip_laporan_perhari/download/(:num)', 'ArsipLaporanController::downloadLaporanPerHari/$1'); // Download arsip laporan perhari
    $routes->get('arsip_laporan/arsip_laporan_perbulan/download/(:num)', 'ArsipLaporanController::downloadLaporanPerBulan/$1'); // Download arsip laporan bulanan

    // Routes untuk Perhitungan
    $routes->get('perhitungan_perhari', 'PerhitunganController::perhitungan_perhari'); // Menampilkan halaman perhitungan untuk admin
    $routes->post('perhitungan_perhari/store', 'PerhitunganController::store_perhari'); // Menyimpan perhitungan
    $routes->post('perhitungan_perhari/update', 'PerhitunganController::update_perhari'); // Update perhitungan dengan ID perhitungan sebagai parameter
    $routes->post('perhitungan_perhari/delete/(:num)', 'PerhitunganController::delete_perhari/$1'); // Menghapus perhitungan berdasarkan ID perhitungan

    $routes->get('perhitungan_perbulan', 'PerhitunganController::perhitungan_perbulan'); // Menampilkan halaman perhitungan untuk admin
    $routes->post('perhitungan_perbulan/store', 'PerhitunganController::store_perbulan'); // Menyimpan perhitungan
    $routes->post('perhitungan_perbulan/update', 'PerhitunganController::update_perbulan'); // Update perhitungan dengan ID perhitungan sebagai parameter
    $routes->post('perhitungan_perbulan/delete/(:num)', 'PerhitunganController::delete_perbulan/$1'); // Menghapus perhitungan berdasarkan ID perhitungan

    // Routes untuk Pengguna
    $routes->get('pengguna', 'PenggunaController::index'); // Display list of users
    $routes->post('pengguna/store', 'PenggunaController::store'); // Store a new user
    $routes->get('pengguna/edit/(:num)', 'PenggunaController::edit/$1'); // Edit a user
    $routes->post('pengguna/update', 'PenggunaController::update'); // Update user
    $routes->get('pengguna/delete/(:num)', 'PenggunaController::delete/$1'); // Delete user

});

$routes->group('petugas', function ($routes) {

    // Routes untuk Produk Terjual
    $routes->get('produk_terjual', 'ProdukTerjualController::index'); // Menampilkan daftar produk terjual
    $routes->get('produk_terjual/tambah', 'ProdukTerjualController::tambah'); // Halaman tambah produk terjual
    $routes->post('produk_terjual/konfirmasi', 'ProdukTerjualController::konfirmasi'); // Konfirmasi sebelum simpan
    $routes->post('produk_terjual/simpan', 'ProdukTerjualController::simpan'); // Simpan konfirmasi
    $routes->post('produk_terjual/store', 'ProdukTerjualController::store'); // Tambah produk terjual
    $routes->get('produk_terjual/edit/(:num)', 'ProdukTerjualController::edit/$1'); // Halaman edit produk terjual
    $routes->post('produk_terjual/update/(:num)', 'ProdukTerjualController::update/$1'); // Mengedit produk terjual 
    $routes->get('produk_terjual/delete/(:num)', 'ProdukTerjualController::delete/$1'); // Hapus produk terjual

});

