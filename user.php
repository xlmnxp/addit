<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 3/21/17
 * Time: 4:06 PM
 */

    include_once ("global.php");
    $user = $db->table("users")->where("id","=",@$_GET['id'])->select()->results()[0];
    $template->page = $user->fullname;

    $template->user    = $user;
    $template->setFile($templateDirectory.'/user.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();

?>