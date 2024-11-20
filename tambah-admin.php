<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);

    if (empty($username) || empty($password) || empty($level)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO admin (user, password, level) VALUES ('$username', '$hashed_password', '$level')";
        if ($conn->query($query)) {
            $success = "Admin berhasil ditambahkan!";
        } else {
            $error = "Gagal menambahkan admin:" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
    <link rel="stylesheet" href="style_tambah.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Tambah Admin Baru</h3>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if (!empty($succes)) : ?>
            <div class="alert alert-succes"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
           
            <label for="level" class="form-label">Level</label>
            <select type="level" class="form-select" id="level" name="level" required>
                <option value="admin">Admin</option>
                <option value="operator">Operator</option>
            </select>
            
            <button type="submit" class="btn btn-primary">Tambah Admin</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>