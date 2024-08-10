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

    // Perintah SQL untuk mengambil semua data dari tabel products
    $sql = "SELECT name, price FROM products";

    // Mempersiapkan perintah SQL untuk dieksekusi
    $stmt = $pdo->prepare($sql);

    // Eksekusi perintah SQL
    $stmt->execute();

    // Mengambil semua data dari hasil query
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Menampilkan data dalam bentuk tabel HTML
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Price</th></tr>";

    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($product['name']) . "</td>";
        echo "<td>" . htmlspecialchars(number_format($product['price'], 2)) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    // Menangani kesalahan koneksi atau eksekusi SQL
    echo "Error: " . $e->getMessage();
}
?>
