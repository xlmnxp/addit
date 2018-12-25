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

    $page_id = $_GET['id'];
    $page_id = $_GET['id'] < 0 ? -1 : $page_id;

    $page = $db->table('pages')->where('id', $page_id)->select(['id']);

    if(!$page[0] && ($page_id != -1)){
        echo json_encode(array(
            'status' => 'error',
            'message' => 'page undefined'
        ));
        exit(0);
    }


    if(@count($page)){

        $db->table('pages')->find($page_id)->delete();
        echo json_encode(array(
            'status' => 'success',
            'message' => $language->page_deleted_successfully
        ));
        exit(0);
    }