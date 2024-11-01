<?php
include '../config/database.php';
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus dari database
    $stmt = $pdo->prepare("DELETE FROM buku WHERE BukuID = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Book deleted successfully'); window.location.href='book_list.php';</script>";
    } else {
        echo "<script>alert('Failed to delete book'); window.location.href='book_list.php';</script>";
    }
}
?>
