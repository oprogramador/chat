<?php

session_start();
$partner_id = $_SESSION['partner_id'] = $_GET['partner_id'];

$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM users WHERE id='".$conn->real_escape_string($partner_id)."'";
$result = $conn->query($sql);
$_SESSION['partner'] = $result->fetch_assoc()['name'];



header("Location: view3.php");
