<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 09/03/17
 * Time: 11:00 م
 */

    include_once ("global.php");
    $template->page = $language->new_user;

    if(isset($_POST["submit"])){
            $errors= array();
            $file = $_FILES['avatar'];
            $file_name  = $file['name'];
            $file_size  = $file['size'];
            $file_tmp   = $file['tmp_name'];
            $file_type  = $file['type'];
            $file_ext=strtolower(end(explode('.',$file['name'])));
            $dir = "Uploads/".round(microtime(true)).".".$file_ext;
            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false){
                $errors[]= $language->help_avatar;
            }

            if($file_size > 2097152){
                $errors[]= $language->file_ecu .'2'. $language->mb;
            }



            if(!trim($_POST['username'])){
                $errors[]= $language->enter_username;
            }
            if(!trim($_POST['fullname'])){
                $errors[]= $language->enter_fullname;
            }

            if(empty($errors)==true){
                if(move_uploaded_file($file_tmp,$dir)){
                    chmod($dir, 0755);
                    $db->table("users")->insert([
                        "id" => "",
                        "username"  => htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8'),
                        "fullname"  => htmlspecialchars($_POST["fullname"], ENT_QUOTES, 'UTF-8'),
                        "avatar"    => $dir,
                        "message"   => htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8'),
                        "sex"       => htmlspecialchars($_POST["sex"], ENT_QUOTES, 'UTF-8'),
                        "data"      => json_encode(array([
                            "category" => htmlspecialchars($_POST["category"], ENT_QUOTES, 'UTF-8'),
                            "country"  => htmlspecialchars($_POST["country"], ENT_QUOTES, 'UTF-8')
                        ]))
                    ]);
                    $template->success = true;
                }
            }else{
                $template->success = false;
                $template->errors = $errors;
            }

    }

    $template->default["page-title"] = $template->default["title"]." | $language->new_user";

    $template->setFile($templateDirectory.'/register.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
?>