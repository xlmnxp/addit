<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 9/17/17
 * Time: 7:02 PM
 */
    $page = 'admin_settings';
    include_once ('header.php');
    global $db, $form, $default, $template, $language;

    $setting_key_filter = [
        'cp_username' => 'اسم المستخدم للوحة التحكم',
        'cp_password' => 'كلمة السر للوحة التحكم'
    ];

    $admin_account = array(
        'cp_username' => $default['cp_username'],
        'cp_password' => $default['cp_password']
    );

    $errors = array();
    $success = false;
    if(isset($_POST['submit'])){
        if(!isset($_POST['form_key']) || !$form->validate()){
            $errors[] = $language->error_validate_key;
        }

        if(empty($_POST['cp_username']) || empty($_POST['cp_password']) || !isset($_POST['cp_username']) || !isset($_POST['cp_password'])){
            $errors[] = $language->empty_field;
        }else{
            $db->table('settings')->where('name','cp_username')->update([
                "value" => $_POST['cp_username']
            ]);
            $db->table('settings')->where('name','cp_password')->update([
                "value" => md5($_POST['cp_password'])
            ]);

            $success = true;
        }
    }

    ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li>الإعدادات</li>
            <li class="active">حساب الإداري</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">اعدادات حساب الإداري</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">اعدادات الموقع</div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <?php if($success == true){ ?>
                            <div class="alert alert-success" role="alert"><strong><?php echo $language->success; ?></strong></div>
                        <?php }else if(count($errors)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?php foreach (@$errors as $error){ ?>
                                    <span class="fa fa-exclamation-circle" aria-hidden="true"></span>
                                    <?php echo $error; ?><br>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?= $template->validate->key ?>
                        <div class="col-md-12">
                            <?php foreach ( $admin_account as $key => $value) { ?>
                                <div class="form-group">
                                    <label><?= $setting_key_filter[$key]; ?></label>
                                    <input class="form-control" type="<?= ($key != 'cp_password') ? 'text' : 'password'; ?>" name="<?= $key ?>" placeholder="<?=($key != 'cp_password') ? $value : 'كلمة السر'; ?>" value="<?= $value ?>"/>
                                </div>
                            <?php }?>
                            <button class="btn btn-primary" type="submit" name="submit"><svg class="glyph stroked pencil" style="height: 20px; width: 20px;"><use xlink:href="#stroked-pencil"/></svg>&nbsp;<?= $language->edit ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->
<?php include_once ('footer.php') ?>
