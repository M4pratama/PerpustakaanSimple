<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bukuID = $_POST['BukuID'];
    $userID = $_SESSION['UserID'];

    // Menghapus buku dari koleksi pribadi pengguna
    $stmt = $pdo->prepare("DELETE FROM koleksipribadi WHERE BukuID = :bukuID AND UserID = :userID");
    $stmt->bindParam(':bukuID', $bukuID);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Update log pengembalian buku di tabel peminjam
    $stmtUpdate = $pdo->prepare("UPDATE peminjam SET StatusPeminjaman = 'dikembalikan', TanggalPengembalian = NOW() WHERE BukuID = :bukuID AND UserID = :userID AND StatusPeminjaman = 'dipinjam'");
    $stmtUpdate->bindParam(':bukuID', $bukuID);
    $stmtUpdate->bindParam(':userID', $userID);
    $stmtUpdate->execute();

    // Redirect kembali ke dashboard pengunjung
    header('Location: dashboard_pengunjung.php');
    exit();
} else {
    // Jika akses langsung, redirect ke halaman dashboard
    header('Location: dashboard_pengunjung.php');
    exit();
}
?>
