<?php
require_once 'util.php';


$login = Util::getLoginId();
$partner = Util::getSessionData('partner_id');
$text = $_POST['message'];
echo 'login='.$login;
echo 'partner='.$partner;

Util::query("INSERT INTO messages (text, sender, receiver) VALUES ('%s', %s, %s)", [$text, $login, $partner]);

header("Location: view3.php");

