<?php
require '../config/db.php';

try {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);

    header("Location: manage_orders.php");
    exit;
} catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
