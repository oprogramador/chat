<?php

class Util {

    public static function session($index) {
        session_start();
        return isset($_SESSION[$index]) ? $_SESSION[$index] : "";
    }

    public static function getLoginData($index) {
        session_start();
        if(isset($_SESSION[$index])) return $_SESSION[$index];
        else header('Location: view1.php');
    }
    
    public static function getLogin() {
        return self::getLoginData();
    }
}
