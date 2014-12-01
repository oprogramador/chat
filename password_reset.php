<?php
require_once 'util.php';
require_once 'mail.php';
require_once 'generSite.php';


$login = $_POST['login'];
$result = Util::query("SELECT id, email FROM users WHERE name='%s' LIMIT 1", [$login]);

$go = true;
if($result) if($result->num_rows == 0) $go = false;
if(!$result || !$go) {
    Util::toSession('errors', 'Such email has been not found.');
    header("Location: password_reset_view.php");
}

$row = $result->fetch_assoc();
Util::toSession('login_id', $id = $row['id']);
Util::toSession('login', $row['name']);
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
