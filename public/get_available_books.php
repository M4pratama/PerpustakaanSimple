<?php
include '../config/database.php';
session_start();

// Ambil buku yang tersedia untuk dipinjam
$stmt = $pdo->query("SELECT * FROM buku WHERE BukuID NOT IN (SELECT BukuID FROM peminjam WHERE UserID = :user_id AND returned = 0)");
$stmt->bindParam(':user_id', $_SESSION['UserID']);
$stmt->execute();
$availableBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($availableBooks);
?>
