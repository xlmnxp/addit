<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 4/23/17
 * Time: 12:12 AM
 */

    include_once ("global.php");
    global $db,$template,$templateDirectory,$default;

    $template->page = $language->search;
    $nPOST = json_decode(json_encode($_POST));
    if((!isset($_POST['search']) || !isset($_POST['sex']) || !isset($_POST['category']) || !isset($_POST['country']))){
        if(!isset($_SESSION['search'])){
            header('location: '.$template->default['url']);
        }else{
            $nPOST = json_decode($_SESSION['search']);
        }
    }else{
        if(isset($_POST)) {
            $_SESSION['search'] = json_encode($_POST);
        }
    }
    $nPOST->search = htmlspecialchars($nPOST->search, ENT_QUOTES, 'UTF-8');
    $nPOST->sex = htmlspecialchars($nPOST->sex, ENT_QUOTES, 'UTF-8');

    if(!($nPOST->sex == -1 OR $nPOST->sex == 0 OR $nPOST->sex == 1)){
        $nPOST->sex = -1;
    }
    $template->search["value"] = $nPOST->search;
    $template->search["sex"] = $nPOST->sex;
    $search = $template->search;

    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $page = $page <= 0 ? 1 : $page;

    $userSearch = [
        [
            'username', 'LIKE', '%'.$nPOST->search.'%'
        ],
        'Or' => [
            'message', 'LIKE', '%'.$nPOST->search.'%'
        ],
        'OR' => [
            'fullname', 'LIKE', '%'.$nPOST->search.'%'
        ]
    ];

    $users_query = $db;

    if($nPOST->sex != -1){
        $users_query = $users_query->table("users")
            ->where('sex',$nPOST->sex)->parseWhere($userSearch);
    }else{
        $users_query = $users_query->table("users")
            ->where('sex', "LIKE", '%%')->parseWhere($userSearch);
    }

    $users_query = $users_query->orderBy('`id`','DESC')->limit(12*($page-1),12)->select();


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

    if($nPOST->sex != -1){
        $search_count = $db->table("users")
            ->where('sex',$nPOST->sex)->parseWhere($userSearch);
    }else{
        $search_count = $db->table("users")
            ->where('sex', "LIKE", '%%')->parseWhere($userSearch);
    }

    $search_count = $search_count->orderBy('id','desc')->select(["id"])->count();
    $template->pages = pagination(10,12,$search_count,$page);

    $template->default["page-title"] = $template->default["title"]." | $language->search";

    $search_sex = "<option value=\"0\" ".($nPOST->sex==0?'selected':'').">{$language->male}</option>"
        ."<option value=\"1\" ".($nPOST->sex==1?'selected':'').">{$language->female}</option>";
    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form = ob_get_clean();
    $template->search_form = $search_form;

    $template->setFile($templateDirectory.'/home.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
