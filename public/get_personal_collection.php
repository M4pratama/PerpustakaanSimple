<?php
include '../config/database.php';
session_start();

// Ambil koleksi pribadi buku yang dipinjam oleh pengguna
$stmt = $pdo->prepare("SELECT b.Judul, l.TanggalPeminjaman, l.TanggalPengembalian FROM peminjam l JOIN buku b ON l.BukuID = b.id WHERE l.UserID = :user_id AND l.StatusPeminjaman = 0");
$stmt->bindParam(':user_id', $_SESSION['UserID']);
$stmt->execute();
$personalCollection = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($personalCollection);
?>
