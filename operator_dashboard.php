<?php
session_start();

if (!isset ($_SESSION['level']) || $_SESSION['level'] !== 'operator') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Dashboard</title>
    <link rel="stylesheet" href="sementara_dashboard_style.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['user']); ?>!</h1>
        <p>Anda login sebagai <strong>Operator</strong>.</p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>