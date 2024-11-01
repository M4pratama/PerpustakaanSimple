<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Mengambil data buku
$stmt = $pdo->query("SELECT * FROM buku");
$buku = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mengambil koleksi pribadi pengguna
$userId = $_SESSION['UserID'];
$stmtKoleksi = $pdo->prepare("SELECT b.*, kp.koleksiID FROM buku b JOIN koleksipribadi kp ON b.BukuID = kp.BukuID WHERE kp.UserID = :userId");
$stmtKoleksi->bindParam(':userId', $userId);
$stmtKoleksi->execute();
$koleksiPribadi = $stmtKoleksi->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengunjung</title>
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
                        <a class="nav-link" href="dashboard_pengunjung.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
    <h2 class="text-center">Dashboard Pengunjung</h2>

    <div class="row mt-4">
        <div class="col-md-6">
            <h4>Daftar Buku</h4>
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>BukuID</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($buku as $b): ?>
                    <tr>
                        <td><?php echo $b['BukuID']; ?></td>
                        <td><?php echo $b['Judul']; ?></td>
                        <td><?php echo $b['Penulis']; ?></td>
                        <td><?php echo $b['Penerbit']; ?></td>
                        <td><?php echo $b['TahunTerbit']; ?></td>
                        <td>
                            <form action="proses_pinjam.php" method="POST">
                                <input type="hidden" name="BukuID" value="<?php echo $b['BukuID']; ?>">
                                <button type="submit" class="btn btn-primary" name="pinjam">Pinjam</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h4>Koleksi Pribadi Anda</h4>
            <table class="table table-hover table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>BukuID</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($koleksiPribadi) > 0): ?>
                        <?php foreach ($koleksiPribadi as $kp): ?>
                        <tr>
                            <td><?php echo $kp['BukuID']; ?></td>
                            <td><?php echo $kp['Judul']; ?></td>
                            <td><?php echo $kp['Penulis']; ?></td>
                            <td><?php echo $kp['Penerbit']; ?></td>
                            <td><?php echo $kp['TahunTerbit']; ?></td>
                            <td>
                                <form action="proses_kembalikan.php" method="POST">
                                    <input type="hidden" name="BukuID" value="<?php echo $kp['BukuID']; ?>">
                                    <button type="submit" class="btn btn-warning" name="kembalikan">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada koleksi pribadi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>