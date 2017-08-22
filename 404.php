<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 8/22/17
 * Time: 12:36 PM
 */

    include_once ("global.php");
    global $db,$template, $language,$templateDirectory,$default;

    $template->page = $language->page_not_found;

    $template->default["page-title"] = $template->default["title"]." | $language->page_not_found";

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form = ob_get_clean();
    $template->search_form = $search_form;

    $template->setFile($templateDirectory.'/404.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();