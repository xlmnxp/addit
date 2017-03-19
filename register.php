<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 09/03/17
 * Time: 11:00 م
 */

    include_once ("global.php");
    $template->page = $language->new_user;


    $template->setFile($templateDirectory.'/register.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
?>