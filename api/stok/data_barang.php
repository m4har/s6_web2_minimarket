<?php
// Memasukkan file koneksi
include "../koneksi.php";

// Query untuk mengambil data stok barang dari tabel produk
$sql_stok_barang = "SELECT * FROM produk";
$result_stok_barang = $conn->query($sql_stok_barang);

// Inisialisasi variabel untuk data hasil query
$data_stok_barang = array();

// Mendapatkan data hasil query jika query berhasil dijalankan
if ($result_stok_barang->num_rows > 0) {
    while ($row = $result_stok_barang->fetch_assoc()) {
        $data_stok_barang[] = $row;
    }
}

// Tutup koneksi
$conn->close();
?>

<table class="data-table">
    <thead>
        <tr>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_stok_barang as $produk) : ?>
        <tr>
            <td><?php echo $produk['id']; ?></td>
            <td><?php echo $produk['nama_produk']; ?></td>
            <td><?php echo $produk['kategori']; ?></td>
            <td><?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
            <td><?php echo $produk['stok']; ?></td>
            <td>
                <!-- Tambahkan link edit dan hapus sesuai kebutuhan -->
                <a href="edit_barang.php?id=<?php echo $produk['id']; ?>">Edit</a>
                <a href="hapus_barang.php?id=<?php echo $produk['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
