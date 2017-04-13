<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 3/22/17
 * Time: 2:07 PM
 */

    //return;
    include_once ("global.php");
    $ifcon = $db->table("settings")->where("name","language")->select(["id","value"])[0]->value;
    if ($ifcon == "arabic"){
        $db->table("settings")->where("name","language")->update([
            "value" => "english"
        ]);
    }else{
        $db->table("settings")->where("name","language")->update([
            "value" => "arabic"
        ]);
    }
    header("location: /");