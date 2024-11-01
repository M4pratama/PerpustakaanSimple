<?php
include 'config/database.php';
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $bukuID = $_GET['id'];
    $userID = $_SESSION['UserID'];
    
    // Proses peminjaman
    $stmt = $pdo->prepare("INSERT INTO peminjam (UserID, BukuID, TanggalPeminjaman, StatusPeminjaman) 
                           VALUES (:userID, :bukuID, NOW(), 'Dipinjam')");
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':bukuID', $bukuID);
    $stmt->execute();
    
    echo "<script>alert('Buku berhasil dipinjam!'); window.location.href='dashboard_pengunjung.php';</script>";
}
?>
