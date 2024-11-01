<?php
include '../config/database.php';
session_start();
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

// Mengambil data pengguna
$stmt = $pdo->query("SELECT * FROM user");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
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
        <h2 class="text-center">User List</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th> <!-- Kolom untuk Role -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo $u['UserID']; ?></td>
                    <td><?php echo $u['Username']; ?></td>
                    <td><?php echo $u['Email']; ?></td>
                    <td>
                        <form action="update_role.php" method="POST">
                            <input type="hidden" name="UserID" value="<?php echo $u['UserID']; ?>">
                            <select name="role" onchange="this.form.submit()">
                                <option value="admin" <?php if ($u['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                <option value="petugas" <?php if ($u['role'] == 'petugas') echo 'selected'; ?>>Petugas</option>
                                <option value="user" <?php if ($u['role'] == 'user') echo 'selected'; ?>>User</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="delete_user.php?id=<?php echo $u['UserID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
