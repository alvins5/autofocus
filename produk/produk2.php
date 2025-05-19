<?php
// Menghubungkan ke file koneksi database
require __DIR__ . '/../config/koneksi.php';


// Memulai session (meskipun tidak digunakan langsung di file ini, baik untuk jaga-jaga)
session_start();

// Menyisipkan header khusus pengguna yang sudah login
if (isset($_SESSION['user_id'])) {
    include __DIR__ . '/../header/header-fixed-logined.php';
} else {
    include __DIR__ . '/../header/header-fixed.php';
}

// Mengambil data brand dan kategori dari database
$brandResult = $conn->query("SELECT id, name FROM brands");
$categoryResult = $conn->query("SELECT id, name FROM categories");
?>
<div class='flex-col px-[13rem]'>

  <!-- Tempat menampilkan hasil pencarian dan jumlah -->
  <div id="searchInfo" class="mb-2 text-lg font-semibold text-white"></div>

<!-- Layout utama: flex untuk 2 kolom -->
  <div class='flex w-[100%] gap-24 font-[poppins]'>
  
  <!-- Panel kiri untuk filter -->
  <div class="flex flex-col w-[25%] bg-green-50 text-black rounded-lg h-full pl-5 py-5">

    <!-- Input keyword pencarian -->
    <div class='flex flex-col'>
      <h2 class="text-xl font-bold">Keyword</h2>
      <input type="text" id="searchInput" placeholder="Search here..." class="text-black max-w-[90%] border-2 border-gray-300 rounded-lg p-3 mb-2">
    </div>

    <!-- Filter brand -->
    <div class='flex flex-col gap-4 my-4'>
      <div>
        <h3 class="text-xl font-bold">Filter Brand</h3>
      </div>
      <?php while ($row = $brandResult->fetch_assoc()): ?>
        <label class="w-full relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-black after:transition-all after:duration-300 hover:after:w-full">
          <input type="checkbox" class="filter-brand text-black relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-black after:transition-all after:duration-300 hover:after:w-full" value="<?= $row['id'] ?>">
          <?= htmlspecialchars($row['name']) ?>
        </label>
      <?php endwhile; ?>
    </div>

    <!-- Filter kategori -->
    <div class='flex flex-col gap-4'>
      <div>
        <h3 class="text-xl font-bold">Filter Kategori</h3>
      </div>
      <?php while ($row = $categoryResult->fetch_assoc()): ?>
        <label>
          <input type="checkbox" class="filter-category" value="<?= $row['id'] ?>"> <?= htmlspecialchars($row['name']) ?>
        </label>
      <?php endwhile; ?>
    </div>

    <!-- Filter Harga -->
    <div class='flex flex-col gap-4 mt-4'>
      <h3 class="text-xl font-bold">Filter Harga</h3>
      <label><input type="checkbox" class="filter-price" value="1"> Semua Harga</label>
      <label><input type="checkbox" class="filter-price" value="2"> 20k - 100k</label>
      <label><input type="checkbox" class="filter-price" value="3"> 100k - 200k</label>
      <label><input type="checkbox" class="filter-price" value="4"> 200k - 400k</label>
      <label><input type="checkbox" class="filter-price" value="5"> > 400k</label>
    </div>
  </div>

  <!-- Panel kanan untuk hasil produk -->
  <div class="flex flex-col w-[75%] gap-2">

    <!-- Daftar produk -->
    <div id="productList" class='flex flex-col bg-green-300 rounded-lg gap-2 p-3 '>Memuat produk...</div>
  </div>
</div>
</div>
<!-- SCRIPT JS -->
<script>
// Ambil semua nilai checkbox berdasarkan class
function getCheckedValues(className) {
  return Array.from(document.querySelectorAll(`.${className}:checked`)).map(cb => cb.value);
}

// Fungsi ambil dan tampilkan produk
function filterProducts() {
  const search = document.getElementById('searchInput').value.trim();
  const brands = getCheckedValues('filter-brand');
  const categories = getCheckedValues('filter-category');
  const prices = getCheckedValues('filter-price');

  const params = new URLSearchParams();
  if (search) params.append('q', search);
  if (brands.length) params.append('brands', brands.join(','));
  if (categories.length) params.append('categories', categories.join(','));
  if (prices.length) params.append('prices', prices.join(',')); // kirim harga sebagai parameter URL

  fetch(`../search.php?${params.toString()}`)
    .then(res => res.json())
    .then(data => renderProducts(data))
    .catch(err => {
      console.error('Error:', err);
      document.getElementById('productList').innerHTML = '<p>Terjadi kesalahan saat mengambil data produk.</p>';
    });
}

// Render data produk ke HTML
function renderProducts(products) {
  const container = document.getElementById('productList');
  const info = document.getElementById('searchInfo');
  container.innerHTML = '';

  // Ambil kata kunci dari input
  const keyword = document.getElementById('searchInput').value.trim();

  // Tampilkan info hasil pencarian dan jumlah
  info.innerHTML = `<p class='py-2'>Result for "${keyword}"</P><br>${products.length} results found`;

  if (!products.length) { 
    container.innerHTML = '<p>Tidak ada produk ditemukan.</p>';
    return;
  }

  products.forEach(p => {
    const div = document.createElement('div');
    div.classList.add('flex', 'flex-col', 'gap-2', 'p-4', 'rounded-lg', 'shadow-md', 'size-auto', 'mx-auto', 'w-[100%]', 'bg-green-50');
    div.innerHTML = `
      <div class="flex text-black gap-4 container mx-auto bg-green-50 w-full justify-between">
        <div class="flex flex-col gap-2 w-[20%]">
          <img src="../uploads/${p.image_url}" alt="image" class="max-w-full w-full h-full rounded-lg">
        </div>
        <div class='flex flex-col gap-6 w-[65%]'>
          <h3 class='font-bold text-lg'>${p.name}</h3>
          <p>Kategori: ${p.category_name ?? '-'}</p>
          <p>Brand: ${p.brand_name ?? '-'}</p>
        </div>
        <form action="../user/add_to_cart.php" method="POST" class="flex flex-col justify-normal items-end w-[15%] gap-4">
          <p class='font-bold text-xl'>Rp${parseInt(p.price).toLocaleString('id-ID')}</p>  
          <input type="hidden" name="product_id" value="${p.id}">
          <button type="submit" class="w-28 h-10 rounded-xl bg-teal-700 text-white hover:bg-green-600 transition duration-300 ease-in-out">
            + to cart
          </button>
        </form>
      </div>
    `;
    container.appendChild(div);
  });
}

// Event listener untuk pencarian & filter
document.getElementById('searchInput').addEventListener('input', () => {
  clearTimeout(window.searchTimeout);
  window.searchTimeout = setTimeout(filterProducts, 300); // debounce 300ms
});
document.querySelectorAll('.filter-brand, .filter-category, .filter-price').forEach(cb => {
  cb.addEventListener('change', filterProducts);
});

// Panggil filter awal saat halaman dimuat
filterProducts();
</script>
