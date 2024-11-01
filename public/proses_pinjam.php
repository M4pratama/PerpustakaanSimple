<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['pinjam'])) {
    $userId = $_SESSION['UserID'];
    $bukuId = $_POST['BukuID'];
    $tanggalPeminjaman = date('Y-m-d');
    
    // Simpan ke tabel peminjam, tanpa menyertakan TanggalPengembalian  
    $stmtPinjam = $pdo->prepare("INSERT INTO peminjam (UserID, BukuID, TanggalPeminjaman, StatusPeminjaman) VALUES (:userId, :bukuId, :tanggalPeminjaman, 'Dipinjam')");
    $stmtPinjam->bindParam(':userId', $userId);
    $stmtPinjam->bindParam(':bukuId', $bukuId);
    $stmtPinjam->bindParam(':tanggalPeminjaman', $tanggalPeminjaman);

    if ($stmtPinjam->execute()) {
        // Simpan ke tabel koleksipribadi
        $stmtKoleksi = $pdo->prepare("INSERT INTO koleksipribadi (UserID, BukuID) VALUES (:userId, :bukuId)");
        $stmtKoleksi->bindParam(':userId', $userId);
        $stmtKoleksi->bindParam(':bukuId', $bukuId);
        $stmtKoleksi->execute();
        
        echo "<script>alert('Buku berhasil dipinjam!'); window.location.href='dashboard_pengunjung.php';</script>";
    } else {
        echo "<script>alert('Gagal meminjam buku. Silakan coba lagi.'); window.location.href='dashboard_pengunjung.php';</script>";
    }
}
?>
