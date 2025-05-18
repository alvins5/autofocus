<?php
session_start();
require '../config/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT c.*, p.name, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
?>

<h2>Checkout</h2>
<form action="proses_checkout.php" method="POST">
<?php foreach ($items as $item) : ?>
    <div>
        <h4><?= $item['name'] ?></h4>
        <p>Qty: <?= $item['quantity'] ?> - Rp<?= number_format($item['price'], 0, ',', '.') ?></p>
        <?php $total += $item['price'] * $item['quantity']; ?>
    </div>
<?php endforeach; ?>
<p>Total: <strong>Rp<?= number_format($total, 0, ',', '.') ?></strong></p>
<p>Metode Pembayaran: COD</p>
<button type="submit">Konfirmasi Pesanan</button>
</form>
