<?php
/**

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

    $user_id = $_GET['id'];
    $user_id = $_GET['id'] < 0 ? -1 : $user_id;

    $user = $db->table('users')->where('id', $user_id)->select(['id']);

    if(!$user[0] && ($user_id != -1)){
        echo json_encode(array(
            'status' => 'error',
            'message' => 'user undefined'
        ));
        exit(0);
    }


    if(@count($user)){

        $db->table('users')->find($user_id)->delete();
        echo json_encode(array(
            'status' => 'success',
            'message' => $language->user_deleted_successfully
        ));
        exit(0);
    }