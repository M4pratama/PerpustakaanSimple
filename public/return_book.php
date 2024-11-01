<?php
include '../config/database.php';
session_start();
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['return'])) {
    $borrowID = $_POST['Peminjam_id'];
    $returnDate = date('Y-m-d');

    // Update tanggal pengembalian
    $stmt = $pdo->prepare("UPDATE peminjam SET TanggalPengembalian = :tanggalPengembalian WHERE PeminjamanID = :peminjamanID");
    $stmt->bindParam(':TanggalPeminjaman', $returnDate);
    $stmt->bindParam(':TanggalPengembalian', $borrowID);

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
    <title>Return Book</title>
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
        <h2 class="text-center">Return Book</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="borrow_id" class="form-label">Borrow ID</label>
                <input type="text" class="form-control" id="borrow_id" name="borrow_id" required>
            </div>
            <button type="submit" class="btn btn-primary" name="return">Return Book</button>
        </form>
    </div>
</body>
</html>
