<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 09/03/17
 * Time: 11:00 م
 */

    include_once ("global.php");
    $template->page = $language->home;

    $page = (@$_GET["page"]? $_GET["page"]:1);
    $users_query = $db->table("users")->limit(12*($page-1),12)->select();
    $users = Array();
    foreach ($users_query as $user){
        array_push($users, array(
            "id"        => $user->id,
            "username"  => htmlspecialchars($user->username),
            "fullname"  => $user->fullname,
            "avatar"    => (substr( $user->avatar, 0, 4 ) === "http" ? $user->avatar : $template->default["url"].$user->avatar),
            "message"   => $user->message,
            "data"      => $user->data,
            "url"       => $template->default["url"]."u/".$user->id."-".str_replace(" ","-",$user->fullname)
        ));
    }

    $template->users    = $users;
    $template->pages    = true;

    $template->previous = '';
    $template->next = '';

    $template->class_next = '';
    $template->class_previous = '';

    if(count($users_query->results()) >= 12){
        $next_page = $page+1;
        $template->next = "href=\"{$template->default["url"]}page/{$next_page}\"";
    }else{
        $template->class_next = 'class="disabled"';
    }

    if($page <= 1){
        $template->class_previous = 'class="disabled"';
    }else{
        $previous_page = $page-1;
        $template->previous = "href=\"{$template->default["url"]}page/{$previous_page}\"";
    }

    $template->default["page-title"] = $template->default["title"]." | $language->home";

    $template->setFile($templateDirectory.'/home.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
 ?>