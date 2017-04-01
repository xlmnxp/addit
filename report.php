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

    $template->default["page-title"] = $template->default["title"]." | $language->report ($user->username)";

$template->setFile($templateDirectory.'/report.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
?>