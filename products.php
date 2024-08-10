<?php
try {
    // Perintah SQL untuk membuat tabel
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price FLOAT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    // Eksekusi perintah SQL
    $pdo->exec($sql);

    echo "Tabel products berhasil dibuat!";
} catch (PDOException $e) {
    // Menangkap error jika terjadi kesalahan saat membuat tabel
    echo "Gagal membuat tabel: " . $e->getMessage();
}
?>