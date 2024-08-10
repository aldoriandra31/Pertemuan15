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

    // Data yang akan dimasukkan ke tabel products
    $name = "Laptop";
    $price = 15000.00;

    // Perintah SQL untuk menambahkan data ke tabel products
    $sql = "INSERT INTO products (name, price) VALUES (:name, :price)";

    // Mempersiapkan perintah SQL untuk dieksekusi
    $stmt = $pdo->prepare($sql);

    // Mengikat nilai ke parameter SQL
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);

    // Eksekusi perintah SQL
    $stmt->execute();

    echo "Data berhasil ditambahkan ke tabel 'products'!";
} catch (PDOException $e) {
    // Menangani kesalahan koneksi atau eksekusi SQL
    echo "Error: " . $e->getMessage();
}
?>
