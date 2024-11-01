<?php
include '../config/database.php';
session_start();
if (isset($_POST['update_book'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];

    // Update ke database
    $stmt = $pdo->prepare("UPDATE buku SET Judul = :judul, Penulis = :penulis, Penerbit = :penerbit, TahunTerbit = :tahun WHERE BukuID = :id");
    $stmt->bindParam(':judul', $judul);
    $stmt->bindParam(':penulis', $penulis);
    $stmt->bindParam(':penerbit', $penerbit);
    $stmt->bindParam(':tahun', $tahun);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Book updated successfully'); window.location.href='book_list.php';</script>";
    } else {
        echo "<script>alert('Failed to update book'); window.location.href='edit_book.php?id=$id';</script>";
    }
}
?>
