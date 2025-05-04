<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan Bulanan</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333;
        }

        /* Header Section */
        .header-info {
            text-align: center;
            font-size: 14px;
            color: #34495e;
            margin-bottom: 40px;
        }

        .header-info img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .header-info span {
            font-weight: bold;
            color: #2980b9;
        }

         /* Global Styles */
    body {
        font-family: 'Arial', sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 0;
        background-color: #ffffff;
        color: #333;
    }

    /* Period Styling */
    .periode {
        font-size: 16px;
        font-weight: bold;
        color: black; /* Ensure the 'Periode:' text is black */
        margin-top: 10px;
    }

    /* Ensure the period (month and year) text is black */
    .periode span {
        color: black; /* Set color for the month-year */
    }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
            vertical-align: middle;
        }

        th {
            background-color: #2980b9;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #ecf0f1;
        }

        tfoot {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        /* Column Alignments */
        .text-start {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        /* Footer Styles */
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 50px;
            color: #7f8c8d;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .footer span {
            color: #2980b9;
        }

        /* Responsive Table Design */
        @media only screen and (max-width: 600px) {
            table {
                font-size: 10px;
                padding: 5px;
            }

            th,
            td {
                padding: 8px;
            }

            .header-info {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section with Logo -->
    <div class="header-info">
        <h3>Laporan Penjualan Bulanan</h3>
        <h4 class="mb-4">"Bunda Maya Shop"</h4>
        <!-- Period display in Indonesian -->
        <p class="periode">Periode: <span><?= strftime("%B %Y", strtotime("$tahun-$bulan-01")) ?></span></p>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah Terjual</th>
                <th>Harga Satuan</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $totalKeseluruhan = 0; $totalJumlahTerjual = 0; ?>
            <?php foreach ($laporan as $item): ?>
                <?php
                $totalKeseluruhan += $item['total_penjualan'];
                $totalJumlahTerjual += $item['total_jumlah'];
                ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-start"><?= esc($item['nama_produk']); ?></td>
                    <td class="text-center"><?= esc($item['total_jumlah']); ?> pcs</td>
                    <td class="text-end">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td class="text-end">Rp <?= number_format($item['total_penjualan'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-start">Total Penjualan</th>
                <th class="text-center"><?= $totalJumlahTerjual; ?> pcs</th>
                <th class="text-end">Rp <?= number_format($totalKeseluruhan, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        <p>Terima kasih atas perhatian dan kerjasamanya!</p>
        <p>Laporan ini dihasilkan secara otomatis dari sistem penjualan.</p>
        <span>© 2025 Laporan Penjualan</span>
    </div>
</body>

</html>
