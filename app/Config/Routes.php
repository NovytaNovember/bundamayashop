<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('beranda', 'Beranda::index');
$routes->get('tenaga_pendidik', 'Tenaga_Pendidik::index');

// contoh 
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::login');
$routes->get('berhasil', function () {
    echo "<h1>Berhasi;</h1>";
});

$routes->get('pendaftaran', 'Pendaftaran::index');
$routes->get('form_pendaftaran', 'Pendaftaran::tambah');
$routes->post('simpan_pendaftaran', 'Pendaftaran::simpan');
$routes->get('form_edit_pendaftaran', 'Pendaftaran::edit');
$routes->post('update_pendaftaran', 'Pendaftaran::update');
$routes->get('detail_pendaftaran', 'Pendaftaran::detail');
$routes->get('hapus_pendaftaran', 'Pendaftaran::hapus');

$routes->get('pengumuman', 'Pengumuman::index');
$routes->get('form_pengumuman', 'Pengumuman::tambah');
$routes->post('simpan_pengumuman', 'Pendaftaran::simpan');
$routes->get('form_edit_pengumuman', 'Pengumuman::edit');
$routes->post('update_pengumuman', 'Pengumuman::update');
$routes->get('detail_hasil_pengumuman', 'Pengumuman::detail_hasil');
$routes->get('hapus_pengumuman', 'Pengumuman::hapus');

$routes->get('pendaftaran_freeuser', 'Pendaftaran_freeuser::index');
$routes->get('form_pendaftaran_freeuser', 'Pendaftaran_freeuser::tambah');
$routes->get('pengumuman_freeuser', 'Pengumuman_freeuser::index');

$routes->get('kegiatans', 'Kegiatan::index');
$routes->get('edit_kegiatan', 'Kegiatan::edit');
$routes->get('tambah_kegiatan', 'Kegiatan::tambah');
$routes->post('tambah_kegiatan', 'Kegiatan::simpan');
$routes->get('hapus_kegiatan', 'Kegiatan::hapus');

$routes->get('kegiatan_freeuser', 'Kegiatan_freeuser::index');

$routes->get('kegiatan_kepsek', 'Kegiatan_kepala_sekolah::index');
$routes->get('edit_kegiatan_kepsek', 'Kegiatan_kepala_sekolah::edit');
$routes->get('tambah_kegiatan_kepsek', 'Kegiatan_kepala_sekolah::tambah');
$routes->get('hapus_kegiatan_kepsek', 'Kegiatan_kepala_sekolah::hapus');

$routes->get('sejarah', 'Profil_freeuser::index');
$routes->get('visi_misi', 'Profil_freeuser::lihat_visi');
$routes->get('struktur', 'Profil_freeuser::lihat_struktur');

$routes->get('sejarah_kepsek', 'Profil_kepala_sekolah::lihat_sejarah');
$routes->get('visimisi_kepsek', 'Profil_kepala_sekolah::lihat_visi');
$routes->get('struktur_kepsek', 'Profil_kepala_sekolah::lihat_struktur');

$routes->get('profil_admin', 'Profil::edit_profil');
$routes->get('edit_profil', 'Profil::form_edit_profil');