<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 9/17/17
 * Time: 7:59 PM
 */
    include_once('Functions/login.php');
    global $db, $language;

    header('Content-type: application/json');

    if(!isset($_POST['id'])){
        echo json_encode(array(
            'status' => 'error',
            'message' => 'id parameter undefined'
        ));
        exit(0);
    }

    $status = $db->table("users")->where('id',$_POST['id'])->update([
        "username"  => htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8'),
        "fullname"  => htmlspecialchars($_POST["fullname"], ENT_QUOTES, 'UTF-8'),
        "avatar"    => htmlspecialchars($_POST["avatar"], ENT_QUOTES, 'UTF-8'),
        "message"   => htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8'),
        "sex"       => htmlspecialchars($_POST["sex"], ENT_QUOTES, 'UTF-8'),
        "data"      => $_POST["data"]
    ]);

    if($status){
        echo json_encode(array(
            'status' => 'success',
            'message' => 'user was edited.'
        ));
        exit(0);
    }