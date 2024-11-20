<?php
include 'koneksi.php';

$query = "SELECT * FROM admin WHERE level IN ('admin', 'operator')";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Admin & Operator</title>
    <link rel="stylesheet" href="style_list_admin_operator.css">
</head>
<?php
session_start(); // Pastikan session sudah dimulai
// Cek apakah pengguna sudah login dan memiliki level
if (isset($_SESSION['level'])) {
    $userLevel = $_SESSION['level']; // Misalnya 'admin' atau 'operator'
} else {
    // Jika session tidak ada, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Tentukan URL tujuan tombol kembali berdasarkan level
if ($userLevel === 'admin') {
    $backUrl = 'admin_dashboard.php'; // Dashboard admin
} else if ($userLevel === 'operator') {
    $backUrl = 'operator_dashboard.php'; // Dashboard operator
} else {
    // Jika tidak ada level yang sesuai, arahkan ke halaman default
    $backUrl = 'index.php';
}
?>

<body>
    <div class="container">
        <header class="header">
            <h1>List Admin & Operator</h1>
        </header>
        
        <table>
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_admin']); ?></td>
                        <td><?php echo htmlspecialchars($row['user']); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($row['level'])); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id_admin']; ?>" class="btn btn-edit">Edit</a>
                            <a href="delete_user.php?id=<?php echo $row['id_admin']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Tombol Kembali dan Tambah Admin di bawah tabel -->
        <div class="action-buttons">
            <a href="<?php echo $backUrl; ?>" class="btn btn-back">Kembali</a>
            <a href="tambah_admin.php" class="btn btn-add">Tambah Admin</a>
        </div>

    </div>
</body>
</html>

