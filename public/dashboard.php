<?php
include '../config/database.php';
session_start();

if (!isset($_SESSION['UserID']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Menghitung jumlah buku
$stmt = $pdo->query("SELECT COUNT(*) FROM buku");
$totalBooks = $stmt->fetchColumn();

// Menghitung jumlah pengguna
$stmt = $pdo->query("SELECT COUNT(*) FROM user");
$totalUsers = $stmt->fetchColumn();

// Mengambil data peminjam untuk logs
$stmt = $pdo->prepare("SELECT p.*, u.Username, b.Judul FROM peminjam p
                       JOIN user u ON p.UserID = u.UserID
                       JOIN buku b ON p.BukuID = b.BukuID
                       ORDER BY p.TanggalPeminjaman DESC");
$stmt->execute();
$logs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Digital Library</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="book_list.php">Book List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_list.php">User List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Admin Dashboard</h2>

        <!-- Total Books and Users -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Books</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalBooks; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalUsers; ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrowing Logs Section -->
        <h3 class="mt-5">Borrowing Logs</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Book Title</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?php echo $log['PeminjamanID']; ?></td>
                    <td><?php echo $log['Username']; ?></td>
                    <td><?php echo $log['Judul']; ?></td>
                    <td><?php echo $log['TanggalPeminjaman']; ?></td>
                    <td><?php echo $log['TanggalPengembalian']; ?></td>
                    <td><?php echo $log['StatusPeminjaman']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
