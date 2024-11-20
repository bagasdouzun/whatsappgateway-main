<?php
include 'koneksi.php';

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user from the database
    $delete_query = "DELETE FROM admin WHERE id_admin = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "User deleted successfully!";
        header('Location: list_admin_operator.php');
    } else {
        echo "Error deleting user.";
    }
} else {
    echo "No user ID provided!";
    exit();
}
?>
