<?php
include 'koneksi.php';

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data based on the ID
    $query = "SELECT * FROM admin WHERE id_admin = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit();
    }
} else {
    echo "No user ID provided!";
    exit();
}

if (isset($_POST['update'])) {
    // Get the updated data from the form
    $username = $_POST['username'];
    $level = $_POST['level'];

    // Update the user data in the database
    $update_query = "UPDATE admin SET user = ?, level = ? WHERE id_admin = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssi", $username, $level, $id);
    $update_stmt->execute();

    if ($update_stmt->affected_rows > 0) {
        echo "User updated successfully!";
        header('Location: user_list.php');
    } else {
        echo "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style_list_admin_operator.css">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['user']; ?>" required><br><br>

            <label for="level">Level:</label>
            <select id="level" name="level" required>
                <option value="admin" <?php echo ($user['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="operator" <?php echo ($user['level'] == 'operator') ? 'selected' : ''; ?>>Operator</option>
            </select><br><br>

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
