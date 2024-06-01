<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('beranda', 'Beranda::index');
$routes->get('tenaga_pendidik', 'Tenaga_Pendidik::index');

$routes->get('pendaftaran', 'Pendaftaran::index');
$routes->get('form_pendaftaran', 'Pendaftaran::tambah');
$routes->post('simpan_pendaftaran', 'Pendaftaran::simpan');
$routes->get('form_edit_pendaftaran', 'Pendaftaran::edit');
$routes->post('update_pendaftaran', 'Pendaftaran::update');
$routes->get('detail_pendaftaran', 'Pendaftaran::detail');
$routes->get('hapus_pendaftaran', 'Pendaftaran::hapus');

<<<<<<< HEAD
=======

$routes->get('pengumuman', 'Pengumuman::index');
$routes->get('form_pengumuman', 'Pengumuman::tambah');
$routes->post('simpan_pengumuman', 'Pendaftaran::simpan');
$routes->get('form_edit_pengumuman', 'Pengumuman::edit');
$routes->post('update_pengumuman', 'Pengumuman::update');
$routes->get('detail_hasil_pengumuman', 'Pengumuman::detail_hasil');
$routes->get('hapus_pengumuman', 'Pengumuman::hapus');


>>>>>>> ca236054bdec86d143c9e5492679ac01e360d851
$routes->get('pendaftaran_freeuser', 'Pendaftaran_freeuser::index');
$routes->get('form_pendaftaran_freeuser', 'Pendaftaran_freeuser::tambah');
$routes->get('pengumuman_freeuser', 'Pengumuman_freeuser::index');


<<<<<<< HEAD
$routes->get('kegiatans', 'Kegiatan::index');
$routes->get('edit_kegiatan', 'Kegiatan::edit');
$routes->get('tambah_kegiatan', 'Kegiatan::tambah');
$routes->get('hapus_kegiatan', 'Kegiatan::hapus');
=======


$routes->get('kegiatan', 'Kegiatan::index');
$routes->get('form_edit_kegiatan', 'Kegiatan::edit');
$routes->get('form_tambah_kegiatan', 'Kegiatan::tambah');
$routes->get('form_hapus_kegiatan', 'Kegiatan::hapus');
>>>>>>> ca236054bdec86d143c9e5492679ac01e360d851

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

$routes->get('sejarah_admin', 'Profil_admin::lihat_sejarah');
$routes->get('visimisi_admin', 'Profil_admin::lihat_visi');
$routes->get('struktur_admin', 'Profil_admin::lihat_struktur');