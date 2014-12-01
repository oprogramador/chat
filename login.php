<?php
require_once 'util.php';

$login = $_POST['login'];
$password = $_POST['password'];

Util::toSession('login', $login);

$result = Util::query("SELECT id FROM users WHERE name='%s' LIMIT 1", [$login]);

$exists = false;
$go = false;
if($result) if($result->num_rows > 0) $exists = true;
if(!$exists && $password=='') {
    Util::query("INSERT INTO users (name) VALUES ('%s')", [$login]);
    $go = true;
} else {
    $result = Util::query("SELECT id FROM users WHERE name='%s' and PASSWORD('%s')=password limit 1", [$login, $password]);
    if($result) if($result->num_rows > 0) $go = true;
}

if($go) {
    $id = Util::queryCell("SELECT id FROM users WHERE name='%s' LIMIT 1", [$login], "id");
    Util::toSession('login_id', $id);
    $verified = Util::queryCell("SELECT verified FROM users WHERE id=%s LIMIT 1", [$id], 'verified');
    header("Location: ".(!$exists || $verified ? "view2.php" : "not_verified_account.php"));
} else {
    Util::toSession('errors', 'Not correct username or password');
    header("Location: view1.php");
}
