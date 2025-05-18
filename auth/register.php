<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../user/dashboard.php");
    }
    exit();
}
include __DIR__ . '/../header/header-fixed.php';
include __DIR__ . '/../header/header-floating.php';
require __DIR__ . '/../config/db.php';

// Tampilkan error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kalau tombol register diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $no_telp  = isset($_POST['no_telp']) ? trim($_POST['no_telp']) : '';  // Default to empty if not set

    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($no_telp)) {
        $_SESSION['error'] = "Semua field harus diisi.";
    } else {
        // Cek apakah email sudah terdaftar
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = "Email sudah digunakan.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan ke database
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, no_telp) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$username, $email, $hashed_password, $no_telp])) {
                $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['error'] = "Registrasi gagal. Silakan coba lagi.";
            }
        }
    }
}
?>
<div class="flex flex-col items-center justify-center h-[25rem] mb-[5rem] h-full w-full mt-[5.5rem]">
    <div class="flex w-[27rem] flex-col justify-between bg-white h-[35rem] items-center rounded-3xl p-5 font-[poppins]">
        <h2 class="text-black text-xl uppercase font-bold flex">Register</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p style='color:red;'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo "<p style='color:green;'>".$_SESSION['success']."</p>";
            unset($_SESSION['success']);
        }
        ?>
        <div class="text-gray-600 px-[20rem]">
        <form method="POST" action="/register">
            <div class="flex flex-col ">
                <label for="username">Username</label>
                <input class="bg-gray-200 rounded-md placeholder:px-1 px-5" type="text" name="username" placeholder="Username" required><br>
                <label for="email">Email</label>
                <input class="bg-gray-200 rounded-md placeholder:px-1 px-5" type="email" name="email" placeholder="Email" required><br>
                <label for="password">Password</label>
                <input class="bg-gray-200 rounded-md placeholder:px-1 px-5" type="password" name="password" placeholder="Password" required><br>
                <label for="no_telp">No telp</label>
                <input class="bg-gray-200 rounded-md placeholder:px-1 px-5" type="text" name="no_telp" placeholder="No. Telepon" required><br> <!-- Added no_telp field -->
            </div>
            <div class="text-sm flex text-gray-100 border-2 bg-zinc-800 w-[5rem] h-[2.5rem] px-auto item-center justify-center rounded-lg mt-10">
                <button type="submit">Register</button>
            </div>
        </form>
        <p>Sudah punya akun? <a href="/login" class="relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-black after:transition-all after:duration-300 hover:after:w-full">Login di sini</a></p>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/../footer/footer.php';