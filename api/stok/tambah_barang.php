<?php
// Proses tambah data produk
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST["nama_produk"];
    $kategori = $_POST["kategori"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    // Query untuk menambah data produk ke dalam tabel produk
    $sql_tambah_produk = "INSERT INTO produk (nama_produk, kategori, harga, stok) VALUES ('$nama_produk', '$kategori', $harga, $stok)";
    $result_tambah_produk = $conn->query($sql_tambah_produk);

    // Refresh halaman untuk menampilkan data terbaru setelah berhasil tambah produk
    if ($result_tambah_produk) {
        header("Location: index.php");
        exit();
    }
}
?>

<div class="form-container">
    <h2>Tambah Produk Baru</h2>
    <form method="post">
        <input type="text" name="nama_produk" placeholder="Nama Produk" required>
        <input type="text" name="kategori" placeholder="Kategori" required>
        <input type="number" name="harga" placeholder="Harga" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <input type="submit" value="Tambah">
    </form>
</div>