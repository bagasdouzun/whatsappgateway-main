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
<body>
    <div class="container">
        <h2>List Admin & Operator</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['user']; ?></td>
                        <td><?php echo ucfirst($row['level']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id_admin']; ?>">Edit</a>
                        </td>
                        <td>
                            <a href="delete_user.php?id=<?php echo $row['id_admin']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
