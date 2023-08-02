<?php
// Memasukkan file koneksi
include "../koneksi.php";

// Proses tambah data transaksi penjualan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tanggal = $_POST["tanggal"];
  $nama_pembeli = $_POST["nama_pembeli"];
  $total_pembayaran = $_POST["total_pembayaran"];

  // Query untuk menambah data transaksi ke dalam tabel transaksi
  $sql_tambah_transaksi = "INSERT INTO transaksi (tanggal, nama_pembeli, total_pembayaran) VALUES ('$tanggal', '$nama_pembeli', $total_pembayaran)";
  $result_tambah_transaksi = $conn->query($sql_tambah_transaksi);

  // Mendapatkan ID transaksi terakhir yang di-generate secara otomatis
  $id_transaksi = $conn->insert_id;

  // Proses tambah data detail transaksi penjualan
  if ($id_transaksi && isset($_POST["id_produk"]) && isset($_POST["jumlah_beli"]) && isset($_POST["harga_per_item"])) {
      $id_produk = $_POST["id_produk"];
      $jumlah_beli = $_POST["jumlah_beli"];
      $harga_per_item = $_POST["harga_per_item"];

      // Query untuk menambah data detail transaksi ke dalam tabel detail_transaksi
      $sql_tambah_detail_transaksi = "INSERT INTO detail_transaksi (id_transaksi, id_produk, jumlah_beli, harga_per_item) VALUES ";
      for ($i = 0; $i < count($id_produk); $i++) {
          $sql_tambah_detail_transaksi .= "($id_transaksi, {$id_produk[$i]}, {$jumlah_beli[$i]}, {$harga_per_item[$i]}), ";
      }
      $sql_tambah_detail_transaksi = rtrim($sql_tambah_detail_transaksi, ", ");
      $result_tambah_detail_transaksi = $conn->query($sql_tambah_detail_transaksi);
  }
    // Refresh halaman ke halaman utama setelah berhasil tambah transaksi
    if ($result_tambah_transaksi && $result_tambah_detail_transaksi) {
        header("Location: index.php");
        exit();
    }
}

// Query untuk mengambil data produk dari tabel produk
$sql_produk = "SELECT * FROM produk";
$result_produk = $conn->query($sql_produk);

// Inisialisasi variabel untuk data hasil query
$data_produk = array();

// Mendapatkan data hasil query jika query berhasil dijalankan
if ($result_produk->num_rows > 0) {
    while ($row = $result_produk->fetch_assoc()) {
        $data_produk[] = $row;
    }
}

// Tutup koneksi
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan</title>
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
        .form-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
        }
        .form-container input[type="date"],
        .form-container input[type="text"],
        .form-container input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        .form-container .produk-items {
            margin-bottom: 10px;
        }
        .form-container .produk-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .form-container th,
        .form-container td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .form-container th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Transaksi Penjualan</h2>
            <form method="post" action="index.php">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" required>
                <label for="nama_pembeli">Nama Pembeli:</label>
                <input type="text" name="nama_pembeli" required>
                <div class="produk-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah Beli</th>
                                <th>Harga per Item</th>
                            </tr>
                        </thead>
                        <tbody id="produkTableBody">
                            <tr>
                                <td>
                                    <select name="id_produk[]" required>
                                        <option value="">Pilih Barang</option>
                                        <?php foreach ($data_produk as $produk) : ?>
                                            <option value="<?php echo $produk['id']; ?>"><?php echo $produk['nama_produk']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><input type="number" name="jumlah_beli[]" placeholder="Jumlah Beli" required></td>
                                <td><input type="number" name="harga_per_item[]" placeholder="Harga per Item" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" onclick="tambahBarang()">Tambah Barang</button>
                </div>
                <input type="submit" value="Simpan">
            </form>
        </div>
    </div>

    <script>
        function tambahBarang() {
            const produkTableBody = document.getElementById("produkTableBody");
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>
                    <select name="id_produk[]" required>
                        <option value="">Pilih Barang</option>
                        <?php foreach ($data_produk as $produk) : ?>
                            <option value="<?php echo $produk['id']; ?>"><?php echo $produk['nama_produk']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="number" name="jumlah_beli[]" placeholder="Jumlah Beli" required></td>
                <td><input type="number" name="harga_per_item[]" placeholder="Harga per Item" required></td>
            `;
            produkTableBody.appendChild(newRow);
        }
    </script>
</body>
</html>