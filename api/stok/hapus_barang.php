<?php
// Memasukkan file koneksi
include "../koneksi.php";

// Mendapatkan ID produk dari parameter URL
if (isset($_GET["id"])) {
    $id_produk = $_GET["id"];

    // Query untuk mengambil data produk berdasarkan ID dari tabel produk
    $sql_produk = "SELECT * FROM produk WHERE id = $id_produk";
    $result_produk = $conn->query($sql_produk);

    // Inisialisasi variabel untuk data produk
    $produk = array();

    // Mendapatkan data hasil query jika query berhasil dijalankan
    if ($result_produk->num_rows > 0) {
        $produk = $result_produk->fetch_assoc();
    } else {
        // Redirect ke halaman utama jika ID produk tidak ditemukan
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect ke halaman utama jika tidak ada parameter ID
    header("Location: index.php");
    exit();
}

// Proses hapus data produk
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Query untuk menghapus data produk berdasarkan ID pada tabel produk
    $sql_hapus_produk = "DELETE FROM produk WHERE id = $id_produk";
    $result_hapus_produk = $conn->query($sql_hapus_produk);

    // Refresh halaman ke halaman utama setelah berhasil hapus produk
    if ($result_hapus_produk) {
        header("Location: index.php");
        exit();
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
    <title>Hapus Produk</title>
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
        .form-container p {
            margin: 10px 0;
        }
        .form-container input[type="button"] {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }
        .form-container input[type="button"]:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Hapus Produk</h2>
            <p>Anda akan menghapus produk dengan detail sebagai berikut:</p>
            <p>Nama Produk: <?php echo $produk['nama_produk']; ?></p>
            <p>Kategori: <?php echo $produk['kategori']; ?></p>
            <p>Harga: <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
            <p>Stok: <?php echo $produk['stok']; ?></p>
            <input type="button" value="Hapus" onclick="confirmDelete()">
            <a href="index.php">Batal</a>
            <form id="hapusForm" method="post" style="display: none;">
                <!-- Form ini digunakan untuk menghapus data produk -->
            </form>
            <script>
                function confirmDelete() {
                    // Tampilkan konfirmasi alert sebelum menghapus produk
                    var result = confirm("Apakah Anda yakin ingin menghapus produk '<?php echo $produk['nama_produk']; ?>'?");
                    if (result) {
                        // Jika pengguna menekan tombol OK pada alert, submit form untuk menghapus produk
                        document.getElementById("hapusForm").submit();
                    }
                }
            </script>
        </div>
    </div>
</body>
</html>