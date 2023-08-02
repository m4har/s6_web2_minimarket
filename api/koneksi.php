<?php
$host = 'www.db4free.net';
$user = 'kel7xk';
$pass = 'ZREkX*g*V8P_M73';
$dbname = 'minimarket';

// Buat koneksi
$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>