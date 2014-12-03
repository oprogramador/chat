<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
require_once 'util.php';

function checkData($password, $rpassword, $email, $location) {
    if($password == '') {
        Util::toSession('errors', 'password must not be empty');
        header('Location: '.$location);
        return true;
    } else if($password != $rpassword) {
        Util::toSession('errors', 'passwords are not the same');
        header('Location: '.$location);
        return true;
    } else if($email == '') {
        Util::toSession('errors', 'email must not be empty');
        header('Location: '.$location);
        return true;
    } else return false;
}
