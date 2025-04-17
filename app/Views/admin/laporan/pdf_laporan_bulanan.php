<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan Bulanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            padding: 20px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 8px;
            vertical-align: middle;
        }

        thead th {
            background-color: #f8f9fa;
            text-align: center;
        }

        tfoot th {
            background-color: #e9ecef;
        }

        .text-start {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    <h3>Laporan Penjualan Bulanan</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Bulan Order</th>
                <th>Nama Produk</th>
                <th>Jumlah Terjual</th>
                <th>Harga Satuan</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $totalKeseluruhan = 0;
            $totalJumlahTerjual = 0;
            ?>
            <?php foreach ($laporan as $order): ?>
                <?php
                $date = new DateTime($order['created_at'], new DateTimeZone('UTC'));
                $date->setTimezone(new DateTimeZone('Asia/Makassar'));
                $tanggalOrder = $date->format('F Y');
                ?>
                <?php foreach ($order['items'] as $item): ?>
                    <?php
                    $totalKeseluruhan += $item['total_harga'];
                    $totalJumlahTerjual += $item['jumlah'];
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= $tanggalOrder; ?></td>
                        <td class="text-start"><?= esc($item['nama_produk']); ?></td>
                        <td class="text-center"><?= esc($item['jumlah']); ?> buah</td>
                        <td class="text-end">Rp <?= number_format($item['total_harga'] / $item['jumlah'], 0, ',', '.'); ?></td>
                        <td class="text-end">Rp <?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-start">Total Penjualan</th>
                <th class="text-center"><?= $totalJumlahTerjual; ?> buah</th>
                <th></th>
                <th class="text-end">Rp <?= number_format($totalKeseluruhan, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
    </table>
</body>

</html>