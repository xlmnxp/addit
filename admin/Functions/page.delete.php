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
        exit(0);
    }

    $userid = $_GET['id'];
    $userid = $_GET['id'] < 0 ? -1 : $userid;

    $user = $db->table('pages')->where('id', $userid)->select(['id']);

    if(!$user[0] && ($userid != -1)){
        echo json_encode(array(
            'status' => 'error',
            'message' => 'page undefined'
        ));
        exit(0);
    }


    if(count($user)){

        $db->table('pages')->find($userid)->delete();
        echo json_encode(array(
            'status' => 'success',
            'message' => $language->page_deleted_successfully
        ));
        exit(0);
    }