<?php
$noheader = true;
include_once ('header.php');
global $default, $language, $form, $template;

$errors = [];
if(isset($_POST['submit'])){

    if(!isset($_POST['form_key']) || !$form->validate()){
        $errors[]= $language->error_validate_key;
    }

    if($_POST['username'] == $default['cp_username'] && $_POST['password'] == $default['cp_password']){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];

        header('location: index.php');
    }else{
        $errors[]= $language->username_or_password_incorrect;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?= $language->control_panel ?> - <?= $language->login ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/datepicker3.css" rel="stylesheet"/>
    <?php if ($language->rtl) {?>
        <link rel="stylesheet" href="css/bootstrap-flipped.min.css" />
        <link rel="stylesheet" href="css/bootstrap-rtl.min.css" />
    <?php } ?>
    <link href="css/styles.css" rel="stylesheet"/>

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading"><?= $language->login ?></div>
				<div class="panel-body">
					<form role="form" method="post">
                        <?php
                            if(count($errors) > 0){
                                ?>
                                <div class="alert alert-danger">
                                <?php
                                    foreach ($errors as $error) {
                                    ?>
                                        <strong><?= $language->error ?>!</strong> <?=$error ?>. <br/>

                                        <?php
                                    }
                                    ?>
                                    </div>
                                <?php
                            }
                        ?>

                        <?= $template->validate->key ?>
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me"><?= $language->remember_me ?>
								</label>
							</div>
							<input class="btn btn-primary" value="<?= $language->login ?>" type="submit" name="submit"/>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
