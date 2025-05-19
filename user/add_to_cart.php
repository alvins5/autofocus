<?php
// Menampilkan semua error untuk debugging (jangan dipakai di production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mulai session untuk mendapatkan user_id
session_start();

// Panggil koneksi database
require '../config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("Anda harus login.");
}

if (!isset($_POST['product_id'])) {
    die("Data tidak lengkap.");
}

$product_id = (int) $_POST['product_id'];
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

if ($product_id <= 0 || $quantity <= 0) {
    die("Input tidak valid.");
}

// Ambil data produk dari database berdasarkan ID
$stmt = $conn->prepare("SELECT price, stock FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika produk tidak ditemukan di database
if (!$product) {
    die("Produk tidak ditemukan.");
}

// Cek apakah jumlah yang diminta melebihi stok
if ($quantity > $product['stock']) {
    die("Jumlah melebihi stok yang tersedia.");
}

// Hitung subtotal berdasarkan harga dan jumlah yang diminta
$price = $product['price'];
$subtotal = $price * $quantity;

// Cek apakah produk sudah ada di keranjang user
$stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);
$existing = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing) {
    // Jika sudah ada di keranjang, update quantity-nya

    // Jumlah baru = jumlah lama + jumlah yang diminta
    $new_qty = $existing['quantity'] + $quantity;

    // Jika jumlah baru melebihi stok, tolak
    if ($new_qty > $product['stock']) {
        die("Jumlah total melebihi stok yang tersedia.");
    }

    // Hitung subtotal baru dan update cart
    $new_subtotal = $price * $new_qty;
    $stmt = $conn->prepare("UPDATE cart SET quantity = ?, subtotal = ? WHERE id = ?");
    $stmt->execute([$new_qty, $new_subtotal, $existing['id']]);
} else {
    // Jika belum ada di keranjang, tambahkan item baru
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $product_id, $quantity, $subtotal]);
}

// Setelah selesai, redirect ke halaman keranjang
header("Location: cart.php");
exit;
