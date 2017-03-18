<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 09/03/17
 * Time: 11:00 م
 */

    include_once ('Functions/inc.php');
    include_once ('Functions/Template.php');
    $settings = $db->table("settings")->select()->results();
    $templateDirectory = $db->table("settings")->where("name","=","template")->select(["id","value"])[0]->value;
    $template = new Template();
    foreach ($settings as $setting){
        eval("\$template->s_".$setting->name." = '".$setting->value."';");
    }
    $users = $db->table("users")->select()->results();
    $iser = Array();
    foreach ($users as $user){
        array_push($iser, array(
            "id"        => $user->id,
            "username"  => $user->username,
            "fullname"  => $user->fullname,
            "avatar"    => $user->avatar,
            "message"   => $user->message,
            "data"      => $user->data
        ));
    }

    $template->items = $iser ;
    $template->follow = "Follow";
    $template->report = "Report";

    $template->pages = false;
    $template->previous = "Previous";
    $template->next = "Next";

    $template->setFile('Templates/'.$templateDirectory.'/home.tpl')->setLayout('Templates/'.$templateDirectory.'/@main_layout.tpl')->render();
 ?>