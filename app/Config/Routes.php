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
    $routes->get('kategori', 'KategoriController::kategori');
    $routes->post('kategori/store', 'KategoriController::store');
    $routes->post('kategori/update', 'KategoriController::update');
    $routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1');


    // Routes untuk Order
    $routes->get('order', 'OrderController::order'); // Menampilkan daftar order
    $routes->get('order/tambah', 'OrderController::tambah'); // Halaman tambah order
    $routes->post('order/konfirmasi', 'OrderController::konfirmasi'); // Konfirmasi sebelum simpan
    $routes->post('order/simpan', 'OrderController::simpan');
    $routes->post('order/store', 'OrderController::store'); // Simpan order
    $routes->get('order/edit/(:num)', 'OrderController::edit/$1'); // Halaman edit order

    //$routes->post('order/update', 'OrderController::update'); // Update order
    //$routes->post('order/update/(:num)', 'OrderController::update/$1');
    $routes->get('order/konfirmasi_edit/(:num)', 'OrderController::konfirmasi_edit/$1');
    $routes->post('order/update/(:num)', 'OrderController::update/$1');

    $routes->get('order/delete/(:num)', 'OrderController::delete/$1'); // Hapus order

    // Routes untuk Laporan
    $routes->get('laporan/laporan_harian', 'LaporanController::laporan_harian');
    $routes->get('laporan/laporan_bulanan', 'LaporanController::laporan_bulanan');
    $routes->get('laporan/kirim_laporan_harian', 'LaporanController::kirim_laporan_harian');
    $routes->get('laporan/kirim_laporan_bulanan', 'LaporanController::kirim_laporan_bulanan');

    // Routes untuk Arsip Laporan
    $routes->get('arsip_laporan/arsip_laporan_perhari', 'ArsipLaporanController::arsipLaporanPerHari');
    $routes->get('arsip_laporan/arsip_laporan_perbulan', 'ArsipLaporanController::arsipLaporanPerBulan');
    $routes->post('arsip_laporan/generateLaporan', 'ArsipLaporanController::generateLaporan');
});
