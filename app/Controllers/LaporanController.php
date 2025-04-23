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
        // Ambil data order item yang ada
        $orders = $this->orderModel
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
            'judul' => 'Laporan',
            'laporan' => $orders,
        ];

        return view('admin/laporan/laporan_harian', $data);
    }

    // Fungsi download laporan harian
    public function download_laporan_harian()
    {
        $orders = $this->orderModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        foreach ($orders as &$order) {
            $order['items'] = $this->orderItemModel
                ->select('order_item.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = order_item.id_produk')
                ->where('order_item.id_order', $order['id_order'])
                ->findAll();
        }

        $laporan = $this->laporanModel->where('kategori', 'perhari')->findAll();

        $data = [
            'judul' => 'Laporan',
            'laporan' => $orders,
        ];

        // Logika untuk menghitung total
        $total = 0;

        foreach ($orders as $order) {
            $total += $order['total_harga'];
        }

        // Render HTML dari view
        $view_laporan = view('admin/laporan/pdf_laporan_harian', $data);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view_laporan);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Ambil output PDF-nya
        $output = $dompdf->output();

        // Tentukan path penyimpanan (misalnya: public/laporan/laporan_harian.pdf)
        $path = WRITEPATH . '../public/laporan/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true); // buat folder jika belum ada
        }

        $filename = 'laporan_harian_' . date('Ymd_His') . '.pdf';
        file_put_contents($path . $filename, $output);



        $found = false;
        $currentDate = date('Y-m-d'); // ambil tanggal hari ini
        $currentTime = date('Y-m-d H:i:s');

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


        // Stream ke user (download)
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($output);
    }

    // Fungsi kirim laporan harian
    public function kirim_laporan_harian()
    {
        // Ambil tanggal hari ini tanpa waktu
        $currentDate = date('Y-m-d');

        $orders = $this->orderModel
            ->where('DATE(created_at)', $currentDate)
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

        $token = 'Abi67U9qby5SpVoEYU9H'; // token kunci fonnte
        $no_wa = '6282256893105'; // tanpa tanda +, awali dengan 62
        $tanggal = date('d F Y');

        // Mulai pesan
        $pesan = "📊 *Laporan Penjualan " . $tanggal . "*\n\n";

        // Inisialisasi variabel
        $totalPendapatan = 0;
        $totalOrder = 0;

        foreach ($orders as $order) {
            $totalOrder++;
            foreach ($order['items'] as $item) {
                $pesan .= "- *" . $item['nama_produk'] . "*: Rp " . number_format($item['total_harga'], 0, ',', '.') . "\n";
                $totalPendapatan += $item['total_harga'];
            }
        }

        $pesan .= "\nTotal Order: " . $totalOrder . "\n";
        $pesan .= "Total Pendapatan: Rp " . number_format($totalPendapatan, 0, ',', '.') . "\n";
        $pesan .= "\n\nTerima kasih atas kerja keras tim 🙌";

        // Kirim ke API Fonnte
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
            // cURL error
            return redirect()->to(base_url('admin/laporan/laporan_harian'))
                ->with('error', 'Laporan gagal dikirim. Error: ' . $err);
        } else {
            // Decode response dari Fonnte
            $result = json_decode($response, true);

            // Cek status Fonnte
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


    // Menampilkan halaman laporan bulanan
    public function laporan_bulanan()
    {
        $orderItems = $this->orderItemModel
            ->select('
            produk.nama_produk, 
            produk.harga, 
            SUM(order_item.jumlah) AS total_jumlah, 
            SUM(order_item.total_harga) AS total_penjualan,
            MAX(order_item.created_at) AS created_at
        ')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->groupBy('order_item.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();

        $totalKeseluruhan = array_sum(array_column($orderItems, 'total_penjualan'));

        $data = [
            'judul' => 'Laporan Penjualan Bulanan',
            'laporan' => $orderItems,
            'totalKeseluruhan' => $totalKeseluruhan,
        ];

        return view('admin/laporan/laporan_bulanan', $data);
    }

    // Fungsi download laporan bulanan
    public function download_laporan_bulanan()
    {
        $orderItems = $this->orderItemModel
            ->select('
                produk.nama_produk, 
                produk.harga, 
                SUM(order_item.jumlah) AS total_jumlah, 
                SUM(order_item.total_harga) AS total_penjualan,
                MAX(order_item.created_at) AS created_at
            ')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->groupBy('order_item.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();
        $laporan = $this->laporanModel->where('kategori', 'perbulan')->findAll();

        $total = array_sum(array_column($orderItems, 'total_penjualan'));

        $data = [
            'judul' => 'Laporan Penjualan Bulanan',
            'laporan' => $orderItems,
            'totalKeseluruhan' => $total,
        ];

        $view_laporan = view('admin/laporan/pdf_laporan_bulanan', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($view_laporan);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();

        $path = WRITEPATH . '../public/laporan/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $filename = 'laporan_bulanan_' . date('Ymd_His') . '.pdf';
        file_put_contents($path . $filename, $output);

        $found = false;
        $currentMonth = date('m');
        $currentYear  = date('Y');

        foreach ($laporan as $data) {
            if ($data['bulan'] == $currentMonth && $data['tahun'] == $currentYear) {
                // Jika ditemukan data laporan bulan dan tahun yang sama
                $this->laporanModel->update($data['id_laporan'], [
                    'file_laporan'     => $filename,
                    'bulan'            => $currentMonth,
                    'tahun'            => $currentYear,
                    'kategori'         => 'perbulan',
                    'total_penjualan'  => $total,
                    'updated_at'       => date('Y-m-d H:i:s'),
                ]);
                $found = true;
                break; // berhenti setelah ketemu
            }
        }

        if (!$found) {
            // Jika tidak ada data yang cocok, lakukan insert
            $this->laporanModel->insert([
                'file_laporan'     => $filename,
                'bulan'            => $currentMonth,
                'tahun'            => $currentYear,
                'kategori'         => 'perbulan',
                'total_penjualan'  => $total,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);
        }



        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($output);
    }
    public function kirim_laporan_bulanan()
    {
        // Ambil bulan dan tahun saat ini
        $currentMonth = date('m');
        $currentYear = date('Y');
        $bulanTahun = date('F Y'); // Contoh: April 2025

        $orderItemModel = new \App\Models\OrderItemModel();

        // Ambil data order item yang terhubung dengan order pada bulan ini
        $items = $orderItemModel
            ->select('order_item.id_produk, produk.nama_produk, produk.harga, SUM(order_item.jumlah) as total_jumlah, SUM(order_item.total_harga) as total_pendapatan')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->join('order', 'order.id_order = order_item.id_order')
            ->where("MONTH(order.created_at)", $currentMonth)
            ->where("YEAR(order.created_at)", $currentYear)
            ->groupBy('order_item.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();


        $token = 'Abi67U9qby5SpVoEYU9H'; // Token Fonnte
        $no_wa = '6282256893105'; // Nomor WhatsApp tujuan

        $pesan = "📦 *Laporan Penjualan Bulanan - $bulanTahun*\n\n";

        $totalPendapatan = 0;
        $totalItem = 0;

        foreach ($items as $item) {
            $pesan .= "- *" . $item['nama_produk'] . "*: " . $item['total_jumlah'] . " item | Rp " . number_format($item['total_pendapatan'], 0, ',', '.') . "\n";
            $totalPendapatan += $item['total_pendapatan'];
            $totalItem += $item['total_jumlah'];
        }

        $pesan .= "\nTotal Item Terjual: " . $totalItem . "\n";
        $pesan .= "Total Pendapatan: Rp " . number_format($totalPendapatan, 0, ',', '.') . "\n";
        $pesan .= "\nTerima kasih atas kerja keras tim! 💪";

        // Kirim ke API Fonnte
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
                    ->with('success', 'Laporan bulanan berhasil dikirim.');
            } else {
                $message = $result['message'] ?? '';
                return redirect()->to(base_url('admin/laporan/laporan_bulanan'))
                    ->with('error', 'Laporan gagal dikirim. ' . $message);
            }
        }
    }
}
