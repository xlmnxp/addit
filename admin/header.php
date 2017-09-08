<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 9/4/17
 * Time: 8:55 AM
 */

    include_once('Functions/login.php');
    global $language, $page;
    if(!isset($noheader) || $noheader == false) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?= $language->control_panel ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/datepicker3.css" rel="stylesheet"/>
    <?php if ($language->rtl) {?>
    <link rel="stylesheet" href="css/bootstrap-flipped.min.css" />
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css" />
        <style>
            @media (min-width: 768px){
                .sidebar{
                    right: 0;
                }
            }</style>
    <?php } ?>
    <link href="css/styles.css" rel="stylesheet"/>

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?= $language->control_panel ?></a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?= $_SESSION['username'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                        <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
                        <li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
<!--    <form role="search">-->
<!--        <div class="form-group">-->
<!--            <input type="text" class="form-control" placeholder="Search">-->
<!--        </div>-->
<!--    </form>-->
    <ul class="nav menu">
        <li <?= ($page == 'home') ? "class=\"active\"" : '' ?>><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> <?= $language->home ?></a></li>
        <li <?= ($page == 'users') ? "class=\"active\"" : '' ?>><a href="users.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> <?= $language->users ?></a></li>
        <li class="parent">
            <a data-toggle="collapse" href="#settings">
                <span><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> الإعدادات
            </a>
            <ul class="children collapse" id="settings">
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> إعدادات الموقع
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> إعدادات حساب الإداري
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div><!--/.sidebar-->
<?php } ?>