<?php
include 'config/database.php';
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit();
}

// Ambil koleksi buku pribadi
$userID = $_SESSION['UserID'];
$stmt = $pdo->prepare("SELECT b.Judul, p.TanggalPeminjaman, p.TanggalPengembalian, p.StatusPeminjaman
                       FROM peminjam p
                       JOIN buku b ON p.BukuID = b.BukuID
                       WHERE p.UserID = :userID");
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$koleksi = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Koleksi Buku Saya</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Status Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($koleksi as $buku): ?>
                <tr>
                    <td><?php echo $buku['Judul']; ?></td>
                    <td><?php echo $buku['TanggalPeminjaman']; ?></td>
                    <td><?php echo $buku['StatusPeminjaman'] == 'Dikembalikan' ? 'Sudah Dikembalikan' : 'Belum Dikembalikan'; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kembalikan'])) {
    $peminjamanID = $_POST['peminjamanID'];

    // Proses pengembalian buku
    $stmt = $pdo->prepare("UPDATE peminjam SET TanggalPengembalian = NOW(), StatusPeminjaman = 'Dikembalikan' 
                           WHERE PeminjamanID = :peminjamanID");
    $stmt->bindParam(':peminjamanID', $peminjamanID);
    $stmt->execute();

    echo "<script>alert('Buku berhasil dikembalikan!'); window.location.href='koleksi_saya.php';</script>";
}
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
