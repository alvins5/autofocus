<?php
require __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../header/header-fixed-logined.php';

session_start();

// Ambil data brand untuk checkbox filter
$brandResult = $conn->query("SELECT id, name FROM brands");

// Ambil data kategori untuk checkbox filter
$categoryResult = $conn->query("SELECT id, name FROM categories");
?>

<div class='flex w-[100%] justify-items-between gap-24 px-[13rem] font-[poppins] mt-24'>
  <div class="flex flex-col w-[25%] bg-green-50 text-black rounded-lg h-full pl-5 py-5">
    <div class='flex flex-col'>
      <h2 class="text-xl font-bold">Keyword</h2>
      <!-- Input search untuk nama produk -->
      <input type="text" id="searchInput" placeholder="Search here..." class="text-black max-w-[90%] border-2 border-gray-300 rounded-lg p-3 mb-2">
    </div>
    <div class='flex flex-col gap-4 my-4'>
      <div>
        <h3 class="text-xl font-bold">Filter Brand</h3>
        <input type="text" id="searchInputBrand" placeholder="Search brand..." class="text-black max-w-[90%] border-2 border-gray-300 rounded-lg p-3 mb-2">
      </div>
      <?php while ($row = $brandResult->fetch_assoc()): ?>
        <label>
          <!-- Checkbox filter brand -->
          <input type="checkbox" class="filter-brand text-black" value="<?= $row['id'] ?>">
          <?= htmlspecialchars($row['name']) ?>
        </label>
      <?php endwhile; ?>
    </div>
    <div class='flex flex-col gap-4'>
      <div>
        <h3 class="text-xl font-bold">Filter Kategori</h3>
        <input type="text" id="searchInputKategori" placeholder="Search kategori..." class="text-black max-w-[90%] border-2 border-gray-300 rounded-lg p-3 mb-3">
      </div>
      <?php while ($row = $categoryResult->fetch_assoc()): ?>
        <label>
          <!-- Checkbox filter kategori -->
          <input type="checkbox" class="filter-category" value="<?= $row['id'] ?>"> <?= htmlspecialchars($row['name']) ?>
        </label>
      <?php endwhile; ?>
      </div>
  </div>
  <div class="flex flex-col w-[75%] gap-2">
    <h2>Daftar Produk</h2>
    <div id="productList" class='flex flex-col bg-green-300 rounded-lg gap-2 p-2 m-3'>Memuat produk...</div>
  </div>
</div>
<script>
  // Fungsi untuk ambil semua nilai checkbox yang dicentang berdasarkan kelas
  function getCheckedValues(className) {
    return Array.from(document.querySelectorAll(`.${className}:checked`))
      .map(cb => cb.value);
  }

  // Fungsi utama untuk request data produk dari server dan menampilkan hasil
  function filterProducts() {
    // Ambil kata kunci search
    const search = document.getElementById('searchInput').value.trim();

    // Ambil list id brand dan kategori yang dicentang
    const brands = getCheckedValues('filter-brand');
    const categories = getCheckedValues('filter-category');

    // Buat parameter query URL
    const params = new URLSearchParams();
    if (search) params.append('q', search);
    if (brands.length) params.append('brands', brands.join(','));
    if (categories.length) params.append('categories', categories.join(','));

    // Panggil API search.php dengan query parameter
    fetch(`../search.php?${params.toString()}`)
      .then(res => res.json())
      .then(data => renderProducts(data))
      .catch(err => {
        console.error('Error:', err);
        document.getElementById('productList').innerHTML = '<p>Terjadi kesalahan saat mengambil data produk.</p>';
      });
  }

  // Fungsi untuk render data produk ke HTML
  function renderProducts(products) {
    const container = document.getElementById('productList');
    container.innerHTML = ''; // Kosongkan kontainer dulu

    if (!products.length) {
      container.innerHTML = '<p>Tidak ada produk ditemukan.</p>';
      return;
    }
    // Buat tampilan setiap produk
    products.forEach(p => {
      const div = document.createElement('div');
      div.classList.add('flex', 'flex-col', 'gap-2', 'p-4', 'rounded-lg', 'shadow-md', 'size-auto', 'mx-auto', 'w-[100%]', 'bg-green-50');
      div.innerHTML = `
      <div class="flex text-black gap-4 container mx-auto bg-green-50 w-full justify-between ">
        <div class="flex flex-col gap-2 w-[20%]">
          <img src="../uploads/${p.image_url}" alt"image" class="max-w-full w-full h-full rounded-lg ">
        </div>
          <div class='flex flex-col gap-6 w-[65%]'>
            <h3 class='font-bold text-lg'>${p.name}</h3>
            <p>Kategori: ${p.category_name ?? '-'}</p>
            <p>Brand: ${p.brand_name ?? '-'}</p>
          </div>
          <form action="../user/add_to_cart.php" method="POST" class="flex flex-col justify-normal items-end  w-[15%] gap-24">
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

  // Event listener: cari saat mengetik di input search (debounce 300ms)
  document.getElementById('searchInput').addEventListener('input', () => {
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(filterProducts, 300);
  });

  // Event listener: filter ulang saat checkbox brand/kategori berubah
  document.querySelectorAll('.filter-brand, .filter-category').forEach(cb => {
    cb.addEventListener('change', filterProducts);
  });

  // Load data produk pertama kali pas halaman dibuka
  filterProducts();
</script>