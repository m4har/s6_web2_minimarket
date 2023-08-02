<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Stok Barang</title>
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
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
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
            <h1>Kelola Stok Barang</h1>
        </div>

        <!-- Tabel Data Stok Barang -->
        <?php include "data_barang.php"; ?>

        <!-- Form Tambah Produk -->
        <?php include "tambah_barang.php"; ?>
    </div>
</body>
</html>