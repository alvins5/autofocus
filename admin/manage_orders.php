<?php
require '../config/db.php';

$orders = $conn->query("SELECT o.id, u.username, o.total, o.status, o.created_at FROM orders o JOIN users u ON o.user_id = u.id");
?>

<h2>Manajemen Pesanan</h2>
<table>
    <tr><th>ID</th><th>User</th><th>Total</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
    <?php while ($row = $orders->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <form action="ubah_status.php" method="POST">
                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                    <select name="status">
                        <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="completed" <?= $row['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="canceled" <?= $row['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                    </select>
                    <button type="submit">Ubah</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
