<?php
include '../config/database.php';
session_start();
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Ambil riwayat peminjaman
$userID = $_SESSION['UserID'];
$stmt = $pdo->prepare("SELECT b.Judul, br.TanggalPeminjaman, br.TanggalPengembalian FROM Peminjam br JOIN buku b ON br.BukuID = b.BukuID WHERE br.UserID = :userID");
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$borrowHistory = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Digital Library</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="book_list.php">Book List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Borrow History</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrowHistory as $history): ?>
                <tr>
                    <td><?php echo $history['Judul']; ?></td>
                    <td><?php echo $history['TanggalPeminjaman']; ?></td>
                    <td><?php echo $history['TanggalPengembalian'] ? $history['TanggalPengembalian'] : 'Not returned yet'; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
