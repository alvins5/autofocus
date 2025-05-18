<?php
require __DIR__. '/../config/db.php';
require __DIR__. '/../config/smtp.php'; // file SMTP sudah kamu setup

function sendMail($to, $subject, $body) {
    // Assuming SMTP setup is done in smtp.php
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@autofocus.sijavengerz.tech" . "\r\n";

    return mail($to, $subject, $body, $headers);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Cek email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $token = bin2hex(random_bytes(50));

        // Simpan token sementara di session (atau bisa buat tabel reset_passwords kalau mau advanced)
        session_start();
        $_SESSION['reset_token'] = $token;
        $_SESSION['reset_email'] = $email;

        // Kirim Email
        $reset_link = "http://autofocus.sijavengerz.tech/auth/reset_password.php?token=" . $token;

        $subject = "Reset Password";
        $body = "Klik link berikut untuk reset password: <a href='$reset_link'>$reset_link</a>";

        if (sendMail($email, $subject, $body)) {
            echo "Email reset password telah dikirim.";
        } else {
            echo "Gagal mengirim email.";
        }
    } else {
        echo "Email tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
