

<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
        $avatar = $conn->real_escape_string($avatar);
        $sql = "INSERT INTO users (username, email, password, avatar) VALUES ('$username', '$email', '$password', '$avatar')";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registration successful!";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}
?>

