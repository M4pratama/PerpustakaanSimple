<?php
include '../config/database.php';
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus dari database
    $stmt = $pdo->prepare("DELETE FROM user WHERE UserID = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully'); window.location.href='user_list.php';</script>";
    } else {
        echo "<script>alert('Failed to delete user'); window.location.href='user_list.php';</script>";
    }
}
?>
