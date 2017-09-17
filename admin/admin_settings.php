<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 9/17/17
 * Time: 7:02 PM
 */
    $page = 'admin_settings';
    include_once ('header.php');
    global $db, $default, $template, $language;

    $setting_key_filter = [
        'cp_username' => 'اسم المستخدم للوحة التحكم',
        'cp_password' => 'كلمة السر للوحة التحكم'
    ];

    $admin_account = array(
        'cp_username' => $default['cp_username'],
        'cp_password' => $default['cp_password']
    );

    ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li>إعدادات</li>
            <li class="active">حساب الإداري</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">إعدادات حساب الإداري</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">إعدادات الموقع</div>
                <div class="panel-body">
                    <form role="form">
                        <?= $template->validate->key ?>
                        <div class="col-md-12">
                            <?php foreach ( $admin_account as $key => $value) { ?>
                                <div class="form-group">
                                    <label><?= $setting_key_filter[$key]; ?></label>
                                    <input class="form-control" type="<?= ($key != 'cp_password') ? 'text' : 'password'; ?>" name="<?= $key ?>" placeholder="<?=($key != 'cp_password') ? $value : 'كلمة السر'; ?>" value="<?= $value ?>"/>
                                </div>
                            <?php }?>
                            <input class="btn btn-primary" type="submit" value="<?= $language->submit ?>" />

                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->
<?php include_once ('footer.php') ?>
