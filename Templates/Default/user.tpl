<ol class="breadcrumb" xmlns="http://www.w3.org/1999/html">
    <li><a href="{$default["url"]}">{$lang->home}</a></li>
    <li class="active">{$page}</li>
</ol>
<div class="col-sm-12 col-md-12">
    <div class="col-sm-6 col-md-3 thumbnail">
        <a href="{$user["url"]}">
            <img class="avatar" src="{if $user["avatar"] != $default["url"]}{$user["avatar"]}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$user["username"]}&type=PNG{/if}" alt="{$user["username"]}"/>
        </a>
        <hr/>
        <p>
            <div class="row">
                <div class="col-sm-6">
                    <a class="btn btn-warning fullwidth btn-copy" role="button" data-clipboard-text="{$user["username"]}">
                        <i class="fa fa-copy"></i>&nbsp;{$lang->copy_username}
                    </a>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-danger fullwidth" href="{$default["url"]}report/{$user["id"]}" role="button">
                        <i class="fa fa-flag"></i>&nbsp;{$lang->report}
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <a class="btn btn-primary fullwidth" href="snapchat://add/{$user['username']}" role="button" target="_blank">
                        <i class="fa fa-snapchat"></i>&nbsp;{$lang->follow}
                    </a>
                </div>
            </div>
        </p>
    </div>
    <div class="col-sm-6 col-md-9 caption">

        <a href="{$user["url"]}"><h3 style="padding: 5px;" class="ovtxt"><i class="fa fa-id-card"></i>&nbsp;{$user["fullname"]}</h3></a>
        <h5 class="ovtxt"><strong><i class="fa fa-user"></i>&nbsp;{$lang->username} </strong><br/>
            {$user["username"]}</h5>
        <hr/>
        <p><strong><i class="fa fa-envelope"></i>&nbsp;{$lang->message}<br/> </strong>
            {$user["message"]}</p>
        <hr/>
        <p class="ovtxt"><strong><i class="fa fa-venus-mars"></i>&nbsp;{$lang->sex} </strong>
            <br/> {$user["sex"]}</p>
        <hr/>
        <p>
            <div class="addthis_inline_share_toolbox"></div>
        </p>
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <ol class="breadcrumb" xmlns="http://www.w3.org/1999/html">
        <li class="active">{$lang->comments}</li>
    </ol>
    <div id="disqus_thread"></div>
    <script>

        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

         var disqus_config = function () {
            this.page.url = "{$user["url"]}";  // Replace PAGE_URL with your page's canonical URL variable
         };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://{$disqus_name}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>