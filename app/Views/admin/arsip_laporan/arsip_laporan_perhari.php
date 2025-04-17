<?= $this->extend('template/template_admin'); ?>
<?= $this->section('konten'); ?>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <!-- Tabel Laporan Penjualan -->

            <div class="paper mt-4">
                <div class="d-flex justify-content-between mb-3">
                    <!-- Tombol Perhari dan Perbulan -->
                    <div class="btn-group">
                        <a class="btn btn-default" href="<?= base_url('admin/arsip_laporan/arsip_laporan_perhari'); ?>"> Perhari </a>
                        <a class="btn btn-default" href="<?= base_url('admin/arsip_laporan/arsip_laporan_perbulan'); ?>"> Perbulan </a>
                    </div>

                    
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light text-center align-middle">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Total Pendapatan</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $no = 1;
                            foreach ($laporan as $item) : ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $item['created_at'] ?></td>
                                    <td>Rp. <?= $item['total_penjualan_bulanan'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                        <a href="#" class="btn btn-info"><i class="fas fa-info"></i> Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>