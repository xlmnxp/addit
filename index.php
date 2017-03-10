<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 09/03/17
 * Time: 11:00 م
 */

    include_once ('Functions/inc.php');
    include_once ('Functions/Template.php');
    $settings = $db->table("settings")->select()->results();
    $templateDirectory = $db->table("settings")->where("name","=","template")->select(["id","value"])[0]->value;
    $template = new Template();
    foreach ($settings as $setting){
        $template->assign( 's-'.$setting->name, $setting->value);
    }
    $template->parse( 'Templates/'.$templateDirectory.'/Header.tpl' );
    $template->assign( 'items', array( array( 'name' => 'First' ), array( 'name' => 'Second' ) ) )
             ->parse( 'Templates/'.$templateDirectory.'/index.tpl' );
    $template->parse( 'Templates/'.$templateDirectory.'/Footer.tpl' );
    ?>