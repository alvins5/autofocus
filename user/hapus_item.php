<?php
session_start();
require '../config/db.php';

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    die("ID produk tidak valid.");
}

$stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);

header("Location: cart.php");
exit;
