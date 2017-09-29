<!DOCTYPE html>
<html>

<head>
  <link rel="shortcut icon" type="image/png" href="favicon.png"/>  
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
  <title>{$default["page-title"]}</title>
  <link rel="stylesheet" href="{$template_dir}/lib/css/framework7.ios.min.css" />
  {if $rtl}
    <link rel="stylesheet" href="{$template_dir}/lib/css/framework7.ios.rtl.min.css" />
  {/if}
  <link rel="stylesheet" href="{$template_dir}/css/style.css">
  <link href="{$template_dir}/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Color theme for statusbar -->
  <meta name="theme-color" content="#ffffff">
  <script src="{$template_dir}/lib/js/framework7.min.js"></script>
  {$include_header}
</head>

<body>
  <div class="views">
    <div class="view view-main">
      <div class="pages navbar-fixed">
        <div data-page="home" class="page">
          <div class="navbar">
            <div class="navbar-inner">
              <div class="left">
                {if $page != $lang->home}
                  <a href="{$default["url"]}" class="link">
                    <i class="icon icon-back"></i>
                    <span>{$default["title"]}</span>
                  </a>
                {/if}
              </div>
              <div class="center sliding">{$default["title"]}</div>
              <div class="right">
                <a href="#" onclick="window.location.reload()" class="link icon-only">
                  تحديث
                </a>
              </div>
            </div>
          </div>
        <div class="page-content">
            {$this->renderContent()}
        </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  {$include_footer}
</body>
</html>