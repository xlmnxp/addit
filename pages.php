<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 4/4/17
 * Time: 1:14 AM
 */
    include_once("global.php");
    $queryFile = $db->table("pages")->where("name",$_GET["name"])->select()[0];
    $lang = $language;
    $default = $template->default;
    $template->page = eval('return "'.$queryFile->title.'";');
    $template->default["page-title"] = $template->default["title"]." | ".eval('return "'.$queryFile->title.'";');
    if(!$queryFile){
        header("location: {$default["url"]}404");
    }
    $template->setFile(
        '<ol class="breadcrumb" xmlns="http://www.w3.org/1999/html">
            <li><a href="{$default["url"]}">{$lang->home}</a></li>
            <li class="active">{$page}</li>
        </ol>
        {$search_form}
        '
        .$queryFile->template)->setLayout($templateDirectory.'/@main_layout.tpl')->render(true);
?>