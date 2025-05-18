<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data pesanan milik user
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white p-8">
    <h2 class="text-2xl font-bold mb-4">Riwayat Pesanan</h2>

    <?php if (!$orders): ?>
        <p>Belum ada pesanan.</p>
    <?php else: ?>
        <table class="min-w-full bg-gray-800 rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2"><?= $order['id'] ?></td>
                    <td class="px-4 py-2">Rp <?= number_format($order['total'], 2, ',', '.') ?></td>
                    <td class="px-4 py-2"><?= ucfirst($order['status']) ?></td>
                    <td class="px-4 py-2"><?= $order['created_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
