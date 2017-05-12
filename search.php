<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 4/23/17
 * Time: 12:12 AM
 */

    include_once ("global.php");
    $template->page = $language->search;
    $nPOST = json_decode(json_encode($_POST));
    if((!isset($_POST['search']) || !isset($_POST['sex']) || !isset($_POST['category']) || !isset($_POST['country']))){
        if(!isset($_COOKIE['search'])){
            header('location: '.$template->default['url']);
        }else{
            $nPOST = json_decode($_COOKIE['search']);
        }
    }else{
        if(isset($_POST)) {
            setcookie('search', json_encode($_POST), time() + (86400 * 7), "/"); // 86400 = 1 day
        }
    }
    $nPOST->search = htmlspecialchars($nPOST->search, ENT_QUOTES, 'UTF-8');
    $nPOST->sex = htmlspecialchars($nPOST->sex, ENT_QUOTES, 'UTF-8');

    $template->search["value"] = $nPOST->search;
    $template->search["sex"] = $nPOST->sex;
    $search = $template->search;

    $page = (isset($_GET["page"])? $_GET["page"]:1);
    $users_query = $db->table("users");
    $users_query
        ->where('username','LIKE','%'.$nPOST->search.'%')
        ->orWhere('fullname','LIKE','%'.$nPOST->search.'%')
        ->orWhere('message','LIKE','%'.$nPOST->search.'%')
        ->where('sex',$nPOST->sex)
        ->limit(12*($page-1),12)->select();
    $users = Array();
    foreach ($users_query as $user){
        array_push($users, array(
            "id"        => $user->id,
            "username"  => htmlspecialchars($user->username),
            "fullname"  => $user->fullname,
            "avatar"    => (substr( $user->avatar, 0, 4 ) === "http" ? $user->avatar : $template->default["url"].$user->avatar),
            "message"   => $user->message,
            "sex"   => ($user->sex == 0? $language->male : $language->female),
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
        $template->next = "href=\"{$template->default["url"]}search?page={$next_page}\"";
    }else{
        $template->class_next = 'class="disabled"';
    }

    if($page <= 1){
        $template->class_previous = 'class="disabled"';
    }else{
        $previous_page = $page-1;
        $template->previous = "href=\"{$template->default["url"]}search?page={$previous_page}\"";
    }

    $template->default["page-title"] = $template->default["title"]." | $language->search";

    $search_sex = "<option value=\"0\" ".($nPOST->sex==0?'selected':'').">{$lang->male}</option>"
                 ."<option value=\"1\" ".($nPOST->sex==1?'selected':'').">{$lang->female}</option>";
    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form = ob_get_clean();
    $template->search_form = $search_form;

    $template->setFile($templateDirectory.'/home.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();