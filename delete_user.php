<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "User deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting user: " . $conn->error;
    }
    
    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid user ID.";
}

$conn->close();
header("Location: index.php");
exit();
?>