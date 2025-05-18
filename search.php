<?php
// Memanggil koneksi database
require 'config/koneksi.php';

// AMBIL DATA FILTER DARI URL (GET):
// brands dan categories dikirim sebagai string "1,3,5", lalu diubah jadi array
$brandIds = isset($_GET['brands']) && $_GET['brands'] !== '' ? explode(',', $_GET['brands']) : [];
$categoryIds = isset($_GET['categories']) && $_GET['categories'] !== '' ? explode(',', $_GET['categories']) : [];

// keyword pencarian produk berdasarkan nama produk, default kosong
$search = isset($_GET['q']) ? $_GET['q'] : '';

// Siapkan array untuk kondisi WHERE query dan variabel untuk parameter prepared statement
$where = [];
$params = [];
$types = ''; // tipe data untuk bind_param ('i' integer, 's' string)

// Jika ada filter brand, buat klausa WHERE untuk brand_id
if (!empty($brandIds)) {
    // Buat placeholder tanda tanya sebanyak jumlah brand yang dipilih
    $in = implode(',', array_fill(0, count($brandIds), '?'));
    $where[] = "products.brand_id IN ($in)"; // Contoh: products.brand_id IN (?, ?, ?)
    $params = array_merge($params, $brandIds); // masukkan id brand ke parameter
    $types .= str_repeat('i', count($brandIds)); // tipe data semua integer
}

// Jika ada filter kategori, buat klausa WHERE untuk category_id
if (!empty($categoryIds)) {
    $in = implode(',', array_fill(0, count($categoryIds), '?'));
    $where[] = "products.category_id IN ($in)";
    $params = array_merge($params, $categoryIds);
    $types .= str_repeat('i', count($categoryIds));
}

// Jika ada keyword pencarian nama produk
if (!empty($search)) {
    $where[] = "products.name LIKE ?";
    $params[] = "%$search%"; // wildcard LIKE
    $types .= 's'; // tipe data string
}

// SQL dasar mengambil data produk beserta nama kategori dan brand-nya
$sql = "
    SELECT products.id, products.name, products.price,
           categories.name AS category_name,
           brands.name AS brand_name,
           image AS image_url
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    LEFT JOIN brands ON products.brand_id = brands.id
";

// Jika ada kondisi WHERE, gabungkan dengan AND
if (!empty($where)) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

// Siapkan prepared statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // Jika gagal prepare, kirim error JSON dan keluar
    echo json_encode(['error' => 'Gagal menyiapkan query']);
    exit;
}

// Jika ada parameter, bind ke query
if (!empty($params)) {
    // bind_param butuh referensi, jadi kita buat variabel untuk ini
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
