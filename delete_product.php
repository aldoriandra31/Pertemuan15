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

    // ID produk yang akan dihapus
    $id = 2; // ID produk yang akan dihapus

    // Perintah SQL untuk menghapus produk
    $sql = "DELETE FROM products WHERE id = :id";

    // Mempersiapkan perintah SQL untuk dieksekusi
    $stmt = $pdo->prepare($sql);

    // Mengikat nilai ke parameter SQL
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Eksekusi perintah SQL
    $stmt->execute();

    // Mengecek apakah baris terpengaruh
    if ($stmt->rowCount() > 0) {
        echo "Produk dengan ID $id berhasil dihapus!";
    } else {
        echo "Tidak ada produk dengan ID $id yang ditemukan.";
    }

} catch (PDOException $e) {
    // Menangani kesalahan koneksi atau eksekusi SQL
    echo "Error: " . $e->getMessage();
}
?>
