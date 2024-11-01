<?php
include '../config/database.php';
session_start();
if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];

    // Cek apakah email ada di database
    $stmt = $pdo->prepare("SELECT * FROM user WHERE Email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        // Kirim email reset password (menggunakan PHPMailer atau metode lainnya)
        // Simulasi dengan alert
        echo "<script>alert('Reset link sent to your email.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Email not found.'); window.location.href='reset_password.php';</script>";
    }
}
?>
