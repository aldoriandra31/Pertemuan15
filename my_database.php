<?php
try {
    // Data source name (DSN)
    $dsn = "mysql:host=localhost;dbname=my_database;charset=utf8mb4";

    // Username dan password MySQL
    $username = "root"; // Ganti dengan username MySQL Anda
    $password = ""; // Ganti dengan password MySQL Anda

    // Membuat koneksi PDO
    $pdo = new PDO($dsn, $username, $password);

    // Mengatur mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Koneksi berhasil!";
} catch (PDOException $e) {
    // Menangkap error jika koneksi gagal
    echo "Koneksi gagal: " . $e->getMessage();
}
?>