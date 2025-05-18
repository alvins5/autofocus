<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

// Log pembelian
$stmt = $conn->query("
    SELECT orders.id as order_id, users.username, orders.total, orders.status, orders.created_at
    FROM orders
    JOIN users ON orders.user_id = users.id
    ORDER BY orders.created_at DESC
");
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Log Pembelian</h2>

<table border="1">
<tr>
    <th>ID Pesanan</th>
    <th>Pengguna</th>
    <th>Total</th>
    <th>Status</th>
    <th>Tanggal</th>
</tr>

<?php foreach ($logs as $log): ?>
<tr>
    <td><?= $log['order_id'] ?></td>
    <td><?= htmlspecialchars($log['username']) ?></td>
    <td>Rp <?= number_format($log['total'], 2, ',', '.') ?></td>
    <td><?= ucfirst($log['status']) ?></td>
    <td><?= $log['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</table>
