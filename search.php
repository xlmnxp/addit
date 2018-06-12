<?php
/**

 * User: xlmnxp
 * Date: 4/23/17
 * Time: 12:12 AM
 */

    include_once ("global.php");
    global $db, $template, $language, $templateDirectory, $default;

    $template->page                 = $language->search;
    $template->is_search            = true;
    $template->search_get_request   = http_build_query($_GET);
    $nGET = json_decode(json_encode($_GET));
    
    if(!isset($_GET['q'])){
        header('location: '.$template->default['url']);
    }
    
    $nGET->search                   = htmlspecialchars($nGET->q || '', ENT_QUOTES, 'UTF-8');
    $nGET->sex                      = htmlspecialchars($nGET->s || -1, ENT_QUOTES, 'UTF-8');
    $nGET->category                 = htmlspecialchars($nGET->cat || -1, ENT_QUOTES, 'UTF-8');
    $nGET->country                  = htmlspecialchars($nGET->cou || -1, ENT_QUOTES, 'UTF-8');

    if(!($nGET->sex == -1 OR $nGET->sex == 0 OR $nGET->sex == 1)){
        $nGET->sex                  = -1;
    }

    $template->search["value"]      = $nGET->search;
    $template->search["sex"]        = $nGET->sex;
    $template->search["category"]   = $nGET->category;
    $template->search["country"]    = $nGET->country;
    $search                         = $template->search;

    $page                           = isset($_GET["page"]) ? $_GET["page"] : 1;
    $page                           = $page <= 0 ? 1 : $page;

    $userSearch = [
        [
            'username', 'LIKE', '%'.$nGET->search.'%'
        ],
        'Or' => [
            'message', 'LIKE', '%'.$nGET->search.'%'
        ],
        'OR' => [
            'fullname', 'LIKE', '%'.$nGET->search.'%'
        ]
    ];

    $users_query = $db->table("users");
    if($nGET->sex != -1){
        $users_query                = $users_query->where('sex',$nGET->sex);
    }else{
        $users_query                = $users_query->where('sex', "LIKE", '%%');
    }

    if($nGET->country != -1){
        $users_query                = $users_query->where('data','LIKE',"%\"country\":\"". mb_strtolower($nGET->country) ."\"%");
    }else{
        $users_query                = $users_query->where('data', "LIKE", '%%');
    }

    $users_query                    = $users_query->parseWhere($userSearch)->orderBy('`id`','DESC')->limit(12*($page-1),12)->select();


    $users = Array();
    foreach ($users_query as $user){
        $data = json_decode($user->data);
        $data->country_name = getCountries()[$data->country];
        $data->country = mb_strtolower($data->country);

        array_push($users, array(
            "id"        => $user->id,
            "username"  => substr(htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'),0,50),
            "fullname"  => $user->fullname,
            "avatar"    => (substr( $user->avatar, 0, 4 ) === "http" ? $user->avatar : $template->default["url"].$user->avatar),
            "message"   => substr(htmlspecialchars($user->message, ENT_QUOTES, 'UTF-8'),0,150),
            "sex"       => ($user->sex == 0? $language->male : $language->female),
            "data"      => $data,
            "url"       => $template->default["url"]."user/".$user->id."-".urlencode(str_replace(" ","-",$user->fullname))
        ));
    }

    $template->users    = $users;
    
    $search_count = $db->table("users");
    if($nGET->sex != -1){
        $search_count               = $users_query->where('sex',$nGET->sex);
    }else{
        $search_count               = $users_query->where('sex', "LIKE", '%%');
    }

    if($nGET->country != -1){
        $search_count               = $users_query->where('data','LIKE',"%\"country\":\"$nGET->country\"%");
    }else{
        $search_count               = $users_query->where('data', "LIKE", '%%');
    }

    $search_count                   = $search_count->parseWhere($userSearch)->orderBy('id','desc')->select(["id"])->count();

    $template->pages                = pagination(5,12,$search_count,$page);

    $template->default["page-title"] = $template->default["title"]." » $language->search";

    $search_sex                     = "<option value=\"0\" ".($nGET->sex==0?'selected':'').">{$language->male}</option>"
                                    ."<option value=\"1\" ".($nGET->sex==1?'selected':'').">{$language->female}</option>";
    
    $countries = '';

    foreach (getCountries() as $key => $value)
    {
        $countries                  .= "<option value='$key' ".($nGET->country==$key?'selected':'').">$value</option>\n";
    }

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form                    = ob_get_clean();
    $template->search_form          = $search_form;

    $template->setFile($templateDirectory.'/home.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
