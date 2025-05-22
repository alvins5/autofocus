<?php
// search.php
// File untuk menampilkan produk berdasarkan filter brand, kategori, keyword, dan rentang harga.

// Panggil koneksi database
require 'config/koneksi.php';

// AMBIL DATA FILTER DARI URL (GET):

// brands dan categories dikirim sebagai string "1,3,5", lalu diubah jadi array
$brandIds = isset($_GET['brands']) && $_GET['brands'] !== '' ? explode(',', $_GET['brands']) : [];
$categoryIds = isset($_GET['categories']) && $_GET['categories'] !== '' ? explode(',', $_GET['categories']) : [];
// Keyword pencarian produk berdasarkan nama produk, default kosong
$search = isset($_GET['q']) ? $_GET['q'] : '';
// Filter harga dikirim sebagai string rentang harga yang dipilih, contoh: "20000-100000,100000-200000"
$priceIds = isset($_GET['prices']) && $_GET['prices'] !== '' ? explode(',', $_GET['prices']) : [];

// Siapkan array untuk kondisi WHERE dan array untuk parameter prepared statement
$where = [];
$params = [];
$types = ''; // tipe data untuk bind_param

// Filter brand jika ada
if (!empty($brandIds)) {
    // Buat placeholder tanda tanya sebanyak jumlah brand yang dipilih
    $in = implode(',', array_fill(0, count($brandIds), '?'));
    $where[] = "products.brand_id IN ($in)";
    $params = array_merge($params, $brandIds);
    $types .= str_repeat('i', count($brandIds));
}

// Filter kategori jika ada
if (!empty($categoryIds)) {
    $in = implode(',', array_fill(0, count($categoryIds), '?'));
    $where[] = "products.category_id IN ($in)";
    $params = array_merge($params, $categoryIds);
    $types .= str_repeat('i', count($categoryIds));
}

// Filter keyword jika ada
if (!empty($search)) {
    $where[] = "products.name LIKE ?";
    $params[] = "%$search%";
    $types .= 's';
}

// Filter harga rentang (bisa lebih dari satu rentang, harus digabung dengan OR)
if (!empty($priceIds) && !in_array('1', $priceIds)) { // '1' = Semua Harga, jadi skip filter jika ada '1'
    $priceWhere = [];
    foreach ($priceIds as $pid) {
        switch ($pid) {
            case '2': $priceWhere[] = "(products.price >= 20000 AND products.price <= 100000)"; break;
            case '3': $priceWhere[] = "(products.price > 100000 AND products.price <= 200000)"; break;
            case '4': $priceWhere[] = "(products.price > 200000 AND products.price <= 400000)"; break;
            case '5': $priceWhere[] = "(products.price > 400000)"; break;
        }
    }
    if ($priceWhere) {
        $where[] = '(' . implode(' OR ', $priceWhere) . ')';
    }
}

// SQL dasar mengambil data produk beserta nama kategori dan brand-nya
$whereSql = '';
if (!empty($where)) {
    $whereSql = 'WHERE ' . implode(' AND ', $where);
}

$sql = "SELECT products.id, products.name, products.price, products.image, products.stock, categories.name AS category_name, brands.name AS brand_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id
        LEFT JOIN brands ON products.brand_id = brands.id
        $whereSql
        ORDER BY products.id DESC";

// Siapkan prepared statement
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    // Jika gagal prepare, kirim error JSON dan keluar
    echo json_encode(['error' => 'Gagal menyiapkan query']);
    exit;
}

// Bind parameter jika ada
if (!empty($params)) {
    // bind_param membutuhkan referensi, jadi buat array referensi
    $refs = [];
    $refs[] = &$types;
    for ($i = 0; $i < count($params); $i++) {
        $refs[] = &$params[$i];
    }
    call_user_func_array([$stmt, 'bind_param'], $refs);
}

// Eksekusi query
$stmt->execute();

// Ambil hasil query
$result = $stmt->get_result();

// Siapkan array produk untuk output JSON
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Set header agar browser tahu response ini JSON
header('Content-Type: application/json');
// Kirim data produk dalam format JSON
echo json_encode($products);
