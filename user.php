<?php
/**

 * User: xlmnxp
 * Date: 3/21/17
 * Time: 4:06 PM
 */

    include_once ("global.php");
    global $db,$template,$templateDirectory,$default;

    $user                           = $db->table("users")->where("id",(@$_GET['id'] ? @$_GET['id'] : 1))->select()[0];
    $template->page                 = $user->fullname;

    $data                           = json_decode($user->data);
    $data->country_name             = getCountries()[$data->country];
    $data->country                  = mb_strtolower($data->country);

    $template->user                 = array(
                                        "id"        => $user->id,
                                        "username"  => htmlspecialchars($user->username),
                                        "fullname"  => $user->fullname,
                                        "avatar"    => (substr( $user->avatar, 0, 4 ) === "http" ? $user->avatar : $template->default["url"].$user->avatar),
                                        "message"   => $user->message,
                                        "data"      => $data,
                                        "sex"       => ($user->sex == 0? $language->male : $language->female),
                                        "url"       => $template->default["url"]."user/".$user->id."-".str_replace(" ","-",$user->fullname)
                                    );

    $template->default["page-title"] = $template->default["title"]." » $user->fullname ($user->username)";

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form                    = ob_get_clean();
    $template->search_form          = $search_form;

    $template->setFile($templateDirectory.'/user.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();

?>