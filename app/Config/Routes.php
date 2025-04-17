<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'DashboardController::index');

$routes->group('admin', function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'DashboardController::index');

    // Rute untuk Produk
    $routes->get('produk', 'ProdukController::index'); // Menampilkan halaman produk untuk admin
    $routes->post('produk/store', 'ProdukController::store'); // Menyimpan produk
    $routes->get('produk/edit/(:num)', 'ProdukController::edit/$1'); // Halaman edit produk
    $routes->post('produk/update', 'ProdukController::update'); // Update produk dengan ID produk sebagai parameter
    $routes->get('produk/delete/(:num)', 'ProdukController::delete/$1'); // Menghapus produk berdasarkan ID produk


    $routes->get('kategori', 'KategoriController::index');
    $routes->post('kategori/store', 'KategoriController::store');
    $routes->post('kategori/update', 'KategoriController::update');
    $routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1');


    // Penjualan Routes
    $routes->get('penjualan', 'PenjualanController::index'); // Menampilkan daftar penjualan
    $routes->get('penjualan/tambah', 'PenjualanController::tambah'); // Halaman tambah penjualan
    $routes->post('penjualan/konfirmasi', 'PenjualanController::konfirmasi'); // Konfirmasi sebelum simpan
    $routes->post('penjualan/store', 'PenjualanController::store'); // Simpan penjualan
    $routes->get('penjualan/edit/(:num)', 'PenjualanController::edit/$1'); // Edit penjualan
    $routes->post('penjualan/update', 'PenjualanController::update'); // Update penjualan
    $routes->get('penjualan/delete/(:num)', 'PenjualanController::delete/$1'); // Hapus penjualan


    // Order Routes
    $routes->get('order', 'OrderController::index'); // Menampilkan daftar order
    $routes->get('order/tambah', 'OrderController::tambah'); // Halaman tambah order
    $routes->post('order/konfirmasi', 'OrderController::konfirmasi'); // Konfirmasi sebelum simpan
    $routes->post('order/simpan', 'OrderController::simpan');
    $routes->post('order/store', 'OrderController::store'); // Simpan order
    $routes->get('order/edit/(:num)', 'OrderController::edit/$1'); // Edit order
    $routes->post('order/update', 'OrderController::update'); // Update order
    $routes->get('order/delete/(:num)', 'OrderController::delete/$1'); // Hapus order





    $routes->get('laporan/laporan_harian', 'LaporanController::index');
    $routes->get('laporan/laporan_bulanan', 'LaporanController::laporan_bulanan');
    $routes->get('laporan/kirim_laporan_harian', 'LaporanController::kirim_laporan_harian');

    $routes->get('laporan/kirim_laporan_bulanan', 'LaporanController::kirim_laporan_bulanan');


    $routes->get('arsip_laporan/arsip_laporan_perhari', 'ArsipLaporanController::index');
    $routes->get('arsip_laporan/arsip_laporan_perbulan', 'ArsipLaporanController::perbulan');
    $routes->post('arsip_laporan/generateLaporan', 'ArsipLaporanController::generateLaporan');
});
