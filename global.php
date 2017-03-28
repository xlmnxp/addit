<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 3/18/17
 * Time: 8:08 PM
 */

    include_once ('Functions/inc.php');
    include_once ('Functions/Template.php');
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
    foreach ($settings as $setting){
        eval("\$template->settings_".$setting->name." = '".$setting->value."';");
    }

    $template->settings_url = "http://".$_SERVER['SERVER_NAME']."/addit/";

    $template->rtl = $language->rtl;
    $template->language         = $language;
    $template->language_file    = $languageFile;
    $template->template_dir     = $templateDirectory;
    $template->lang = $language;

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
                  title: "'.$template->lang->success.'!",
                  text: "'.$template->lang->copied.'!",
                  type: "success",
                  confirmButtonText: "'.$template->lang->confirm.'"
                });

                e.clearSelection();
            });

        </script>
    ';

    global $template, $db, $language;