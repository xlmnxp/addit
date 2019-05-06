<?php
/**

 * User: xlmnxp
 * Date: 9/17/17
 * Time: 7:59 PM
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

    $status = $db->table("reports")->where('id',$_GET['id'])->update([
        "checked"      => 1
    ]);

    if($status){
        echo json_encode(array(
            'status' => 'success',
            'message' => 'report updated.'
        ));
        exit(0);
    }