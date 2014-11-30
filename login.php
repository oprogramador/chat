<?php

$login = $_POST['login'];
$password = $_POST['password'];

session_start();
$_SESSION['login'] = $login;

$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id FROM users WHERE name='".$conn->real_escape_string($login)."' LIMIT 1";
$result = $conn->query($sql);

$exists = false;
$go = false;
if($result) if($result->num_rows > 0) $exists = true;
if(!$exists && $password=='') {
    $sql = "INSERT INTO users (name) VALUES ('".$conn->real_escape_string($login)."')";
    $conn->query($sql);
    $go = true;
} else {
    $sql = "SELECT id FROM users WHERE name='"
        .$conn->real_escape_string($login).
        "' and PASSWORD('".
        $conn->real_escape_string($password).
        "')=password limit 1";
    $conn->query($sql);
    $result = $conn->query($sql);
    if($result) if($result->num_rows > 0) $go = true;
}

if($go) {
    $sql = "SELECT id FROM users WHERE name='".$conn->real_escape_string($login)."' limit 1";
    $result = $conn->query($sql);
    $_SESSION['login_id'] = $id = $result->fetch_assoc()['id'];
    $sql = "SELECT verified FROM users WHERE id=".$conn->real_escape_string($id)." limit 1";
    $result = $conn->query($sql);
    $verified = $result->fetch_assoc()['verified'];
    $conn->close();
    header("Location: ".(!$exists || $verified ? "view2.php" : "not_verified_account.php"));
} else {
    $_SESSION['errors'] = 'Not correct username or password';
    header("Location: view1.php");
}
//$conn->close();


//header("Location: http://www.google.com");
//die();
