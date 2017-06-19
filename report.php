<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 4/2/17
 * Time: 12:04 AM
 */

    include_once ("global.php");
    global $db,$template,$templateDirectory,$default;

    $user = $db->table("users")->where("id",(@$_GET['id'] ? @$_GET['id'] : 1))->select()[0];
    $template->page = $language->report;
    $template->user = $user;
    if(isset($_POST["submit"])) {
        $errors= array();

        if(!isset($_POST['form_key']) || !$form->validate()){
            $errors[]= $language->error_validate_key;
        }

        if (strlen($_POST["message"]) < 250 && empty($errors)) {
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

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form = ob_get_clean();
    $template->search_form = $search_form;

    $template->setFile($templateDirectory.'/report.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();