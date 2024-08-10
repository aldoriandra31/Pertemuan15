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

    $min_price = null;
    $products = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['min_price'])) {
        // Mengambil nilai harga minimum dari input form
        $min_price = filter_var($_POST['min_price'], FILTER_VALIDATE_FLOAT);

        if ($min_price !== false) {
            // Perintah SQL untuk mengambil produk dengan harga di atas nilai minimum
            $sql = "SELECT name, price FROM products WHERE price > :min_price";

            // Mempersiapkan perintah SQL untuk dieksekusi
            $stmt = $pdo->prepare($sql);

            // Mengikat nilai ke parameter SQL
            $stmt->bindParam(':min_price', $min_price, PDO::PARAM_STR);

            // Eksekusi perintah SQL
            $stmt->execute();

            // Mengambil semua data dari hasil query
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Harga minimum tidak valid.";
        }
    }
} catch (PDOException $e) {
    // Menangani kesalahan koneksi atau eksekusi SQL
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Products</title>
</head>
<body>
    <h1>Filter Products by Minimum Price</h1>

    <form method="post" action="">
        <label for="min_price">Minimum Price:</label>
        <input type="number" id="min_price" name="min_price" step="0.01" required>
        <button type="submit">Filter</button>
    </form>

    <?php if (!empty($products)): ?>
        <h2>Products with Price Above <?php echo htmlspecialchars($min_price); ?></h2>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Price</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars(number_format($product['price'], 2)); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <p>No products found with price above <?php echo htmlspecialchars($min_price); ?>.</p>
    <?php endif; ?>
</body>
</html>
