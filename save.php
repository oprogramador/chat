<?php
require_once 'util.php';


$login = Util::getLoginId();
$partner = Util::getSessionData('partner_id');
$text = $_POST['message'];
echo 'login='.$login;
echo 'partner='.$partner;

$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO messages (text, sender, receiver) VALUES ("
    ."'".$conn->real_escape_string($text)."'," 
    ."'".$conn->real_escape_string($login)."'," 
    ."'".$conn->real_escape_string($partner)."')";
$result = $conn->query($sql);
$conn->close();


header("Location: view3.php");

