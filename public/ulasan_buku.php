<?php
include 'config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];
    $bukuID = $_POST['bukuID'];
    $userID = $_SESSION['UserID'];

    // Simpan ulasan dan rating
    $stmt = $pdo->prepare("INSERT INTO ulasanbuku (UserID, BukuID, Ulasan, Ranting) 
                           VALUES (:userID, :bukuID, :ulasan, :rating)");
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':bukuID', $bukuID);
    $stmt->bindParam(':ulasan', $ulasan);
    $stmt->bindParam(':rating', $rating);
    $stmt->execute();

    echo "<script>alert('Ulasan berhasil disimpan!'); window.location.href='koleksi_saya.php';</script>";
}
?>
