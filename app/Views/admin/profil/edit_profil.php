<?= $this->extend('template/template_admin'); ?>

<?= $this->section('konten'); ?>

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
                            <a href="edit_profil" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</class=>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
            </div>
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->endSection() ?>