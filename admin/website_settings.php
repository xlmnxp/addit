<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 9/17/17
 * Time: 7:02 PM
 */
    $page = 'website_settings';
    include_once ('header.php');
    global $db, $default, $template, $language;

    $setting_key_filter = [
        'title' => 'عنوان الموقع',
        'template' => 'قالب',
        'url' => 'رابط الموقع مع \'/\' في الأخير',
        'language' => 'اللغة الافتراضية للموقع',
        'report_message' => 'رسالة التبليغ',
        'recaptcha_site_key' => 'مفتاح الموقع recaptcha',
        'recaptcha_secret_key' => 'مفتاح الحماية recaptcha',
        'addthis_pubid' => 'معرف addthis العام',
        'disqus_name' => 'اسم disqus'
    ];

    $errors = array();
    $success = false;
    if(isset($_POST['submit'])){
        if(!isset($_POST['form_key']) || !$form->validate()){
            $errors[] = $language->error_validate_key;
        }

        if(empty($_POST['title']) || empty($_POST['template']) ||
            empty($_POST['url']) || empty($_POST['language']) ||
            empty($_POST['report_message']) || empty($_POST['recaptcha_site_key']) ||
            empty($_POST['recaptcha_secret_key']) || empty($_POST['addthis_pubid']) ||
            empty($_POST['disqus_name']) || !isset($_POST['title']) || !isset($_POST['template']) ||
            !isset($_POST['url']) || !isset($_POST['language']) ||
            !isset($_POST['report_message']) || !isset($_POST['recaptcha_site_key']) ||
            !isset($_POST['recaptcha_secret_key']) || !isset($_POST['addthis_pubid']) ||
            !isset($_POST['disqus_name'])
        ){
            $errors[] = $language->empty_field;
        }else{
            $db->table('settings')->where('name','title')->update([
                "value" => $_POST['title']
            ]);

            $db->table('settings')->where('name','template')->update([
                "value" => $_POST['template']
            ]);

            $db->table('settings')->where('name','url')->update([
                "value" => $_POST['url']
            ]);

            $db->table('settings')->where('name','language')->update([
                "value" => $_POST['language']
            ]);

            $db->table('settings')->where('name','report_message')->update([
                "value" => $_POST['report_message']
            ]);

            $db->table('settings')->where('name','recaptcha_site_key')->update([
                "value" => $_POST['recaptcha_site_key']
            ]);

            $db->table('settings')->where('name','recaptcha_secret_key')->update([
                "value" => $_POST['recaptcha_secret_key']
            ]);

            $db->table('settings')->where('name','addthis_pubid')->update([
                "value" => $_POST['addthis_pubid']
            ]);

            $db->table('settings')->where('name','disqus_name')->update([
                "value" => $_POST['disqus_name']
            ]);
            $success = true;
        }
    }

    ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li>إعدادات</li>
				<li class="active">الموقع</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">إعدادات الموقع</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">إعدادات الموقع</div>
					<div class="panel-body">
                        <form role="form" method="post">
                            <?php if($success == true){ ?>
                                <div class="alert alert-success" role="alert"><strong><?php echo $language->success; ?></strong></div>
                            <?php }else if(count($errors) != 0){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php foreach (@$errors as $error){ ?>
                                        <span class="fa fa-exclamation-circle" aria-hidden="true"></span>
                                        <?php echo $error; ?><br>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?= $template->validate->key ?>
						    <div class="col-md-12">
                                <?php foreach ( $default as $key => $value) {
                                    if($key == 'cp_username' || $key == 'cp_password'){
                                        continue;
                                    } ?>

                                    <div class="form-group">
                                        <label><?= $setting_key_filter[$key]; ?></label>
                                        <?php if($key == "template"){ ?>
                                            <select class="form-control" name="template">
                                                <?php echo template_select(); ?>
                                            </select>
                                        <?php } else if($key == "language"){ ?>
                                            <select class="form-control" name="language">
                                                <?php echo language_select("../"); ?>
                                            </select>
                                        <?php } else if ($key == "report_message") { ?>
                                            <textarea class="form-control" name="<?= $key; ?>" placeholder="<?= $value; ?>" rows="3"><?= $value; ?></textarea>
                                        <?php }else{ ?>
                                            <input class="form-control" type="text" name="<?= $key; ?>" placeholder="<?= $value; ?>" value="<?= $value; ?>"/>
                                            <?php
                                        } ?>
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
