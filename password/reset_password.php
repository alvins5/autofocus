<?php
require 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Cek apakah token valid
    $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            // Update password dan hapus token
            $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
            $stmt->execute([$newPassword, $token]);

            echo "Password berhasil diperbarui! Silakan login.";
            exit;
        }
    } else {
        echo "Token tidak valid atau telah kedaluwarsa!";
        exit;
    }
} else {
    echo "Token tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800">Reset Password</h2>
        <form method="POST" class="mt-4">
            <input type="password" name="new_password" placeholder="Masukkan password baru" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="w-full py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Perbarui Password</button>
        </form>
    </div>
</body>
</html>
