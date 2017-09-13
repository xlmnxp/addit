<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 9/9/17
 * Time: 4:25 PM
 */
    include_once('Functions/login.php');
    global $db, $language;

    header('Content-type: application/json');

    if(!isset($_GET['id'])){
        echo json_encode(array(
            'status' => 'error',
            'message' => 'id parameter undefined'
        ));
        return;
    }

    $userid = $_GET['id'];
    $userid = $_GET['id'] < 0 ? -1 : $userid;

    $user = $db->table('users')->where('id', $userid)->select(['id']);

    if(!$user[0] && ($userid != -1)){
        echo json_encode(array(
            'status' => 'error',
            'message' => 'user undefined'
        ));
        return;
    }


    if(count($user) > 0){

        $db->table('users')->find($userid)->delete();
        echo json_encode(array(
            'status' => 'success',
            'message' => $language->user_deleted_successfully
        ));
        return;
    }