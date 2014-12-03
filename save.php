<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
require_once 'util.php';
require_once 'draw.php';

$login = Util::getLoginId();
$partner = Util::getSessionData('partner_id');
$text = $_POST['message'];

Util::query("INSERT INTO messages (text, sender, receiver) VALUES ('%s', %s, %s)", [$text, $login, $partner]);
setcookie('ajax', Util::randStrAlpha(40), time() + (86400 * 30), "/");
drawImages();

header("Location: view3.php");
