<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{$default["page-title"]}</title>
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="{$template_dir}/css/bootstrap.min.css" />
    <link href="{$template_dir}/css/lumen-bootstrap.min.css" rel="stylesheet" />
    {if $rtl}
        <link rel="stylesheet" href="{$template_dir}/css/bootstrap-flipped.min.css" />
        <link rel="stylesheet" href="{$template_dir}/css/bootstrap-rtl.min.css" />
    {/if}
    <link rel="stylesheet" href="{$template_dir}/css/main.css"/>
    <link href="{$template_dir}/css/ionicons.min.css" rel="stylesheet" />

    {$include_header}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{$default['url']}">{$default['title']}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li {if $page == $lang->home   }class="active"{/if}><a href="{$default["url"]}">{$lang->home}</a></li>
                <li {if $page == $lang->about  }class="active"{/if}><a href="#about">{$lang->about}</a></li>
                <li {if $page == $lang->contact}class="active"{/if}><a href="#contact">{$lang->contact}</a></li>
                <!--li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>{$language_select}</li>
                <li {if $page == $lang->new_user }class="active"{/if}><a href="{$default["url"]}register" class="btn-primary nbtn"><i class="ion ion-android-share" aria-hidden="true"></i>
                         {$lang->new_user}</a></li>
                <li {if $page == $lang->new_vip  }class="active"{/if}><a href="{$default["url"]}p/register-vip" class="btn-warning nbtn"><i class="ion ion-trophy" aria-hidden="true"></i>
                         {$lang->new_vip}</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    {$this->renderContent()}
    <br/>
    <br/>
    <div class="row">
        <hr>
        <div class="col-lg-12">
            <div class="col-md-4">
                <center><a href="{$default["url"]}p/tos">{$lang->terms_of_service}</a> | <a href="{$default["url"]}p/privacy">{$lang->privacy}</a></center>
            </div>
            <div class="col-md-8">
                <center><p class="muted pull-right">© {$year} {$default['title']}. {$lang->copyright}</p></center>
            </div>
        </div>
    </div>
</div>

{$include_footer}
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{$template_dir}/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="{$template_dir}/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>