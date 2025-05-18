<?php
session_start();
require '../config/db.php';

try {
    $user_id = $_SESSION['user_id'];

    // Ambil isi keranjang
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cart)) {
        die("Keranjang kosong. Tidak bisa checkout.");
    }

    // Hitung total
    $total = 0;
    foreach ($cart as $item) {
        $stmtPrice = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmtPrice->execute([$item['product_id']]);
        $priceRow = $stmtPrice->fetch(PDO::FETCH_ASSOC);

        if (!$priceRow) {
            throw new Exception("Produk ID {$item['product_id']} tidak ditemukan.");
        }

        $total += $priceRow['price'] * $item['quantity'];
    }

    // Simpan order
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total, status, created_at) VALUES (?, ?, 'pending', NOW())");
    $stmt->execute([$user_id, $total]);
    $order_id = $conn->lastInsertId();

    // Simpan ke order_items
    foreach ($cart as $item) {
        // Ambil harga produk
        $stmtPrice = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmtPrice->execute([$item['product_id']]);
        $priceRow = $stmtPrice->fetch(PDO::FETCH_ASSOC);
    
        if (!$priceRow) {
            throw new Exception("Produk ID {$item['product_id']} tidak ditemukan.");
        }
    
        $price = $priceRow['price'];
    
        $stmtDetail = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmtDetail->execute([$order_id, $item['product_id'], $item['quantity'], $price]);
    }
    
    // Hapus keranjang
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);

    header("Location: checkout_success.php");
    exit;

} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
