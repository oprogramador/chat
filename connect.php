<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
require_once 'util.php';

$partner_id = $_GET['partner_id'];
Util::toSession('partner_id', $partner_id);
$partner = Util::queryCell("SELECT name FROM users WHERE id=%s LIMIT 1", [$partner_id], "name");
Util::toSession('partner', $partner);

header("Location: view3.php");
