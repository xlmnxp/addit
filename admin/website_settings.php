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
        'cp_username' => 'اسم المستخدم للوحة التحكم',
        'cp_password' => 'كلمة السر للوحة التحكم',
        'recaptcha_site_key' => 'مفتاح الموقع recaptcha',
        'recaptcha_secret_key' => 'مفتاح الحماية recaptcha',
        'addthis_pubid' => 'معرف addthis العام',
        'disqus_name' => 'اسم disqus'
    ];

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
                        <form role="form">
                            <?= $template->validate->key ?>
						    <div class="col-md-12">
                                <?php foreach ( $default as $key => $value) {
                                    if($key == 'cp_username' || $key == 'cp_password'){
                                        continue;
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label><?= $setting_key_filter[$key]; ?></label>
                                        <? if ($key == "report_message") {
                                            ?>
                                            <textarea class="form-control" name="<?= $key; ?>" placeholder="<?= $value; ?>" rows="3"><?= $value; ?></textarea>
                                            <?php
                                            }else{
                                          ?>
                                            <input class="form-control" type="text" name="<?= $key; ?>" placeholder="<?= $value; ?>" value="<?= $value; ?>"/>
                                            <?php
                                        } ?>
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
