<?php
// Memasukkan file koneksi
include "../koneksi.php";

// Query untuk mengambil data total penjualan dari tabel transaksi
$sql_total_penjualan = "SELECT SUM(total_pembayaran) AS total_penjualan FROM transaksi";
$result_total_penjualan = $conn->query($sql_total_penjualan);

// Query untuk mengambil data total stok barang dari tabel produk
$sql_total_stok = "SELECT SUM(stok) AS total_stok FROM produk";
$result_total_stok = $conn->query($sql_total_stok);

// Query untuk mengambil data total pendapatan bulan ini dari tabel transaksi
$bulan_ini = date("Y-m");
$sql_pendapatan_bulan_ini = "SELECT SUM(total_pembayaran) AS pendapatan_bulan_ini FROM transaksi WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$bulan_ini'";
$result_pendapatan_bulan_ini = $conn->query($sql_pendapatan_bulan_ini);

// Inisialisasi variabel untuk data hasil query
$jumlah_penjualan = 0;
$total_stok_barang = 0;
$pendapatan_bulan_ini = 0;

// Mendapatkan data hasil query jika query berhasil dijalankan
if ($result_total_penjualan->num_rows > 0) {
    $row = $result_total_penjualan->fetch_assoc();
    $jumlah_penjualan = $row["total_penjualan"];
}

if ($result_total_stok->num_rows > 0) {
    $row = $result_total_stok->fetch_assoc();
    $total_stok_barang = $row["total_stok"];
}

if ($result_pendapatan_bulan_ini->num_rows > 0) {
    $row = $result_pendapatan_bulan_ini->fetch_assoc();
    $pendapatan_bulan_ini = $row["pendapatan_bulan_ini"];
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Minimarket</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan Anda */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            padding: 10px;
            background-color: #f2f2f2;
        }
        .chart {
            text-align: center;
            margin: 20px 0;
        }
        .data-summary {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard Minimarket</h1>
        </div>
        <div class="chart">
            <!-- Di sini, Anda bisa menyisipkan kode untuk grafik atau data visual lainnya -->
            <img src="path_to_chart_image.png" alt="Grafik Penjualan">
        </div>
        <div class="data-summary">
            <div>
                <h2>Total Penjualan</h2>
                <p>Rp <?php echo number_format($jumlah_penjualan, 0, ',', '.'); ?></p>
            </div>
            <div>
                <h2>Total Stok Barang</h2>
                <p><?php echo $total_stok_barang; ?> barang</p>
            </div>
            <div>
                <h2>Pendapatan Bulan Ini</h2>
                <p>Rp <?php echo number_format($pendapatan_bulan_ini, 0, ',', '.'); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
