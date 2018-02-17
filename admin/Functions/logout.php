<?php
/**

 * User: xlmnxp
 * Date: 9/4/17
 * Time: 9:51 AM
 */
    session_start();

    unset($_SESSION['login']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header('location: login.php');