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
    $template = new Template();
    foreach ($settings as $setting){
        eval("\$template->".$setting->name." = '".$setting->value."';");
    }

    $template->theme_directory = $templateDirectory;
    $template->new_user = "New USER";
    $template->new_vip = "New VIP";

    global $template, $db;