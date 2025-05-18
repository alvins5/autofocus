<?php
// forgot_password.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Cek apakah email terdaftar
    // (anggap $conn adalah koneksi ke database)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate token untuk reset password
        $token = bin2hex(random_bytes(50));
        $resetLink = "https://autofocus.sijavengerz.tech/reset_password.php?token=" . $token;

        // Simpan token ke database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
        $stmt->execute([$token, $email]);

        // Kirim email reset password
        $subject = "Reset Password Autofocus";
        $message = "
        <html>
        <head>
          <title>Reset Password</title>
        </head>
        <body>
          <p>Hai {$user['username']},</p>
          <p>Klik link berikut untuk reset password kamu:</p>
          <p><a href='{$resetLink}'>Reset Password</a></p>
          <p>Link ini berlaku 1 jam saja.</p>
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Autofocus <noreply@autofocus.sijavengerz.tech>" . "\r\n";

        mail($email, $subject, $message, $headers);

        echo "Email reset password sudah dikirim!";
    } else {
        echo "Email tidak ditemukan.";
    }
}
?>
