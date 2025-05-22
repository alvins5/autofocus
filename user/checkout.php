<?php
session_start();
require __DIR__ . '/../config/db.php';
include __DIR__ . '/../header/header-fixed-logined.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT c.*, p.name, p.price, p.image FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
?>
<form action="proses_checkout.php" method="POST" class="flex flex-raw justify-center gap-4 mt-10 text-gray-950">
    <div class="flex flex-col rounded-lg p-3 w-[60%] bg-[#CEE0D9] gap-2 h-fit">
        <?php foreach ($items as $item) : ?>
            <div class="flex flex-raw justify-start border py-2 bg-gray-50 rounded-lg text-gray-950 w-full">
                <div class="flex items-center flex-col gap-2 w-[20%] h-[100%] max-w-full p-2">
                    <img src="/../uploads/<?= $item['image'] ?>" alt="product image" class="rounded-lg">
                </div>
                <div class="flex flex-col items-start gap-2">
                    <h4><?= $item['name'] ?></h4>
                    <div class="flex-raw">
                    <p>Qty: <?= $item['quantity'] ?> - Rp<?= number_format($item['price'], 0, ',', '.') ?></p>
                    <?php $total += $item['price'] * $item['quantity']; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="flex flex-col w-[20%] h-fit gap-2 rounded-lg">
        <div class="flex flex-col rounded-lg p-4 w-full bg-[#CEE0D9] gap-2 h-fit">
            <p class="text-xl font-bold ">Order Details</p>
            <div class="flex justify-between gap-2 bg-gray-50 p-2 rounded-lg shadow-xl border">
                <div class="flex-raw">
                <p>Total:</p>
                <p>Rp<?= number_format($total, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between bg-[#CEE0D9] rounded-lg p-4 w-full  gap-2 h-fit">
            <h2>Payment Method</h2>
            <div class="flex flex-raw justify-between bg-gray-50 gap-2 p-2 rounded-lg w-full shadow-xl border">
                <p>COD</p>
                <p>Ambil di Tempat</p>
            </div>
            <label for="pickup_date">Tanggal Ambil:</label>
            <input type="date" name="pickup_date" id="pickup_date" required>
            <label for="pickup_time">Jam Ambil:</label>
            <input type="time" name="pickup_time" id="pickup_time" required>
            <label for="rental_length">Lama Pinjam (hari):</label>
            <input type="number" name="rental_length" id="rental_length" min="1" required>
            <button type="submit">Konfirmasi Order</button>
        </div>
        
</form>