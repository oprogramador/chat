<?php
require_once 'mail.php';
require_once 'generSite.php';


$login = $_POST['login'];
$password = $_POST['password'];
$rpassword = $_POST['rpassword'];
$email = $_POST['email'];
if(!isset($_SESSION)) session_start();

echo 'password='.$password;
if($password == '') {
    echo 'true';
    $_SESSION['errors'] = 'password must not be empty';
    header('Location: register_view.php');
}

if($password != $rpassword) {
    $_SESSION['errors'] = 'passwords are not the same';
    header('Location: register_view.php');
}


$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id FROM users WHERE name='".$conn->real_escape_string($login)."'";
$result = $conn->query($sql);

$add = true;
if($result) if($result->num_rows > 0) $add = false;
if($add) {
    $sql = "INSERT INTO users (name, password, email) VALUES (".
        "'".$conn->real_escape_string($login)."',".
        "PASSWORD('".$conn->real_escape_string($password)."'),".
        "'".$conn->real_escape_string($email)."'".
        ")";
    $conn->query($sql);

    $sql = "SELECT id, name FROM users WHERE name='".$conn->real_escape_string($login)."' limit 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['login_id'] = $id = $row['id'];
    $_SESSION['login'] = $row['name'];
    $conn->close();
    $link = generVerifSite($id);
    $msg = <<<DELIM
        To verify your account please click the following link below:
        $link
DELIM;
    echo 'email='.$email;
    sendMail($email, 'Account verification', $msg);
    header("Location: not_verified_account.php");
}
