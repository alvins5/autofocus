<?php
require '../config/db.php';

try {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Ambil status lama
    $stmtOld = $conn->prepare("SELECT status FROM orders WHERE id = ?");
    $stmtOld->execute([$order_id]);
    $oldStatus = $stmtOld->fetchColumn();

    // Update status order
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);

    // Jika status berubah ke rented, kurangi stok produk
    if ($status === 'rented' && $oldStatus !== 'rented') {
        $stmtItems = $conn->prepare("SELECT product_id, quantity FROM order_items WHERE order_id = ?");
        $stmtItems->execute([$order_id]);
        while ($item = $stmtItems->fetch(PDO::FETCH_ASSOC)) {
            $stmtUpdate = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
            $stmtUpdate->execute([$item['quantity'], $item['product_id']]);
        }
    }

    // Jika status berubah ke completed/canceled dari rented, tambahkan stok produk DULU
    if (($status === 'completed' || $status === 'canceled') && $oldStatus === 'rented') {
        $stmtItems = $conn->prepare("SELECT product_id, quantity FROM order_items WHERE order_id = ?");
        $stmtItems->execute([$order_id]);
        while ($item = $stmtItems->fetch(PDO::FETCH_ASSOC)) {
            $stmtUpdate = $conn->prepare("UPDATE products SET stock = stock + ? WHERE id = ?");
            $stmtUpdate->execute([$item['quantity'], $item['product_id']]);
        }
    }

    // Setelah stok dikembalikan, baru hapus order_items
    if ($status === 'completed' || $status === 'canceled') {
        $stmtDel = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
        $stmtDel->execute([$order_id]);
    }

    header("Location: manage_orders.php");
    exit;
} catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>