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
  <script>
    function goback() {
        if (document.referrer) {
            window.history.back();
        } else {
            window.location.href = '{$default["url"]}';
        }
    }
    // Mobile Safari in standalone mode
    if(("standalone" in window.navigator) && window.navigator.standalone){

        // If you want to prevent remote links in standalone web apps opening Mobile Safari, change 'remotes' to true
        var noddy, remotes = false;

        document.addEventListener('click', function(event) {

            noddy = event.target;

            // Bubble up until we hit link or top HTML element. Warning: BODY element is not compulsory so better to stop on HTML
            while(noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
                noddy = noddy.parentNode;
            }

            if('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes))
            {
                event.preventDefault();
                document.location.href = noddy.href;
            }

        },false);
    }
  </script>
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
                  <a href="javascript:void" onclick="goback();" class="link">
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
        <a href="{$default["url"]}register" class="floating-button floating-button-to-popover open-popover color-purple">
          <i class="fa fa-plus"></i>
        </a>
      </div>
    </div>
  </div>
  </div>
  {$include_footer}
</body>
</html>