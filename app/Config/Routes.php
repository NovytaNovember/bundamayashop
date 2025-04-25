<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'DashboardController::index');

$routes->group('admin', function ($routes) {

    // // Routes untuk Dashboard
    $routes->get('dashboard', 'DashboardController::index');

    // Routes untuk Produk
    $routes->get('produk', 'ProdukController::index'); // Menampilkan halaman produk untuk admin
    $routes->post('produk/store', 'ProdukController::store'); // Menyimpan produk
    $routes->get('produk/edit/(:num)', 'ProdukController::edit/$1'); // Halaman edit produk
    $routes->post('produk/update', 'ProdukController::update'); // Update produk dengan ID produk sebagai parameter
    $routes->get('produk/delete/(:num)', 'ProdukController::delete/$1'); // Menghapus produk berdasarkan ID produk

    // Routes untuk Kategori
    $routes->get('kategori', 'KategoriController::index');
    $routes->post('kategori/store', 'KategoriController::store');
    $routes->post('kategori/update', 'KategoriController::update');
    $routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1');


    // Routes untuk Order
    $routes->get('produk_terjual', 'ProdukTerjualController::index'); // Menampilkan daftar produk terjual
    $routes->get('produk_terjual/tambah', 'ProdukTerjualController::tambah'); // Halaman tambah produk terjual
    $routes->post('produk_terjual/konfirmasi', 'ProdukTerjualController::konfirmasi'); // Konfirmasi sebelum simpan
    $routes->post('produk_terjual/simpan', 'ProdukTerjualController::simpan');
    $routes->post('produk_terjual/store', 'ProdukTerjualController::store'); // Simpan produk terjual
    $routes->get('produk_terjual/edit/(:num)', 'ProdukTerjualController::edit/$1'); // Halaman edit produk terjual

    $routes->post('produk_terjual/konfirmasi_edit/(:num)', 'ProdukTerjualController::konfirmasi_edit/$1');
    $routes->post('produk_terjual/update/(:num)', 'ProdukTerjualController::update/$1');

    $routes->get('produk_terjual/delete/(:num)', 'ProdukTerjualController::delete/$1'); // Hapus produk terjual

    // Routes untuk Laporan
    $routes->get('laporan/laporan_harian', 'LaporanController::laporan_harian');
    $routes->get('laporan/laporan_bulanan', 'LaporanController::laporan_bulanan');
    $routes->get('laporan/download_laporan_harian', 'LaporanController::download_laporan_harian');
    $routes->get('laporan/download_laporan_bulanan', 'LaporanController::download_laporan_bulanan');
    $routes->post('laporan/kirim_laporan_harian', 'LaporanController::kirim_laporan_harian');
    $routes->post('laporan/kirim_laporan_bulanan', 'LaporanController::kirim_laporan_bulanan');

    // Routes untuk Arsip Laporan
    $routes->get('arsip_laporan/arsip_laporan_perhari', 'ArsipLaporanController::arsipLaporanPerHari');
    $routes->get('arsip_laporan/arsip_laporan_perbulan', 'ArsipLaporanController::arsipLaporanPerBulan');
    $routes->post('arsip_laporan/generateLaporan', 'ArsipLaporanController::generateLaporan');
    $routes->get('arsip_laporan/arsip_laporan_perhari/download/(:num)', 'ArsipLaporanController::downloadLaporanPerHari/$1');
    $routes->get('arsip_laporan/arsip_laporan_perbulan/download/(:num)', 'ArsipLaporanController::downloadLaporanPerBulan/$1');

    // Routes untuk Setting
    $routes->get('setting', 'SettingController::index');
    $routes->post('setting/store', 'SettingController::store');
    $routes->post('setting/update', 'SettingController::update');
    $routes->get('setting/delete/(:num)', 'SettingController::delete/$1');
    
});
