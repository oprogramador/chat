<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
require_once 'util.php';

header('Content-Type: image/png');
$login = Util::getLogin();
$id = $_GET['id'];
readfile('images'.DIRECTORY_SEPARATOR.$login.DIRECTORY_SEPARATOR.$id.'.png');
