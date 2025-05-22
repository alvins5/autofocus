<?php
session_start();
require '../config/db.php';

// Cek akses admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
   header('Location: ../auth/login.php');
   exit;
}

// Proses tambah produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $image = $_FILES['image']['name'];
    $target = '../uploads/' . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, category_id, brand_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $stock, $category_id, $brand_id, $image]);
}

// Proses edit produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_edit'])) {
    $id = $_POST['product_id'];
    $name = $_POST['edit_name'];
    $description = $_POST['edit_description'];
    $price = $_POST['edit_price'];
    $stock = $_POST['edit_stock'];
    $category_id = $_POST['edit_category_id'];
    $brand_id = $_POST['edit_brand_id'];

    // Jika ada gambar baru diupload
    if ($_FILES['edit_image']['name']) {
        $image = $_FILES['edit_image']['name'];
        $target = '../uploads/' . basename($image);
        move_uploaded_file($_FILES['edit_image']['tmp_name'], $target);
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock=?, category_id=?, brand_id=?, image=? WHERE id=?");
        $stmt->execute([$name, $description, $price, $stock, $category_id, $brand_id, $image, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock=?, category_id=?, brand_id=? WHERE id=?");
        $stmt->execute([$name, $description, $price, $stock, $category_id, $brand_id, $id]);
    }
}

// Hapus produk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

// Ambil semua produk
$products = $conn->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 font-sans">

<h1 class="text-3xl font-bold text-center mb-6">Manage Products</h1>

<!-- Form Tambah Produk -->
<div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto mb-8">
    <h2 class="text-2xl font-semibold mb-4">Tambah Produk Baru</h2>
    <form method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
        <input type="text" name="name" placeholder="Nama Produk" required class="border p-2 rounded col-span-2">
        <textarea name="description" placeholder="Deskripsi" required class="border p-2 rounded col-span-2"></textarea>
        <input type="number" step="0.01" name="price" placeholder="Harga" required class="border p-2 rounded">
        <input type="number" name="stock" placeholder="Stok" required class="border p-2 rounded">
        <input type="number" name="category_id" placeholder="ID Kategori" required class="border p-2 rounded">
        <input type="number" name="brand_id" placeholder="ID Brand" required class="border p-2 rounded">
        <input type="file" name="image" accept="image/*" required class="border p-2 rounded col-span-2">
        <button type="submit" name="submit_add" class="bg-green-600 text-white px-4 py-2 rounded col-span-2 hover:bg-green-700">Simpan Produk</button>
    </form>
</div>

<!-- Daftar Produk -->
<div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Daftar Produk</h2>
    <div class="grid grid-cols-1 gap-4">
        <?php foreach ($products as $product): ?>
        <div class="bg-white p-4 rounded-lg shadow flex gap-4 items-start">
            <div class="w-[150px] h-[150px] flex-shrink-0 overflow-hidden rounded">
                <img src="../uploads/<?= htmlspecialchars($product['image']) ?>" alt="image" class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col w-full">
                <p><strong><?= htmlspecialchars($product['name']) ?></strong></p>
                <p>Harga: Rp<?= number_format($product['price'], 0, ',', '.') ?></p>
                <p>Stok: <?= $product['stock'] ?></p>
                <p>Deskripsi: <?= htmlspecialchars($product['description']) ?></p>

                <!-- Form Edit Produk -->
                <form method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-2 mt-2">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="text" name="edit_name" value="<?= htmlspecialchars($product['name']) ?>" class="border p-1 rounded">
                    <input type="number" name="edit_price" value="<?= $product['price'] ?>" class="border p-1 rounded">
                    <input type="number" name="edit_stock" value="<?= $product['stock'] ?>" class="border p-1 rounded">
                    <textarea name="edit_description" class="border p-1 rounded"><?= htmlspecialchars($product['description']) ?></textarea>
                    <input type="number" name="edit_category_id" value="<?= $product['category_id'] ?>" class="border p-1 rounded">
                    <input type="number" name="edit_brand_id" value="<?= $product['brand_id'] ?>" class="border p-1 rounded">
                    <input type="file" name="edit_image" class="border p-1 rounded col-span-2">
                    <div class="flex gap-2 col-span-2">
                        <button type="submit" name="submit_edit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Simpan Perubahan</button>
                        <a href="?delete=<?= $product['id'] ?>" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</a>
                    </div>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
