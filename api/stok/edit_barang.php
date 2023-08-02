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

// Proses update data produk
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST["nama_produk"];
    $kategori = $_POST["kategori"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    // Query untuk mengupdate data produk berdasarkan ID pada tabel produk
    $sql_update_produk = "UPDATE produk SET nama_produk = '$nama_produk', kategori = '$kategori', harga = $harga, stok = $stok WHERE id = $id_produk";
    $result_update_produk = $conn->query($sql_update_produk);

    // Refresh halaman untuk menampilkan data terbaru setelah berhasil update produk
    if ($result_update_produk) {
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
    <title>Edit Produk</title>
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
            padding: 10px;
            border: 1px solid #ddd;
        }
        .form-container input[type="text"], .form-container input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Edit Produk</h1>
        </div>

        <div class="form-container">
            <form method="post">
                <input type="text" name="nama_produk" placeholder="Nama Produk" value="<?php echo $produk['nama_produk']; ?>" required>
                <input type="text" name="kategori" placeholder="Kategori" value="<?php echo $produk['kategori']; ?>" required>
                <input type="number" name="harga" placeholder="Harga" value="<?php echo $produk['harga']; ?>" required>
                <input type="number" name="stok" placeholder="Stok" value="<?php echo $produk['stok']; ?>" required>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>