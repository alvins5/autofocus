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
$stmt = $conn->prepare("SELECT c.*, p.name, p.price, p.stock 
                        FROM cart c 
                        JOIN products p ON c.product_id = p.id 
                        WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC); // Ambil semua data sebagai array asosiatif
?>

<!-- Bagian tampilan -->
<div class="container">
  <h2>Keranjang Anda</h2>

  <div class="container w-full max-w-2xl mx-auto bg-black p-4 rounded-lg shadow-md">
    <?php foreach ($items as $item) : ?>
      <?php 
        // Ambil ID produk dan stok maksimum dari array $item
        $productId = $item['product_id']; 
        $maxStock = $item['stock'];
      ?>
      
      <!-- Satu item produk -->
      <div class="flex justify-between items-center border-b py-2">
        <div class="flex flex-col items-start">
          <!-- Nama produk -->
          <h4><?= htmlspecialchars($item['name']) ?></h4>
          
          <!-- Subtotal (harga x jumlah) -->
          <p>Subtotal: Rp<?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>

          <!-- Bagian kontrol jumlah -->
          <div class="flex items-center gap-2">
            <p>Qty:</p>

            <!-- Tombol kurangi jumlah -->
            <button type="button" onclick="changeQty(<?= $productId ?>, -1)" class="bg-gray-200 px-2">-</button>

            <!-- Input jumlah (readonly agar tidak bisa diketik bebas) -->
            <input 
              id="qty-<?= $productId ?>" 
              type="number" 
              min="1" 
              max="<?= $maxStock ?>" 
              value="<?= $item['quantity'] ?>" 
              class="text-black w-12 h-8 text-center" 
              readonly
            >

            <!-- Tombol tambah jumlah -->
            <button type="button" onclick="changeQty(<?= $productId ?>, 1)" class="bg-gray-200 px-2">+</button>

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
  <div class="flex gap-4 mt-4">
    <a href="checkout.php" class="bg-green-600 text-white px-4 py-2 rounded">Checkout</a>
    <a href="../produk/produk2.php" class="bg-blue-600 text-white px-4 py-2 rounded">Lanjut Belanja</a>
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
