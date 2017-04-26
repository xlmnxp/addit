<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 3/18/17
 * Time: 8:08 PM
 */

    include_once ('Functions/inc.php');
    include_once ('Functions/Template.php');
    //error_reporting(2);

    $settings = $db->table("settings")->select()->results();
    $templateDirectory = $db->table("settings")->where("name","=","template")->select(["id","value"])[0]->value;
    $templateDirectory = "Templates/".$templateDirectory;
    $languageName = $db->table("settings")->where("name","=","language")->select(["id","value"])[0]->value;
    $languageFile = "Languages/".$languageName.".json";
    $language = json_decode(file_get_contents($languageFile));
    if(!$language){
        die("[Error] Language File: ".$languageFile);
    }

    $template = new Template();
    $requireDefault = "";
    foreach ($settings as $setting){
        $requireDefault .= ',"'.$setting->name.'" => "'.htmlentities($setting->value).'"';
    }
    $requireDefault[0] = "";
    $default;
    eval("\$template->default = array($requireDefault);");
    $default = $template->default;

    $template->default["page-title"] = $template->default["title"];


    $template->default["url"] = "http://".$_SERVER['SERVER_NAME']."/addit/";

    $template->rtl = $language->rtl;
    $template->language         = $language;
    $template->language_file    = $languageFile;
    $template->template_dir     = $template->default["url"].$templateDirectory;
    $template->lang = $language;
    $lang = $language;
    $template->addthis_pubid = "ra-58e0111c4be4cfd4";

    $template->header = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.css" />
        
        <script src="https://cdn.jsdelivr.net/clipboard.js/1.6.0/clipboard.min.js"></script>
        <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.js"></script>
    ';
    $template->footer = '
        <script>
            var cb = new Clipboard(\'.btn-copy\');
            
            cb.on(\'success\', function(e) {
                swal({
                  title: "'.$language->success.'!",
                  text: "'.$language->copied.'",
                  type: "success",
                  confirmButtonText: "'.$language->confirm.'"
                });

                e.clearSelection();
            });

        </script>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.$template->addthis_pubid.'"></script>

    ';

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form = ob_get_clean();
    $template->search_form = $search_form;

    global $template, $db, $language;
?>