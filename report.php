<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 4/2/17
 * Time: 12:04 AM
 */

    include_once ("global.php");
    $user = $db->table("users")->where("id",(@$_GET['id'] ? @$_GET['id'] : 1))->select()[0];
    $template->page = $language->report;

    if(isset($_POST["submit"])) {
        $errors= array();
        if (strlen($_POST["message"]) < 250) {
            $db->table("reports")->insert([
                "id" => null,
                "userid" => $user->id,
                "message" => $_POST["message"],
                "date" => date("Y-m-d H:i:s")
            ]);
            $template->success = true;
        }else{

            $errors[] = $language->message_length;

            $template->success = true;
            $template->errors = $errors;
        }
    }

    $template->default["page-title"] = $template->default["title"]." | $language->report ($user->username)";

    $template->setFile($templateDirectory.'/report.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
?>