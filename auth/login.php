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
require __DIR__. '/../config/db.php';


// Tampilkan error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kalau tombol login diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan Password harus diisi.";
    } else {
        // Cari user berdasarkan username
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Simpan data ke session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Arahkan ke dashboard sesuai role
  // Arahkan ke dashboard sesuai role
            if ($user['role'] == 'admin') {
              header("Location: ../admin/dashboard.php");
              exit();
            } else {
              header("Location: ../user/dashboard.php");
              exit();
            }

            } else {
                $_SESSION['error'] = "Password salah.";
            }
        } else {
            $_SESSION['error'] = "Username tidak ditemukan.";
        }
    }
}

include __DIR__ . '/../header/header-fixed.php';
?>
<div class="flex flex-col items-center justify-center h-[25rem] mb-[11rem] mt-[13rem]">
    <div class="flex w-[27rem] flex-col justify-between bg-white p-5 h-[25rem] items-center rounded-3xl p-10 font-[poppins]" >
        <h2 class="flex text-2xl font-bold text-black pt-5 uppercase">Login</h2>
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
        <form method="POST" action="/login" class="flex flex-col justify-center items-center font-[poppins] text-gray-600 gap-7 px-10 w-full">
            <div class="flex flex-col w-full ">
                <input class="rounded-md bg-gray-200 text-between p-2" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="flex flex-col w-full">
                <input class="rounded-md bg-gray-200 text-between p-2" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="text-lg flex text-gray-100 mt-[1.5rem] border-2 bg-zinc-800 w-[5rem] h-[2.5rem] px-auto item-center justify-center rounded-lg">
            <button type="submit">Login</button>
            </div>
        </form>
        <div class="flex flex-col gap-1 items-center text-gray-600">
            <div class="flex">
            <p>Lupa password? <a href="/forgot_password" class="relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-black after:transition-all after:duration-300 hover:after:w-full">Reset di sini</a></p>
            </div>
            <div>
            </div class="flex">
            <p>Belum punya akun? <a href="/register" class="relative after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-black after:transition-all after:duration-300 hover:after:w-full">Register di sini</a></p>
            </div>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/../footer/footer.php';