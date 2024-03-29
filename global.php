<?php
/**

 * User: xlmnxp
 * Date: 3/18/17
 * Time: 8:08 PM
 */

    include_once ('Functions/inc.php');
    include_once ('Functions/Template.php');
    global $template, $db, $language;

    updateStatistics();

    $settings                       = $db->table("settings")->select()->results();
    $form                           = new formValidate();
    $templateDirectory              = $db->table("settings")->where("name","=","template")->select(["id","value"])[0]->value;
    $templateDirectory              = "Templates/".$templateDirectory;
    $languageName                   = '';

    $template = new Template();
    $requireDefault = "";
    foreach ($settings as $setting){
        $requireDefault             .= ',\''.$setting->name.'\' => "'.htmlentities($setting->value).'"';
    }
    $requireDefault                 = substr($requireDefault, 1);
    eval('$template->default = array('.$requireDefault.');');
    $default                        = $template->default;

    $template->default["page-title"]= $template->default["title"];

    // enable it on debug only!
    // $default['url']                 = $template->default["url"] =  "http://".$_SERVER['SERVER_NAME']."/addit/";

    if(isset($_POST["language"])){
        setcookie('language', ($_POST["language"]), time() + (86400 * 360), "/"); // 86400 = 1 day
        header('Location: '.$_SERVER['REQUEST_URI']);
    }

    if(isset($_COOKIE["language"])){
        setlanguage(htmlspecialchars($_COOKIE["language"]));
    }else{
        setlanguage("default");
    }

    $languageFile                   = ( isset($languageFile) ? $languageFile : "Languages/" ) . $languageName . ".json";
    $language                       = json_decode(file_get_contents($languageFile));
    if(!$language){
        setcookie('language', setlanguage("default"), time() + (86400 * 360), "/"); // 86400 = 1 day
        die("[Error] Language File: ".$languageFile);
    }

    $template->rtl                  = $language->rtl;
    $template->language             = $language;
    $template->language_file        = $languageFile;
    $template->template_dir         = $template->default["url"].$templateDirectory;
    $template->lang                 = $language;
    $template->addthis_pubid        = $default["addthis_pubid"];
    $template->grecaptcha_key       = $default['recaptcha_site_key'];
    $template->disqus_name          = $default["disqus_name"];
    $template->year                 = date("Y");

    $selectForm                      = "<form class='navbar-form' method='post' id='language_select'>";
    $selectForm                     .= "<select class='form-control' onchange='this.parentNode.submit()' name='language'>";
    $selectForm                     .= language_select();
    $selectForm                     .= "</select>";
    $selectForm                     .= "</form>";

    $template->language_select      = $selectForm;

    $template->search               = array(
                                        "value"     => "",
                                        "sex"       => -1,
                                        "category"   => -1,
                                        "country"   => -1
                                    );

    $template->validate             = json_decode(json_encode(array(
                                        "key" => $form->outputKey()
                                    )));

    $validate                       = $template->validate;
    $search                         = $template->search;
    $lang                           = $language;

    $search_sex                     = '
        <option value="0">'.$lang->male.'</option>
        <option value="1">'.$lang->female.'</option>
        ';

    $template->search_sex           = $search_sex;
    $template->is_search            = false;
    $template->search_get_request   = "";

    $categories                     = '';
    foreach (getCategories() as $value)
    {
        $categories                  .= "<option value='{$value->id}'>{$value->name}</option>\n";
    }

    $countries                      = '';
    foreach (getCountries() as $key => $value)
    {
        $countries                  .= "<option value='$key'>$value</option>\n";
    }

    $template->categories           = $categories;
    $template->countries            = $countries;

    $template->include_header       = '
        <link rel="stylesheet" href="'.$default['url'].'public/css/sweetalert2.min.css" />
        
        <script src="'.$default['url'].'public/javascript/clipboard.min.js"></script>
        <script src="'.$default['url'].'public/javascript/sweetalert2.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>';

    $template->include_footer       = '
        <script>
            var cb = new Clipboard(".btn-copy");
            
            cb.on("success", function(e) {
                swal({
                  title: "'.$lang->success.'!",
                  text: "'.$lang->copied.'",
                  type: "success",
                  confirmButtonText: "'.$lang->confirm.'"
                });

                e.clearSelection();
            });

        </script>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.$template->addthis_pubid.'" async defer></script>
        ';