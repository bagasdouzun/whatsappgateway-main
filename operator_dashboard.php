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
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['user']); ?>!</h1>
            <p>Anda login sebagai <strong>Operator</strong>.</p>
        </header>
        
        <main class="dashboard-main">
            <div class="button-group">
                <a href="list_admin_operator.php" class="btn btn-primary">List Admin & Operator</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </main>
    </div>
</body>
</html>