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
    $requireDefault = "";
    foreach ($settings as $setting){
        $requireDefault .= ',\''.$setting->name.'\' => "'.htmlentities($setting->value).'"';
    }
    $requireDefault = substr($requireDefault, 1);
    eval('$template->default = array('.$requireDefault.');');
    $default = $template->default;

    $template->default["page-title"] = $template->default["title"];


    $template->default["url"] = "http://".$_SERVER['SERVER_NAME']."/addit/";

    $template->rtl = $language->rtl;
    $template->language         = $language;
    $template->language_file    = $languageFile;
    $template->template_dir     = $template->default["url"].$templateDirectory;
    $template->lang             = $language;
    $template->addthis_pubid    = "ra-58e0111c4be4cfd4";
    $template->disqus_name      = "addit-1";

    $template->search           = array(
                                    "value"    =>  "",
                                    "sex"       => -1
                                    );

    $search                     = $template->search;
    $lang                       = $language;

    $search_sex = '
        <option value="0">{$lang->male}</option>
        <option value="1">{$lang->female}</option>
        ';

    $template->header = '
        <link rel="stylesheet" href="'.$default['url'].'/global-templates/css/sweetalert2.min.css" />
        
        <script src="'.$default['url'].'/global-templates/javascript/clipboard.min.js"></script>
        <script src="'.$default['url'].'/global-templates/javascript/sweetalert2.min.js"></script>
        ';
    
    $template->footer = '
        <script>
            var cb = new Clipboard(\'.btn-copy\');
            
            cb.on(\'success\', function(e) {
                swal({
                  title: "'.$lang->success.'!",
                  text: "'.$lang->copied.'",
                  type: "success",
                  confirmButtonText: "'.$lang->confirm.'"
                });

                e.clearSelection();
            });

        </script>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.$template->addthis_pubid.'"></script>
        ';

    global $template, $db, $language;
?>