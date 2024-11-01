<?php
include '../config/database.php';
session_start();
if (isset($_POST['register_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert ke database
    $stmt = $pdo->prepare("INSERT INTO user (Username, Email, Password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
        echo "<script>alert('User registered successfully'); window.location.href='user_list.php';</script>";
    } else {
        echo "<script>alert('Failed to register user'); window.location.href='register_user.php';</script>";
    }
}
?>
