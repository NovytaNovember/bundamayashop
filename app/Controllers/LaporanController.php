<?php

namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LaporanModel;

class LaporanController extends BaseController
{
    protected $orderItemModel;
    protected $orderModel;
    protected $laporanModel;

    public function __construct()
    {
        $this->orderItemModel = new OrderItemModel();
        $this->orderModel = new OrderModel();
        $this->laporanModel = new LaporanModel();
    }

    // Menampilkan halaman laporan harian
    public function laporan_harian()
    {
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d'); // Mengambil tanggal dari form atau defaultkan ke hari ini

        // Ambil data order item berdasarkan tanggal yang dipilih
        $orders = $this->orderModel
            ->where('DATE(created_at)', $tanggal) // Filter berdasarkan tanggal
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $orderItemModel = new \App\Models\OrderItemModel();

        // Loop order dan ambil item-order-nya
        foreach ($orders as &$order) {
            $order['items'] = $orderItemModel
                ->select('order_item.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = order_item.id_produk')
                ->where('order_item.id_order', $order['id_order'])
                ->findAll();
        }

        $data = [
            'judul' => 'Laporan Penjualan Harian',
            'laporan' => $orders,
            'tanggal' => $tanggal, // Mengirimkan tanggal ke view
        ];

        return view('admin/laporan/laporan_harian', $data);
    }


    // Fungsi download laporan harian
    public function download_laporan_harian()
    {
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        $orders = $this->orderModel
            ->where('DATE(created_at)', $tanggal)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $orderItemModel = new \App\Models\OrderItemModel();
        $total = 0;

        foreach ($orders as &$order) {
            $order['items'] = $orderItemModel
                ->select('order_item.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = order_item.id_produk')
                ->where('order_item.id_order', $order['id_order'])
                ->findAll();

            // Hitung total untuk hari itu
            foreach ($order['items'] as $item) {
                $total += $item['total_harga'];
            }
        }

        $data = [
            'judul' => 'Laporan Penjualan Harian',
            'laporan' => $orders,
            'tanggal' => $tanggal,
            'totalKeseluruhan' => $total,
        ];

        $view_laporan = view('admin/laporan/pdf_laporan_harian', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($view_laporan);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();

        $path = WRITEPATH . '../public/laporan/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $filename = 'laporan_harian_' . date('Ymd_His') . '.pdf';
        file_put_contents($path . $filename, $output);

        // Kode untuk penyimpanan laporan di database
        $laporan = $this->laporanModel->where('kategori', 'perhari')->findAll();
        $found = false;
        $currentDate = date('Y-m-d'); // ambil tanggal hari ini
        $currentTime = $orders[0]['created_at'];

        foreach ($laporan as $data) {
            // Ambil hanya bagian tanggal dari created_at
            $laporanDate = date('Y-m-d', strtotime($data['created_at']));

            if ($laporanDate == $currentDate) {
                // Jika ditemukan laporan yang dibuat hari ini
                $this->laporanModel->update($data['id_laporan'], [
                    'file_laporan'     => $filename,
                    'kategori'         => 'perhari',
                    'total_penjualan'  => $total,
                    'updated_at'       => $currentTime,
                ]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            // Jika belum ada laporan yang dibuat hari ini
            $this->laporanModel->insert([
                'file_laporan'     => $filename,
                'kategori'         => 'perhari',
                'total_penjualan'  => $total,
                'created_at'       => $currentTime,
                'updated_at'       => $currentTime,
            ]);
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($output);
    }

    // Menampilkan halaman laporan bulanan
    public function laporan_bulanan($bulan = null, $tahun = null)
    {
        // Jika bulan dan tahun tidak diset, gunakan nilai default
        if (!$bulan || !$tahun) {
            $bulan = $this->request->getGet('bulan') ?? date('m'); // Ambil dari query parameter jika ada
            $tahun = $this->request->getGet('tahun') ?? date('Y'); // Ambil dari query parameter jika ada
        }

        // Definisikan bulan dan tahun di controller
        $listBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $currentYear = date('Y');
        $listTahun = [
            $currentYear - 1 => $currentYear - 1, // Tahun sebelumnya
            $currentYear => $currentYear, // Tahun sekarang
        ];

        // Ambil data order items berdasarkan bulan dan tahun yang dipilih
        $orderItems = $this->orderItemModel
            ->select('
        produk.nama_produk, 
        produk.harga, 
        SUM(order_item.jumlah) AS total_jumlah, 
        SUM(order_item.total_harga) AS total_penjualan,
        MAX(order_item.created_at) AS created_at
    ')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->where('MONTH(order_item.created_at)', $bulan)  // Filter berdasarkan bulan
            ->where('YEAR(order_item.created_at)', $tahun)  // Filter berdasarkan tahun
            ->groupBy('order_item.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();

        // Hitung total keseluruhan penjualan
        $totalKeseluruhan = array_sum(array_column($orderItems, 'total_penjualan'));

        // Kirim data ke view
        $data = [
            'judul' => 'Laporan Penjualan Bulanan',
            'laporan' => $orderItems,
            'totalKeseluruhan' => $totalKeseluruhan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'listBulan' => $listBulan, // Kirim langsung listBulan
            'listTahun' => $listTahun, // Kirim langsung listTahun
        ];

        return view('admin/laporan/laporan_bulanan', $data);
    }

    public function download_laporan_bulanan($bulan = null, $tahun = null)
    {
        // Use default values for bulan and tahun if not set
        if (!$bulan || !$tahun) {
            $bulan = $this->request->getGet('bulan') ?? date('m');
            $tahun = $this->request->getGet('tahun') ?? date('Y');
        }

        // Define months and years in the controller
        $listBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $currentYear = date('Y');
        $listTahun = [
            $currentYear - 1 => $currentYear - 1, // Last year
            $currentYear => $currentYear, // Current year
        ];

        // Get order items for the selected month and year
        $orderItems = $this->orderItemModel
            ->select('
        produk.nama_produk, 
        produk.harga, 
        SUM(order_item.jumlah) AS total_jumlah, 
        SUM(order_item.total_harga) AS total_penjualan,
        MAX(order_item.created_at) AS created_at
    ')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->where('MONTH(order_item.created_at)', $bulan)  // Filter by month
            ->where('YEAR(order_item.created_at)', $tahun)  // Filter by year
            ->groupBy('order_item.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();

        // Calculate the total sales for the month
        $totalKeseluruhan = array_sum(array_column($orderItems, 'total_penjualan'));

        // Generate HTML for PDF
        $data = [
            'judul' => 'Laporan Penjualan Bulanan',
            'laporan' => $orderItems,
            'totalKeseluruhan' => $totalKeseluruhan,
            'bulan' => $bulan,
            'tahun' => $tahun, 
        ];

        $view_laporan = view('admin/laporan/pdf_laporan_bulanan', $data);

        // Create PDF with Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view_laporan);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();

        // Save the PDF file to the directory
        $path = WRITEPATH . '../public/laporan/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // Create a filename based on the month and year
        $filename = 'laporan_bulanan_' . $listBulan[$bulan] . '_' . $tahun . '.pdf';

        // Check if the file already exists
        if (file_exists($path . $filename)) {
            // If the file already exists, delete and create a new one
            unlink($path . $filename);
        }

        // Save the new PDF file
        file_put_contents($path . $filename, $output);

        // Now, handle the database logic to insert or update the report
        $laporan = $this->laporanModel->where('kategori', 'perbulan')->where('bulan', $bulan)->where('tahun', $tahun)->findAll();
        $found = false;

        // If a report for the selected month and year exists, update it
        foreach ($laporan as $data) {
            if ($data['bulan'] == $bulan && $data['tahun'] == $tahun) {
                $this->laporanModel->update($data['id_laporan'], [
                    'file_laporan'     => $filename,
                    'kategori'         => 'perbulan',
                    'total_penjualan'  => $totalKeseluruhan,
                    'updated_at'       => date('Y-m-d H:i:s'),
                ]);
                $found = true;
                break;
            }
        }

        // If no report found, insert a new record
        if (!$found) {
            $this->laporanModel->insert([
                'file_laporan'     => $filename,
                'bulan'            => $bulan,
                'tahun'            => $tahun,
                'kategori'         => 'perbulan',
                'total_penjualan'  => $totalKeseluruhan,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);
        }

        // Return the PDF response
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($output);
    }


    public function kirim_laporan_harian()
    {
        // Ambil tanggal yang difilter dari form
        $tanggal = $this->request->getPost('tanggal') ?? date('Y-m-d');

        // Ambil data order item berdasarkan tanggal yang dipilih
        $items = $this->orderItemModel
            ->select('order_item.id_produk, produk.nama_produk, produk.harga, SUM(order_item.jumlah) as total_jumlah, SUM(order_item.total_harga) as total_pendapatan')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->join('order', 'order.id_order = order_item.id_order')
            ->where("DATE(order.created_at)", $tanggal) // Filter berdasarkan tanggal yang dipilih
            ->groupBy('order_item.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();

        $token = 'Abi67U9qby5SpVoEYU9H'; // Token Fonnte
        $no_wa = '6282256893105'; // Nomor WhatsApp tujuan

        // Format tanggal ke dalam format yang lebih user-friendly (misal 02 Mei 2025)
        $tanggalFormat = date('d F Y', strtotime($tanggal));
        $pesan = "📊 *Laporan Penjualan Harian - $tanggalFormat*\n\n";

        $totalPendapatan = 0;
        $totalItem = 0;

        foreach ($items as $item) {
            $pesan .= "- *" . $item['nama_produk'] . "*: " . $item['total_jumlah'] . " item | Rp " . number_format($item['total_pendapatan'], 0, ',', '.') . "\n";
            $totalPendapatan += $item['total_pendapatan'];
            $totalItem += $item['total_jumlah'];
        }

        $pesan .= "\nTotal Produk Terjual: " . $totalItem . "\n";
        $pesan .= "Total Pendapatan: Rp " . number_format($totalPendapatan, 0, ',', '.') . "\n";
        $pesan .= "\nTerima kasih atas kerja keras tim! 🙌";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'target' => $no_wa,
                'message' => $pesan,
                'countryCode' => '62'
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            )
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return redirect()->to(base_url('admin/laporan/laporan_harian'))
                ->with('error', 'Laporan gagal dikirim. Error: ' . $err);
        } else {
            $result = json_decode($response, true);
            if (isset($result['status']) && $result['status'] === true) {
                return redirect()->to(base_url('admin/laporan/laporan_harian'))
                    ->with('success', 'Laporan berhasil dikirim.');
            } else {
                $message = $result['message'] ?? '';
                return redirect()->to(base_url('admin/laporan/laporan_harian'))
                    ->with('error', 'Laporan gagal dikirim. ' . $message);
            }
        }
    }


    public function kirim_laporan_bulanan()
    {
        // Ambil bulan dan tahun yang difilter dari form
        $bulan = $this->request->getPost('bulan') ?? date('m');
        $tahun = $this->request->getPost('tahun') ?? date('Y');

        $items = $this->orderItemModel
            ->select('order_item.id_produk, produk.nama_produk, produk.harga, SUM(order_item.jumlah) as total_jumlah, SUM(order_item.total_harga) as total_pendapatan')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->join('order', 'order.id_order = order_item.id_order')
            ->where("MONTH(order.created_at)", $bulan)  // Filter berdasarkan bulan
            ->where("YEAR(order.created_at)", $tahun)  // Filter berdasarkan tahun
            ->groupBy('order_item.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();

        $token = 'Abi67U9qby5SpVoEYU9H'; // Token Fonnte
        $no_wa = '6282256893105'; // Nomor WhatsApp tujuan

        $bulanTahun = date('F Y', strtotime("$tahun-$bulan-01"));
        $pesan = "📦 *Laporan Penjualan Bulanan - $bulanTahun*\n\n";

        $totalPendapatan = 0;
        $totalItem = 0;

        foreach ($items as $item) {
            $pesan .= "- *" . $item['nama_produk'] . "*: " . $item['total_jumlah'] . " item | Rp " . number_format($item['total_pendapatan'], 0, ',', '.') . "\n";
            $totalPendapatan += $item['total_pendapatan'];
            $totalItem += $item['total_jumlah'];
        }

        $pesan .= "\nTotal Produk Terjual: " . $totalItem . "\n";
        $pesan .= "Total Pendapatan: Rp " . number_format($totalPendapatan, 0, ',', '.') . "\n";
        $pesan .= "\nTerima kasih atas kerja keras tim! 💪";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'target' => $no_wa,
                'message' => $pesan,
                'countryCode' => '62'
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            )
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return redirect()->to(base_url('admin/laporan/laporan_bulanan'))
                ->with('error', 'Laporan gagal dikirim. Error: ' . $err);
        } else {
            $result = json_decode($response, true);
            if (isset($result['status']) && $result['status'] === true) {
                return redirect()->to(base_url('admin/laporan/laporan_bulanan'))
                    ->with('success', 'Laporan berhasil dikirim.');
            } else {
                $message = $result['message'] ?? '';
                return redirect()->to(base_url('admin/laporan/laporan_bulanan'))
                    ->with('error', 'Laporan gagal dikirim. ' . $message);
            }
        }
    }
}
