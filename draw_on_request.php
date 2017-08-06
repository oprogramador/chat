<?php
require_once 'util.php';

header('Content-Type: image/png');
$login = Util::getLogin();
$partner = Util::getSessionData('partner');
$id = $_GET['id'];
readfile('images'.DIRECTORY_SEPARATOR.$login.DIRECTORY_SEPARATOR.$partner.DIRECTORY_SEPARATOR.$id.'.png');
