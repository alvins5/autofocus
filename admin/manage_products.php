<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
   header('Location: ../auth/login.php');
   exit;
}

// Tambah produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];

    // Upload gambar
    $image = $_FILES['image']['name'];
    $target = '../uploads/' . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, category_id, brand_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $stock, $category_id, $brand_id, $image]);
    echo "<p>Produk berhasil ditambahkan!</p>";
}

// Hapus produk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    echo "<p>Produk berhasil dihapus!</p>";
}

// Ambil semua produk
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Produk</title>
</head>
<style>
    .produk-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 10px; /* opsional, biar agak rounded */
}
</style>
<body>
    <h2>Tambah Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Produk:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="description" required></textarea><br><br>

        <label>Harga:</label><br>
        <input type="number" step="0.01" name="price" required><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stock" required><br><br>

        <label>ID Kategori:</label><br>
        <input type="number" name="category_id" required><br><br>

        <label>ID Brand:</label><br>
        <input type="number" name="brand_id" required><br><br>

        <label>Gambar Produk:</label><br>
        <input type="file" name="image" accept="image/*" required><br><br>

        <button type="submit" name="submit">Simpan Produk</button>
    </form>

    <h2>Daftar Produk</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Gambar</th><th>Aksi</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td>Rp <?= number_format($product['price'], 2, ',', '.') ?></td>
            <td><?= $product['stock'] ?></td>
            <td>
            <?php if ($product['image']): ?>
                <div style="width: 100%; height: 200px; overflow: hidden;">
                    <img src="../uploads/<?= htmlspecialchars($product['image']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <?php else: ?>
                Tidak ada
                <?php endif; ?>
            </td>

            <td><a href="?delete=<?= $product['id'] ?>">Hapus</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
