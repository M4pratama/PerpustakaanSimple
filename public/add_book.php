<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add New Book</h2>
        <form action="../controllers/bookController.php" method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Book Title</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Enter book title" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Author</label>
                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Enter author's name" required>
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Publisher</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Enter publisher" required>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Year Published</label>
                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Enter year published" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="add_book">Add Book</button>
        </form>
    </div>
</body>
</html>
