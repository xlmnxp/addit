<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 9/4/17
 * Time: 8:04 AM
 */

    $languageFile = "../Languages/";
    include_once('../global.php');
    global $default,$language;

    if((!isset($_SESSION['login']) || !isset($_SESSION['username']) || !isset($_SESSION['password']) || $_SESSION['login'] == null) && basename($_SERVER["SCRIPT_FILENAME"], '.php') != "login"){
        header('location: login.php');
        exit();
    }else if( isset($_SESSION['login']) && ($_SESSION['username'] != $default["cp_username"] || $_SESSION['password'] != $default["cp_password"])){
        header('location: logout.php');
        exit();
    }