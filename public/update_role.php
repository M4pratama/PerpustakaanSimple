<?php
include '../config/database.php';
session_start();

if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['UserID'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare("UPDATE user SET role = :role WHERE UserID = :id");
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $userID);

    if ($stmt->execute()) {
        echo "<script>alert('User role updated successfully'); window.location.href='user_list.php';</script>";
    } else {
        echo "<script>alert('Failed to update user role'); window.location.href='user_list.php';</script>";
    }
}
?>
