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
        die("Error in Language File: ".$languageFile);
    }

    $template = new Template();
    foreach ($settings as $setting){
        eval("\$template->settings_".$setting->name." = '".$setting->value."';");
    }

    $template->rtl = $language->rtl;
    $template->language         = $language;
    $template->language_file    = $languageFile;
    $template->teplate_dir      = $templateDirectory;

    $template->lang = $language;
    global $template, $db, $language;