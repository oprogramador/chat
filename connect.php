<?php
require_once 'util.php';


$partner_id = Util::getSessionData('partner_id') = $_GET['partner_id'];

$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM users WHERE id='".$conn->real_escape_string($partner_id)."'";
$result = $conn->query($sql);
Util::toSession('partner', $result->fetch_assoc()['name']);



header("Location: view3.php");
