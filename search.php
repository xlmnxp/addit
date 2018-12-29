<?php
/**

 * User: xlmnxp
 * Date: 4/23/17
 * Time: 12:12 AM
 */

    include_once ("global.php");
    global $db, $template, $language, $templateDirectory, $default;

    $template->page                 = $language->search;
    $temp_get                       = json_decode(json_encode($_GET));
    
    $template->is_search            = true;
    
    if(isset($_GET['page'])){
        unset($_GET['page']);
    }

    $template->search_get_request   = http_build_query(array_filter($_GET, function($value) {
            return $value != -1;
        }));

    if(!isset($_GET['q'])){
        header('location: '.$template->default['url']);
    }

    $temp_get->search                   = htmlspecialchars(!isset($temp_get->q) ? -1 : $temp_get->q, ENT_QUOTES, 'UTF-8');
    $temp_get->sex                      = htmlspecialchars(!isset($temp_get->s) ? -1 : $temp_get->s, ENT_QUOTES, 'UTF-8');
    $temp_get->category                 = htmlspecialchars(!isset($temp_get->cat) ? -1 : $temp_get->cat, ENT_QUOTES, 'UTF-8');
    $temp_get->country                  = htmlspecialchars(!isset($temp_get->cou) ? -1 : $temp_get->cou, ENT_QUOTES, 'UTF-8');

    if(!($temp_get->sex == -1 OR $temp_get->sex == 0 OR $temp_get->sex == 1)){
        $temp_get->sex                  = -1;
    }

    if(!($temp_get->category == -1 OR $temp_get->category == 0 OR $temp_get->category == 1)){
        $temp_get->sex                  = -1;
    }

    if(!($temp_get->country == -1 OR $temp_get->country == 0 OR $temp_get->country == 1)){
        $temp_get->sex                  = -1;
    }

    $template->search["value"]      = $temp_get->search;
    $template->search["sex"]        = $temp_get->sex;
    $template->search["category"]   = $temp_get->category;
    $template->search["country"]    = $temp_get->country;
    $search                         = $template->search;

    $page                           = isset($temp_get->page) ? $temp_get->page : 1;
    $page                           = $page <= 0 ? 1 : $page;

    $userSearch = [
        [
            'username', 'LIKE', '%'.$temp_get->search.'%'
        ],
        'Or' => [
            'message', 'LIKE', '%'.$temp_get->search.'%'
        ],
        'OR' => [
            'fullname', 'LIKE', '%'.$temp_get->search.'%'
        ]
    ];

    $users_query = $db->table("users");
    if($temp_get->sex != -1){
        $users_query                = $users_query->where('sex',$temp_get->sex);
    }else{
        $users_query                = $users_query->where('sex', "LIKE", '%%');
    }

    if($temp_get->country != -1){
        $users_query                = $users_query->where('country', $temp_get->country);
    }

    if($temp_get->category != -1){
        $users_query                = $users_query->where('category', $temp_get->category);
    }

    $users_query                    = $users_query->parseWhere($userSearch)->orderBy('`id`','DESC')->limit(12*($page-1),12)->select();


    $users = Array();
    foreach ($users_query as $user){
        $data = json_decode($user->data);

        array_push($users, array(
            "id"            => $user->id,
            "username"      => substr(htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'),0,50),
            "fullname"      => $user->fullname,
            "avatar"        => (substr( $user->avatar, 0, 4 ) === "http" ? $user->avatar : $template->default["url"].$user->avatar),
            "message"       => substr(htmlspecialchars($user->message, ENT_QUOTES, 'UTF-8'),0,150),
            "sex"           => ($user->sex == 0? $language->male : $language->female),
            "country_name"  => mb_strtolower(getCountries()[$user->country]),
            "country"       => mb_strtolower($user->country),
            "category"      => $user->category,
            "data"          => $data,
            "url"           => $template->default["url"]."user/".$user->id."-".urlencode(str_replace(" ","-",$user->fullname))
        ));
    }

    $template->users    = $users;
    
    $search_count = $db->table("users");
    if($temp_get->sex != -1){
        $search_count               = $users_query->where('sex',$temp_get->sex);
    }else{
        $search_count               = $users_query->where('sex', "LIKE", '%%');
    }

    if($temp_get->country != -1){
        $users_query                = $users_query->where('country', $temp_get->country);
    }

    if($temp_get->category != -1){
        $users_query                = $users_query->where('category', $temp_get->category);
    }

    $search_count                   = $search_count->parseWhere($userSearch)->orderBy('id','desc')->select(["id"])->count();

    $template->pages                = pagination(5, 12, $search_count, $page, $template->search_get_request);

    $template->default["page-title"] = $template->default["title"]." » $language->search";

    $search_sex                     = "<option value=\"0\" ".($temp_get->sex==0?'selected':'').">{$language->male}</option>"
                                    ."<option value=\"1\" ".($temp_get->sex==1?'selected':'').">{$language->female}</option>";
    
    $countries                      = '';
    foreach (getCountries() as $key => $value)
    {
        $countries                  .= "<option value='$key' ".($temp_get->country==$key?'selected':'').">$value</option>\n";
    }

    $categories                     = '';
    foreach (getCategories() as $value)
    {
        $categories                  .= "<option value='{$value->id}' ".($temp_get->category==$value->id?'selected':'').">{$value->name}</option>\n";
    }

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form                    = ob_get_clean();
    $template->search_form          = $search_form;

    $template->setFile($templateDirectory.'/home.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
