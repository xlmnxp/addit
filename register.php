<?php
/**

 * User: xlmnxp
 * Date: 09/03/17
 * Time: 11:00 م
 */

    include_once ("global.php");
    global $db, $template, $language, $templateDirectory, $default, $form;

    $template->page = $language->new_user;

    if(isset($_POST["submit"])){
            $errors = array();
            $file = $_FILES['avatar'];
            $file_name  = $file['name'];
            $file_size  = $file['size'];
            $file_tmp   = $file['tmp_name'];
            $file_type  = $file['type'];
            $tmp_ext    = explode('.',$file['name']);
            $file_ext   = strtolower(end($tmp));
            $dir        = "Uploads/".uniqid("img_").".".$file_ext;
            $expensions = array("jpeg","jpg","png");

            if(!isset($_POST['form_key']) || !$form->validate()){
                $errors[]= $language->error_validate_key;
            }

            if(in_array($file_ext,$expensions)=== false){
                $errors[]= $language->help_avatar;
            }

            if($file_size > 2097152){
                $errors[]= $language->size_avatar .'2'. $language->mb;
            }

            if(!isset($_POST['g-recaptcha-response']) || !recaptcha_vaild($default['recaptcha_secret_key'])){
                $errors[]= 'recaptcha ' . $language->error_validate_key;
            }

            if(!trim($_POST['username'])){
                $errors[]= $language->enter_username;
            }
            if(!trim($_POST['fullname'])){
                $errors[]= $language->enter_fullname;
            }

            if(strlen(htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8')) > 450){
                $errors[]= $language->message_length;
            }
            if(empty($errors)){
                if(move_uploaded_file($file_tmp,$dir)){
                    chmod($dir, 0755);
                    $db->table("users")->insert([
                        "username"  => htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8'),
                        "fullname"  => htmlspecialchars($_POST["fullname"], ENT_QUOTES, 'UTF-8'),
                        "avatar"    => $dir,
                        "message"   => htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8'),
                        "sex"       => htmlspecialchars($_POST["sex"], ENT_QUOTES, 'UTF-8'),
                        "data"      => json_encode(array(
                            "category" => htmlspecialchars($_POST["category"], ENT_QUOTES, 'UTF-8'),
                            "country"  => mb_strtolower(htmlspecialchars($_POST["country"], ENT_QUOTES, 'UTF-8'))
                        ))
                    ]);
                    $template->success = true;
                }
            }else{
                $template->success = false;
                $template->errors = $errors;
            }

    }

    $template->default["page-title"] = $template->default["title"]." » $language->new_user";

    ob_start();
    eval ('?> '.$template->compile(file_get_contents($template->template_dir."/search_form.tpl"),true));
    $search_form = ob_get_clean();
    $template->search_form = $search_form;

    $template->setFile($templateDirectory.'/register.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();