<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Cek apakah email ada di database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Buat token unik
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+24 hour"));

        // Simpan token dan waktu kedaluwarsa ke database
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->execute([$token, $expires, $email]);

        // Link reset password
        $resetLink = "https://autofocus.sijavengerz.tech/reset_password.php?token=" . $token;
        
        // Kirim email ke pengguna (Pastikan server email dikonfigurasi)
        $to = $email;
        $subject = "Reset Password";
        $message = "Klik link berikut untuk mereset password Anda: " . $resetLink;
        $headers = "From: no-reply@autofocus.com";

        mail($to, $subject, $message, $headers);

        echo "Link reset password telah dikirim ke email Anda!";
    } else {
        echo "Email tidak ditemukan!";
    }
}
?>
