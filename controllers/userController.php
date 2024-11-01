<?php
session_start();
include '../config/database.php';

// Proses login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mengecek user
    $stmt = $pdo->prepare("SELECT * FROM user WHERE Email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['Password'])) {
        // Set session
        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['Username'] = $user['Username'];
        $_SESSION['role'] = $user['role'];  // Set session untuk role

        // Redirect berdasarkan role
        if ($user['role'] == 'admin') {
            header('Location: ../public/dashboard.php');
        } elseif ($user['role'] == 'petugas') {
            header('Location: ../public/petugasDashboard.php');
        } else {
            header('Location: ../public/dashboard_pengunjung.php');
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href='../public/login.php';</script>";
    }
}

// Proses registrasi
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert ke database
    $stmt = $pdo->prepare("INSERT INTO user (Username, Email, Password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful'); window.location.href='../public/login.php';</script>";
    } else {
        echo "<script>alert('Registration failed'); window.location.href='../public/register.php';</script>";
    }
}
?>
