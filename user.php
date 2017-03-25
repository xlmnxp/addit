<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 3/21/17
 * Time: 4:06 PM
 */

    include_once ("global.php");
    $user = $db->table("users")->where("id",(@$_GET['id'] ? @$_GET['id'] : 1))->select()[0];
    $template->page = $user->fullname;

    $template->user = array(
        "id"        => $user->id,
        "username"  => $user->username,
        "fullname"  => $user->fullname,
        "avatar"    => $user->avatar,
        "message"   => $user->message,
        "data"      => $user->data,
        "sex"       => $user->sex,
        "url"       => $template->settings_url."u/".$user->id."-".str_replace(" ","-",$user->fullname)
    );

    $template->disqus_name = "addit-1";

    $template->setFile($templateDirectory.'/user.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();

?>