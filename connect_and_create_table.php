<?php
try {
    // Mengatur detail koneksi database
    $dsn = "mysql:host=localhost;dbname=my_database;charset=utf8mb4";
    $username = "root"; // Ganti dengan username MySQL Anda
    $password = ""; // Ganti dengan password MySQL Anda

    // Membuat objek PDO untuk koneksi ke database
    $pdo = new PDO($dsn, $username, $password);

    // Mengatur mode error PDO ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Perintah SQL untuk membuat tabel products
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price FLOAT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    // Eksekusi perintah SQL
    $pdo->exec($sql);

    echo "Tabel 'products' berhasil dibuat!";
} catch (PDOException $e) {
    // Menangani kesalahan koneksi atau eksekusi SQL
    echo "Error: " . $e->getMessage();
}
?>
