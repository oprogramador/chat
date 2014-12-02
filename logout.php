<?php
require_once 'util.php';

$login = Util::getLogin();
Util::query("DELETE FROM users WHERE name='%s' and (password='' or password is NULL)", [$login]);
Util::clearSession();

header("Location: view1.php");

