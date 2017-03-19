<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 09/03/17
 * Time: 11:00 م
 */

    include_once ("global.php");
    $template->page = $language->home;
    $users_query = $db->table("users")->select()->results();
    $users = Array();
    foreach ($users_query as $user){
        array_push($users, array(
            "id"        => $user->id,
            "username"  => $user->username,
            "fullname"  => $user->fullname,
            "avatar"    => $user->avatar,
            "message"   => $user->message,
            "data"      => $user->data
        ));
    }

    $template->items    = $users ;
    $template->pages    = true;

    $template->setFile($templateDirectory.'/home.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
 ?>