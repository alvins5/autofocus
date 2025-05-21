<?php
// Mulai session untuk mengakses data user yang sedang login
session_start();

// Include koneksi ke database (menggunakan PDO)
require '../config/db.php';

// Header layout yang sudah login (misal navbar, dll)
include __DIR__ . '/../header/header-fixed-logined.php';

// Ambil ID user dari session
$user_id = $_SESSION['user_id'];

// Ambil data keranjang berdasarkan user_id dan join dengan tabel products untuk mendapatkan nama, harga, dan stok
$stmt = $conn->prepare("SELECT c.*, p.name, p.price, p.stock, p.image 
                        FROM cart c 
                        JOIN products p ON c.product_id = p.id 
                        WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC); // Ambil semua data sebagai array asosiatif
?>

<!-- Bagian tampilan -->
<div class="flex w-screen h-screen justify-center gap-2 mt-10">

  <div class="flex flex-col border-2 border-gray-300 rounded-lg p-4 w-[60%] bg-gray-300 gap-2 h-fit">
    <?php foreach ($items as $item) : ?>
      <?php
      // Ambil ID produk dan stok maksimum dari array $item
      $productId = $item['product_id'];
      $maxStock = $item['stock'];
      $image = $item['image'];
      ?>

      <!-- Satu item produk -->
      <div class="flex items-center border py-2 bg-green-50 rounded-lg text-gray-950">
        <!-- Gambar produk -->
        <div class="flex items-center flex-col gap-2 w-[20%] h-[100%] max-w-full p-2 ">
          <img src="/../uploads/<?= htmlspecialchars($image) ?>" alt="Product Image" class="rounded-lg">
        </div>
        <div class="flex flex-col items-start gap-2 top-0 my-auto mt-2">
          <!-- Nama produk -->
          <h4><?= htmlspecialchars($item['name']) ?></h4>

          <h4>brand : </h4>

          <!-- Subtotal (harga x jumlah) -->
          <p class='text-xl font-bold my-4'>IDR <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
          <div class="flex">
            <!-- Bagian kontrol jumlah -->
            <div class="flex rounded-full bg-white">

              <!-- Tombol kurangi jumlah -->
              <button type="button" onclick="changeQty(<?= $productId ?>, -1)" class="flex flex-col rounded-full h-6 w-6 bg-gray-200 mx-1 justify-center text-black mt-1 pt-[2px]">-</button>

              <!-- Input jumlah (readonly agar tidak bisa diketik bebas) -->
              <input
                id="qty-<?= $productId ?>"
                type="number"
                min="1"
                max="<?= $maxStock ?>"
                value="<?= $item['quantity'] ?>"
                class="flex text-black w-8 pl-2 h-8  text-center bg-gray-200"
                readonly>

              <!-- Tombol tambah jumlah -->
              <button type="button" onclick="changeQty(<?= $productId ?>, 1)" class="flex flex-col rounded-full h-6 w-6 bg-gray-200 mx-1 justify-center text-black mt-1 pt-[2px]">+</button>
            </div>

            <!-- Tombol hapus item -->
            <a href="hapus_item.php?id=<?= $item['product_id'] ?>" class="ml-2 text-red-500">
              🗑️
            </a>
          </div>
          <!-- Info stok tersedia -->
          <small class="text-white">Stok : <?= $item['stock'] ?></small>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Tombol navigasi -->

  <?php
    $subtotal = 0;
    $orderDetails = [];
    foreach ($items as $item) {
      $itemSubtotal = $item['price'] * $item['quantity'];
      $subtotal += $itemSubtotal;
      $orderDetails[] = [
        'name' => $item['name'],
        'quantity' => $item['quantity'],
        'subtotal' => $itemSubtotal
      ];
    }
    $totalPayment = $subtotal; 
  ?>

  <div class="border w-[20%] h-fit flex flex-col justify-between p-4 bg-gray-300 rounded-xl">
    <h2>Order Detail</h2>
    <div class="flex flex-col gap-4 my-auto mt-5 pt-5 bg-emerald-50 text-gray-950 p-2 rounded-lg">
      <div class='flex justify-between'>
        <p>Subtotal product</p>
        <p>IDR <?= number_format($subtotal, 0, ',', '.') ?></p>
      </div>
      <?php foreach ($orderDetails as $detail): ?>
        <div class='flex justify-between'>
          <p><?= htmlspecialchars($detail['name']) ?> (<?= $detail['quantity'] ?> pcs)</p>
          <p>IDR <?= number_format($detail['subtotal'], 0, ',', '.') ?></p>
        </div>
      <?php endforeach; ?>
      <div class='flex justify-between mt-[25%]'>
        <p>Total Payments</p>
        <p>IDR <?= number_format($totalPayment, 0, ',', '.') ?></p>
      </div>
    </div>
    <div class="flex gap-4 mt-4">
      <a href="checkout.php" class="bg-green-600 text-white px-4 py-2 rounded">Checkout</a>
    </div>
  </div>
  



<!-- SCRIPT UNTUK MENGATUR JUMLAH PEMBELIAN -->
<script>
  // Fungsi untuk menambah atau mengurangi jumlah sewa
  function changeQty(productId, delta) {
    // Ambil input berdasarkan ID produk
    const input = document.getElementById('qty-' + productId);

    // Ambil batas maksimal stok dan minimal sewa (biasanya 1)
    const max = parseInt(input.max);
    const min = parseInt(input.min);
    let current = parseInt(input.value);

    // Ubah jumlah sesuai delta (+1 atau -1)
    current += delta;

    // Cek batasan nilai
    if (current >= min && current <= max) {
      input.value = current; // Update nilai input
    } else if (current > max) {
      alert("Maksimal stock tersedia hanya " + max); // Tampilkan alert jika melebihi stok
    }
  }
</script>