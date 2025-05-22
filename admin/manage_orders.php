<?php
require '../config/db.php';

$orders = $conn->query("
    SELECT o.id, u.username, o.total, o.status, o.created_at, 
           oi.pickup_date, oi.rental_length, oi.return_date
    FROM orders o
    JOIN users u ON o.user_id = u.id
    LEFT JOIN order_items oi ON oi.order_id = o.id
    GROUP BY o.id
");
?>
<h2>Manajemen Pesanan</h2>
<table>
    <tr>
        <th>ID</th><th>User</th><th>Total</th><th>Status</th>
        <th>Tanggal</th><th>Tanggal Ambil</th><th>Lama Pinjam</th><th>Tenggat Kembali</th><th>Aksi</th>
    </tr>
    <?php while ($row = $orders->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><?= $row['pickup_date'] ?></td>
            <td><?= $row['rental_length'] ?> hari</td>
            <td><?= $row['return_date'] ?></td>
            <td>
                <form action="ubah_status.php" method="POST">
                    <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                    <select name="status">
                        <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="rented" <?= $row['status'] == 'rented' ? 'selected' : '' ?>>Rented</option>
                        <option value="completed" <?= $row['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="canceled" <?= $row['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                    </select>
                    <button type="submit">Ubah</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>