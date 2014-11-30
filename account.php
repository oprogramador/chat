<?php

session_start();
$login_id = $_SESSION['login_id'];
$password = $_SESSION['row']['password']; 
$cpassword = $_POST['cpassword'];

$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select PASSWORD('".$conn->real_escape_string($cpassword)."') hp";
$result = $conn->query($sql);
$hashpass = $result->fetch_assoc()['hp'];

if($hashpass != $password) {
    echo 'neq';
    $_SESSION['errors'] = 'incorrect password';
    $conn->close();
    header('Location: account_view.php');
}

$sql = "UPDATE users SET name='"
    .$conn->real_escape_string($_POST['login']).
    "', password=PASSWORD('".
    $conn->real_escape_string($_POST['password']).
    "'), email='".
    $conn->real_escape_string($_POST['email']).
    "' WHERE id=".$conn->real_escape_string($login_id)." LIMIT 1";
$result = $conn->query($sql);
$conn->close();
//header('Location: view2.php');

