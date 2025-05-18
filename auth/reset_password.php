<?php
include __DIR__ . '/../header/header-fixed.php';
include __DIR__ . '/../header/header-floating.php';
session_start();
require __DIR__ . '/../config/db.php';

if (!isset($_GET['token']) || $_GET['token'] !== $_SESSION['reset_token']) {
    die('Token tidak valid!');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    if ($stmt->execute([$new_password, $_SESSION['reset_email']])) {
        unset($_SESSION['reset_token']);
        unset($_SESSION['reset_email']);
        echo "<h1>Password berhasil direset. Silakan login.</h1>";
        echo "<br><a href='login.php'>Login</a>";
    } else {
        echo "<h1>Gagal reset password.</h1>";
    }
}
?>

<form method="post">
    <h2>Reset Password</h2>
    <input type="password" name="new_password" placeholder="Password Baru" required><br><br>
    <button type="submit">Reset Password</button>
</form>

<?php
include __DIR__ . '/../footer/footer.php';
