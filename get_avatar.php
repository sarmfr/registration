<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "SELECT avatar FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    header("Content-Type: image/jpeg");
    echo $row['avatar'];
}

$conn->close();
?>