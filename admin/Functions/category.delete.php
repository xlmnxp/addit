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

    $category_id = $_GET['id'];
    $category_id = $_GET['id'] < 0 ? -1 : $category_id;

    $category = $db->table('categories')->where('id', $category_id)->select(['id']);

    if(!$category[0] && ($category_id != -1)){
        echo json_encode(array(
            'status' => 'error',
            'message' => 'page undefined'
        ));
        exit(0);
    }


    if(@count($category)){

        $db->table('categories')->find($category_id)->delete();
        echo json_encode(array(
            'status' => 'success',
            'message' => $language->page_deleted_successfully
        ));
        exit(0);
    }