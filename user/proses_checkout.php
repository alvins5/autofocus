<?php
session_start();
require '../config/db.php';

$message = '';
$success = false;
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];
$rental_length = (int)$_POST['rental_length'];
$pickup_datetime = $pickup_date . ' ' . $pickup_time . ':00'; // format: YYYY-MM-DD HH:MM:SS

try {
    $user_id = $_SESSION['user_id'];

    // Ambil isi keranjang
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cart)) {
        throw new Exception("Keranjang kosong. Tidak bisa checkout.");
    }

    // 1. Hitung total
    $total = 0;
    foreach ($cart as $item) {
        $stmtPrice = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmtPrice->execute([$item['product_id']]);
        $priceRow = $stmtPrice->fetch(PDO::FETCH_ASSOC);

        if (!$priceRow) {
            throw new Exception("Produk ID {$item['product_id']} tidak ditemukan.");
        }

        $total += $priceRow['price'] * $item['quantity'];
    }

    // 2. Simpan order
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total, status, created_at) VALUES (?, ?, 'pending', NOW())");
    $stmt->execute([$user_id, $total]);
    $order_id = $conn->lastInsertId();

    // 3. Simpan ke order_items
    foreach ($cart as $item) {
        $stmtPrice = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmtPrice->execute([$item['product_id']]);
        $priceRow = $stmtPrice->fetch(PDO::FETCH_ASSOC);

        if (!$priceRow) {
            throw new Exception("Produk ID {$item['product_id']} tidak ditemukan.");
        }

        $price = $priceRow['price'];
        $return_date = date('Y-m-d', strtotime($pickup_date . ' + ' . $rental_length . ' days'));

        $stmtDetail = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, pickup_date, rental_length, return_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtDetail->execute([
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $price,
            $pickup_datetime,
            $rental_length,
            $return_date
        ]);

    // Kurangi stok produk
        $stmtUpdateStock = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
        $stmtUpdateStock->execute([$item['quantity'], $item['product_id']]);
    }

    // Hapus keranjang
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);

    $message = "Checkout berhasil! Pesanan Anda telah diproses.";
    $success = true;
} catch (Exception $e) {
    $message = "Checkout gagal: " . $e->getMessage();
    $success = false;
}
include __DIR__ . "/../header/header-fixed-logined.php";
?>
<div class="flex h-auto items-center justify-between flex-col py-auto pt-8 font-[poppins]">
    <div class="flex flex-col items-center bg-[#CEE0D9] h-[45%] w-[75%] rounded-lg p-10">
        <div class="w-[40%] h-[60%] items-center">
        <?= $success ? "<img src='../img/jempol.png' alt='Success'>" : "<img src='../img/bingung.png' alt='Gagal'>" ?>
        </div>
        <?= $success ? "<h1 class='text-[#020803] text-2xl font-bold'>Checkout Success</h1>" : "<h1 class='text-[#020803] text-2xl font-bold'>Checkout Failed</h1>" ?>
        <p class="text-[#020803] font-[poppins]"><?= htmlspecialchars($message) ?></p>
        <a href="../user/dashboard.php" class="w-42 h-10 bg-[#34B766] justify-center pt-2 px-2 rounded-lg mt-8 ">Kembali ke Beranda</a>
    </div>
</div>
<?php
include __DIR__ . '/../footer/footer.php';
?>