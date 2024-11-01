<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Pribadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Digital Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard_pengunjung.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="koleksi_pribadi.php">Koleksi Pribadi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center my-4">Koleksi Pribadi Anda</h2>

        <div class="row">
            <!-- Card Buku 1 -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Buku 1">
                    <div class="card-body">
                        <h5 class="card-title">Judul Buku 1</h5>
                        <p class="card-text">Penulis: Penulis 1</p>
                        <p class="card-text">Tanggal Pinjam: 2024-10-01</p>
                        <p class="card-text">Tanggal Kembali: 2024-10-15</p>
                        <button class="btn btn-danger" onclick="returnBook('Buku 1')">Kembalikan Buku</button>
                    </div>
                </div>
            </div>

            <!-- Card Buku 2 -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Buku 2">
                    <div class="card-body">
                        <h5 class="card-title">Judul Buku 2</h5>
                        <p class="card-text">Penulis: Penulis 2</p>
                        <p class="card-text">Tanggal Pinjam: 2024-10-03</p>
                        <p class="card-text">Tanggal Kembali: 2024-10-17</p>
                        <button class="btn btn-danger" onclick="returnBook('Buku 2')">Kembalikan Buku</button>
                    </div>
                </div>
            </div>

            <!-- Card Buku 3 -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Buku 3">
                    <div class="card-body">
                        <h5 class="card-title">Judul Buku 3</h5>
                        <p class="card-text">Penulis: Penulis 3</p>
                        <p class="card-text">Tanggal Pinjam: 2024-10-05</p>
                        <p class="card-text">Tanggal Kembali: 2024-10-19</p>
                        <button class="btn btn-danger" onclick="returnBook('Buku 3')">Kembalikan Buku</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function returnBook(bookTitle) {
            // Implement AJAX call to process the return of the book
            alert(`Anda telah mengembalikan ${bookTitle}!`);
            // Refresh the collection (this is a placeholder)
        }
    </script>
</body>
</html>
