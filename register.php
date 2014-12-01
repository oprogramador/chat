<?php
require_once 'util.php';
require_once 'mail.php';
require_once 'generSite.php';


$login = $_POST['login'];
$password = $_POST['password'];
$rpassword = $_POST['rpassword'];
$email = $_POST['email'];
if(!isset($_SESSION)) 

echo 'password='.$password;
if($password == '') {
    echo 'true';
    Util::toSession('errors', 'password must not be empty');
    header('Location: register_view.php');
}

if($password != $rpassword) {
    Util::toSession('errors', 'passwords are not the same');
    header('Location: register_view.php');
}

$result = Util::query("SELECT id FROM users WHERE name='%s' LIMIT 1", [$login]);
$add = true;
if($result) if($result->num_rows > 0) $add = false;
if($add) {
    Util::query("INSERT INTO users (name, password, email) VALUES ('%s', PASSWORD('%s'), '%s')", [$login, $password, $email]);
    $row = Util::queryRow("SELECT id, name FROM users WHERE name='%s' LIMIT 1", [$login]);
    Util::toSession('login_id', $id = $row['id']);
    Util::toSession('login', $row['name']);
    $link = generVerifSite($id);
    $msg = <<<DELIM
        To verify your account please click the following link below:
        $link
DELIM;
    sendMail($email, 'Account verification', $msg);
    header("Location: not_verified_account.php");
}
