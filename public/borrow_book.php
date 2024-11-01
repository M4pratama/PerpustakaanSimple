<?php
include '../config/database.php';
session_start();
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['peminjam'])) {
    $bukuID = $_POST['bukuID'];
    $userID = $_SESSION['UserID'];
    $TanggalPeminjaman = date('Y-m-d');

    // Insert data peminjaman
    $stmt = $pdo->prepare("INSERT INTO peminjam (BukuID, UserID, TanggalPeminjaman) VALUES (:bukuID, :userID, :TanggalPeminjaman)");
    $stmt->bindParam(':bukuID', $bukuID);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':TanggalPeminjaman', $TanggalPeminjaman);

    if ($stmt->execute()) {
        echo "<script>Swal.fire('Success!', 'Book borrowed successfully!', 'success'); window.location.href='book_list.php';</script>";
    } else {
        echo "<script>Swal.fire('Error!', 'Failed to borrow book.', 'error');</script>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <h2 class="text-center">Borrow Book</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="book_id" class="form-label">Book ID</label>
                <input type="text" class="form-control" id="book_id" name="book_id" required>
            </div>
            <button type="submit" class="btn btn-primary" name="borrow">Borrow Book</button>
        </form>
    </div>
    
</body>
</html>
