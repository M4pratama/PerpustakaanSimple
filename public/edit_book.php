<?php
include '../config/database.php';
session_start();
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE BukuID = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $buku = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $ulasanbuku = $_POST['ulasanbuku'];

    $stmt = $pdo->prepare("UPDATE buku SET Judul = :judul, Penulis = :penulis, Ulasanbuku = :ulasanbuku WHERE BukuID = :id");
    $stmt->bindParam(':judul', $title);
    $stmt->bindParam(':penulis', $author);
    $stmt->bindParam(':ulasanbuku', $ulasanbuku);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Book updated successfully'); window.location.href='book_list.php';</script>";
    } else {
        echo "<script>alert('Failed to update book');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
        <h2 class="text-center">Edit Book</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $buku['Judul']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo $buku['Penulis']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ulasanbuku" class="form-label">Description</label>
                <textarea class="form-control" id="ulasanbuku" name="ulasanbuku" required><?php echo $buku['Ulasanbuku']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</body>
</html>
