<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 09/03/17
 * Time: 11:00 م
 */

    include_once ("global.php");
    global $db,$template,$language,$templateDirectory;
    $template->page = $language->home;

    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $page = $page <= 0 ? 1 : $page;


    $users_query = $db->table("users")->orderBy('id','desc')->limit(12*($page-1),12)->select();
    $users = Array();
    foreach ($users_query as $user){
        $data = json_decode($user->data);
        $data->country_name = getCountries()[$data->country];
        $data->country = mb_strtolower($data->country);

        array_push($users, array(
            "id"        => $user->id,
            "username"  => htmlspecialchars($user->username),
            "fullname"  => $user->fullname,
            "avatar"    => (substr( $user->avatar, 0, 4 ) === "http" ? $user->avatar : $template->default["url"].$user->avatar),
            "message"   => substr($user->message,0,150),
            "sex"   => ($user->sex == 0? $language->male : $language->female),
            "data"      => $data,
            "url"       => $template->default["url"]."u/".$user->id."-".str_replace(" ","-",$user->fullname)
        ));
    }

    $template->users    = $users;
    $template->pages = pagination(5,12,$db->table("users")->select(['id'])->count(),$page);

    $template->default["page-title"] = $template->default["title"]." | $language->home";

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form = ob_get_clean();

    $template->search_form = $search_form;

    $template->setFile($templateDirectory.'/home.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();