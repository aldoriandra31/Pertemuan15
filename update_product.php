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

    // ID produk yang akan diperbarui dan harga baru
    $id = 1; // ID produk yang akan diperbarui
    $new_price = 17500.00;

    // Perintah SQL untuk memperbarui harga produk
    $sql = "UPDATE products SET price = :price WHERE id = :id";

    // Mempersiapkan perintah SQL untuk dieksekusi
    $stmt = $pdo->prepare($sql);

    // Mengikat nilai ke parameter SQL
    $stmt->bindParam(':price', $new_price);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Eksekusi perintah SQL
    $stmt->execute();

    // Mengecek apakah baris terpengaruh
    if ($stmt->rowCount() > 0) {
        echo "Harga produk dengan ID $id berhasil diperbarui!";
    } else {
        echo "Tidak ada perubahan harga untuk produk dengan ID $id.";
    }

} catch (PDOException $e) {
    // Menangani kesalahan koneksi atau eksekusi SQL
    echo "Error: " . $e->getMessage();
}
?>