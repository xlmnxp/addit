<?php
/**

 * User: xlmnxp
 * Date: 9/4/17
 * Time: 8:55 AM
 */

    include_once('Functions/login.php');
    global $language, $page, $template;
    if(!isset($noheader) || $noheader == false) {
?>
<!DOCTYPE html>
<html dir="<?= $language->rtl ? 'rtl' : 'ltr'?>">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, zoom=0"/>
    <title><?= $language->control_panel ?> » <?= eval('return $language->'.$page.';') ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <?php if ($language->rtl) {?>
    <link rel="stylesheet" href="css/bootstrap-flipped.min.css" />
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css" />
        <style>
            @media (min-width: 768px){
                .sidebar{
                    right: 0;
                }
            }
            .user-menu{
                float: left !important;
            }
            .pull-right>.dropdown-menu{
                left: 0;
                right: auto;
            }
        </style>
    <?php } ?>
    <link href="css/styles.css" rel="stylesheet"/>

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <?= $template->include_header ?>
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
                        <li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> <?= $language->logout ?></a></li>
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
        <li <?= ($page == 'home') ? 'class="active"' : '' ?>><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg> <?= $language->home ?></a></li>
        <li <?= ($page == 'users') ? 'class="active"' : '' ?>><a href="users.php"><svg class="glyph stroked male user"><use xlink:href="#stroked-male-user"></use></svg> <?= $language->users ?></a></li>
        <li class="parent <?= ($page == 'add_category' || $page == 'view_all_categories' || $page == 'edit_category') ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#categories_settings">
            <span><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> <span><svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg></span> <?= $language->add_category ?>
            </a>
            <ul class="children <?= !($page == 'add_category' || $page == 'view_all_categories' || $page == 'edit_category') ? 'collapse' : '' ?>" id="categories_settings">
                <li <?= ($page == 'add_category') ? "class=\"active\"" : '' ?>>
                    <a href="add_category.php#categories_settings">
                        <svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg> <?= $language->add_category ?> 
                    </a>
                </li>
                <li <?= ($page == 'view_all_categories' || $page == 'edit_category') ? "class=\"active\"" : '' ?>>
                    <a href="categories.php#categories_settings">
                        <svg class="glyph stroked eye"><use xlink:href="#stroked-eye"></use></svg> <?= $language->view_all_categories ?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent <?= ($page == 'add_page' || $page == 'view_all_pages' || $page == 'edit_page') ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#pages_settings">
            <span><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> <span><svg class="glyph stroked blank document"><use xlink:href="#stroked-blank-document"/></svg></span> <?= $language->pages ?>
            </a>
            <ul class="children <?= !($page == 'add_page' || $page == 'view_all_pages' || $page == 'edit_page') ? 'collapse' : '' ?>" id="pages_settings">
                <li <?= ($page == 'add_page') ? "class=\"active\"" : '' ?>>
                    <a href="add_page.php#pages_settings">
                        <svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg> <?= $language->add_page ?> 
                    </a>
                </li>
                <li <?= ($page == 'view_all_pages' || $page == 'edit_page') ? "class=\"active\"" : '' ?>>
                    <a href="pages.php#pages_settings">
                        <svg class="glyph stroked eye"><use xlink:href="#stroked-eye"></use></svg> <?= $language->view_all_pages ?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent <?= ($page == 'website_settings' || $page == 'admin_settings') ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#settings">
                <span><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> <span><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg></span> <?= $language->settings ?>
            </a>
            <ul class="children <?= !($page == 'website_settings' || $page == 'admin_settings') ? 'collapse' : '' ?>" id="settings">
                <li <?= ($page == 'website_settings') ? "class=\"active\"" : '' ?>>
                    <a href="website_settings.php#settings">
                        <svg class="glyph stroked desktop"><use xlink:href="#stroked-desktop"></use></svg> <?= $language->website_settings ?> 
                    </a>
                </li>
                <li <?= ($page == 'admin_settings') ? "class=\"active\"" : '' ?>>
                    <a href="admin_settings.php#settings">
                        <svg class="glyph stroked key"><use xlink:href="#stroked-key"></use></svg> <?= $language->admin_settings ?> 
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div><!--/.sidebar-->
<?php } ?>