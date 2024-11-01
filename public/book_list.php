<?php
// Memasukkan file konfigurasi
include '../config/database.php';
session_start();

// Mengecek sesi pengguna
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Mengambil data buku
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Mengambil data buku untuk ditampilkan di daftar buku
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE Judul LIKE :search OR Penulis LIKE :search");
    $stmt->bindValue(':search', '%' . $search . '%');
} else {
    $stmt = $pdo->query("SELECT * FROM buku");
}
$stmt->execute();
$buku = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Digital Library</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="add_book.php">Add Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Book List</h2>
        <form action="" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search by title or author" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>BookID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buku as $bukuk): ?>
                <tr>
                    <td><?php echo htmlspecialchars($bukuk['BukuID']); ?></td>
                    <td><?php echo htmlspecialchars($bukuk['Judul']); ?></td>
                    <td><?php echo htmlspecialchars($bukuk['Penulis']); ?></td>
                    <td>
                        <a href="edit_book.php?id=<?php echo $bukuk['BukuID']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_book.php?id=<?php echo $bukuk['BukuID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php
    // Memeriksa apakah ada ID buku untuk diedit
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM buku WHERE BukuID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $buku = $stmt->fetch();
    }
    ?>

    
</body>
</html>
