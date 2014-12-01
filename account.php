<?php
require_once 'util.php';


$login_id = Util::getLoginId();
$password = Util::getSessionData('row')['password']; 
$cpassword = $_POST['cpassword'];
$hashpass = Util::queryCell("select PASSWORD('%s') hp", [$cpassword], "hp");

if($hashpass != $password) {
    Util::toSession('errors', 'incorrect password');
    header('Location: account_view.php');
}

Util::query("UPDATE users SET name='%s', password=PASSWORD('%s'), email='%s' WHERE id=%s LIMIT 1", 
    [$_POST['login'], $_POST['password'], $_POST['email'], $login_id]);

header('Location: view2.php');
