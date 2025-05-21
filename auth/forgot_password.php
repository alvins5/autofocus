<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__. '/../config/db.php';
require __DIR__. '/../config/smtp.php';

function sendMail($to, $subject, $body) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@autofocus.sijavengerz.tech" . "\r\n";
    return mail($to, $subject, $body, $headers);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $stmt2 = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
        $stmt2->execute([$email, $token]);

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
    <title>Lupa Password</title>
</head>
<body>
    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Kirim Link Reset</button>
    </form>
</body>
</html>