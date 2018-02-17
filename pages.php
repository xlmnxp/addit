<?php
/**

 * User: xlmnxp
 * Date: 4/4/17
 * Time: 1:14 AM
 */
    include_once("global.php");
    global $db, $template, $templateDirectory, $default, $language;

    $queryFile = $db->table("pages")->where("name",$_GET["name"])->select()[0];
    $lang = $language;
    $default = $template->default;
    $template->page = eval('return "'.$queryFile->title.'";');
    $template->default["page-title"] = $template->default["title"]." » ".eval('return "'.$queryFile->title.'";');
    if(!$queryFile){
        header("location: {$default["url"]}404");
    }

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form = ob_get_clean();
    $template->search_form = $search_form;

    $template->setFile(
        "<ol class='breadcrumb' xmlns='http://www.w3.org/1999/html'>
            <li><a href='{\$default[\"url\"]}'>{\$lang->home}</a></li>
            <li class='active'>{\$page}</li>
        </ol>
        {\$search_form}
        <div class=\"col-sm-12\">"
        .$queryFile->template
        ."</div>")->setLayout($templateDirectory.'/@main_layout.tpl')->render(true);
?>