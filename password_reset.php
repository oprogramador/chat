<?php
require_once 'mail.php';
require_once 'generSite.php';


$login = $_POST['login'];
if(!isset($_SESSION)) session_start();

$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, email FROM users WHERE name='".$conn->real_escape_string($login)."' LIMIT 1";
$result = $conn->query($sql);

$go = true;
if($result) if($result->num_rows == 0) $go = false;
if(!$result || !$go) {
    $_SESSION['errors'] = 'Such email has been not found.';
    header("Location: password_reset_view.php");
}

$row = $result->fetch_assoc();
$_SESSION['login_id'] = $id = $row['id'];
$_SESSION['login'] = $row['name'];
$email = $row['email'];
$conn->close();
$link = generVerifSite($id);
$msg = <<<DELIM
        To reset your password please click the following link below:
        $link
DELIM;
echo 'email='.$email;
sendMail($email, 'Account verification', $msg);
header("Location: account_view.php");
