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
include __DIR__ . '/../header/header-fixed-logined.php';
?>
<div class="flex flex-col items-center justify-center ">
    <div class="flex-col justify-between mt-20 w-[78%] bg-gray-600 pb-10 p-5 rounded-lg">
        <h2 class="text-center text-2xl font-bold mb-4 h-fit">Riwayat Pesanan</h2>
        <div class=" flex-col gap-4 w-full mx-auto bg-gray-800 p-4 rounded-lg justify-between pb-10">
            <?php if (!$orders): ?>
                <p>Belum ada pesanan.</p>
            <?php else: ?>
                <table class="table-auto text-left w-full border-collapse">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td>Rp <?= number_format($order['total'], 2, ',', '.') ?></td>
                                <td><?= ucfirst($order['status']) ?></td>
                                <td><?= $order['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>