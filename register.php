<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
require_once 'util.php';
require_once 'mail.php';
require_once 'generSite.php';
require_once 'check_data.php';

$login = $_POST['login'];
$password = $_POST['password'];
$rpassword = $_POST['rpassword'];
$email = $_POST['email'];

if(checkData($password, $rpassword, $email, 'register_view.php')) {
} else {
    $result = Util::query("SELECT id FROM users WHERE BINARY name='%s' LIMIT 1", [$login]);
    $add = true;
    if($result) if($result->num_rows > 0) $add = false;
    if($add) {
        Util::query("INSERT INTO users (name, password, email) VALUES ('%s', PASSWORD('%s'), '%s')", [$login, $password, $email]);
        $row = Util::queryRow("SELECT id, name FROM users WHERE BINARY name='%s' LIMIT 1", [$login]);
        Util::toSession('login_id', $id = $row['id']);
        Util::toSession('login', $row['name']);
        $link = generVerifSite($id);
        $msg = <<<DELIM
        To verify your account please click the following link below:
        $link
DELIM;
        try {
            sendMail($email, 'Account verification', $msg);
            header("Location: not_verified_account.php");
        } catch(\Exception $e) {
            Util::toSession('errors', 'such email does not exist');
            Util::query("DELETE FROM users WHERE BINARY id='%s' LIMIT 1", [$id]);
            header('Location: register_view.php');
        }
    } else {
        Util::toSession('errors', 'such username already exists');
        header('Location: register_view.php');
    }
}
