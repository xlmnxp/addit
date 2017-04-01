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
        "username"  => htmlspecialchars($user->username),
        "fullname"  => $user->fullname,
        "avatar"    => (substr( $user->avatar, 0, 4 ) === "http" ? $user->avatar : $template->default["url"].$user->avatar),
        "message"   => $user->message,
        "data"      => $user->data,
        "sex"       => $user->sex,
        "url"       => $template->default["url"]."u/".$user->id."-".str_replace(" ","-",$user->fullname)
    );

    $template->disqus_name = "addit-1";

    $template->default["page-title"] = $template->default["title"]." | $user->fullname ($user->username)";

    $template->setFile($templateDirectory.'/user.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();

?>