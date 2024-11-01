<?php
include '../config/database.php';

if (isset($_POST['add_book'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];

    // Insert ke database
    $stmt = $pdo->prepare("INSERT INTO buku (Judul, Penulis, Penerbit, TahunTerbit) VALUES (:judul, :penulis, :penerbit, :tahun)");
    $stmt->bindParam(':judul', $judul);
    $stmt->bindParam(':penulis', $penulis);
    $stmt->bindParam(':penerbit', $penerbit);
    $stmt->bindParam(':tahun', $tahun);
    
    if ($stmt->execute()) {
        echo "<script>alert('Book added successfully'); window.location.href='../public/book_list.php';</script>";
    } else {
        echo "<script>alert('Failed to add book'); window.location.href='../public/add_book.php';</script>";
    }
}
?>
