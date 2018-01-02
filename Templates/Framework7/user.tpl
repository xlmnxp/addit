{$search_form}

<div class="card">
    <div class="card-content">
        <div class="list-block media-list">
            <ul>
                <li class="item-content">
                    <div class="item-media">
                        <img src="{if $user['avatar'] != $default["url"]}{$user['avatar']}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$user['username']}&type=PNG{/if}" width="80" height="80" style="border-radius:12px;">
                    </div>
                    <div class="item-inner">
                        <div class="item-title-row">
                            <div class="item-title">{$user['fullname']}</div>
                        </div>
                        <div class="item-subtitle">{$user['username']}</div>
                        <div>
                            <a href="javascript:void(0)" class="btn btn-warning fullwidth btn-copy" role="button" data-clipboard-text="{$user["username"]}">
                                <i class="fa fa-copy"></i>&nbsp;{$lang->copy_username}
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-content" style="padding: 20px;">
        {$user['message']}
    </div>

    <div class="card-footer">
        <span>{$user["data"]->country_name}</span>
        <span><img src="{$default['url']}Flags/{$user["data"]->country}.png" alt="{$user["data"]->country_name}" width="30" height="20"></span>
    </div>
</div>
<div class="row" style="padding: 0px 30px 5px 30px;">
    <div class="col-50">
        <a href="{$default["url"]}report/{$user["id"]}" class="button button-big button-round bg-danger">{$lang->report}</a>
    </div>
    <div class="col-50">
        <a href="https://www.snapchat.com/add/{$user['username']}" class="button button-big button-round bg-red">{$lang->follow}</a>
    </div>
</div>
<center>
    <div class="addthis_inline_share_toolbox"></div>
</center>
<div class="card">
    <div class="card-header">
        {$lang->comments}
    </div>
    <div class="card-content" style="padding: 20px;">
        <div id="disqus_thread"></div>
        <script>
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
</div>