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
                        "username"  => $_POST["username"],
                        "fullname"  => $_POST["fullname"],
                        "avatar"    => $dir,
                        "message"   => $_POST["message"],
                        "sex"       => $_POST["sex"],
                        "data"      => json_encode(array([
                            "category" => $_POST["category"],
                            "country"  => $_POST["country"]
                        ]))
                    ]);
                    $language->dosuccess = true;
                }
            }else{
                $language->dosuccess = false;
                $template->errors = $errors;
            }

    }

    $template->default["page-title"] = $template->default["title"]." | $language->new_user";

    $template->setFile($templateDirectory.'/register.tpl')->setLayout($templateDirectory.'/@main_layout.tpl')->render();
?>