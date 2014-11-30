<?php
require_once 'util.php';

$login = Util::getLogin();

$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM users WHERE name='".$login."' and (password='' or password is NULL)";
$result = $conn->query($sql);
$conn->close();

$_SESSION = [];

header("Location: view1.php");

