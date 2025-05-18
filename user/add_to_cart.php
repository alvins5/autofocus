<?php
session_start();
require '../config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) die("Anda harus login.");

// Ambil input
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Ambil harga produk
$stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
$price = $product['price'];
$subtotal = $price * $quantity;

// Cek apakah produk sudah ada di keranjang
$stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);
$existing = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing) {
    // Update quantity dan subtotal
    $new_qty = $existing['quantity'] + $quantity;
    $new_subtotal = $price * $new_qty;

    $stmt = $conn->prepare("UPDATE cart SET quantity = ?, subtotal = ? WHERE id = ?");
    $stmt->execute([$new_qty, $new_subtotal, $existing['id']]);
} else {
    // Insert baru
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $product_id, $quantity, $subtotal]);
}

header("Location: cart.php");
exit;
