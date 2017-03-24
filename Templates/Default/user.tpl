<ol class="breadcrumb" xmlns="http://www.w3.org/1999/html">
    <li><a href="{$settings_url}">{$lang->home}</a></li>
    <li class="active">{$page}</li>
</ol>
<div class="col-sm-12 col-md-12">
    <div class="col-sm-6 col-md-3 thumbnail">
        <a href="user.php?id={$user->id}">
            <img class="avatar" src="{if $user->avatar != null}{$user->avatar}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$user->username}&type=PNG{/if}" alt="{$user->username}"/>
        </a>
    </div>
    <div class="col-sm-6 col-md-9 caption">

        <a href="user.php?id={$user->id}"><h3 style="padding: 5px;" class="ovtxt"><i class="fa fa-id-card"></i>&nbsp;{$user->fullname}</h3></a>
        <h5 class="ovtxt"><strong><i class="fa fa-user"></i>&nbsp;{$lang->username}: </strong> {$user->username}</h5>
        <p class="ovtxt"><strong><i class="fa fa-id-card"></i>&nbsp;{$lang->message}: </strong> {$user->message}</p>
        <st class="ovtxt"><strong><i class="fa fa-venus-mars"></i>&nbsp;{$lang->sex}: </strong> {if $user->sex == 0}{$lang->male}{else}{$lang->female}{/if}</p>
        <p><a href="snapchat://add/{$user->username}" class="btn btn-primary" role="button" target="_blank">{$lang->follow}</a>
            <a href="#" class="btn btn-danger" role="button">{$lang->report}</a></p>
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
        /*
         var disqus_config = function () {
         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
         };
         */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://{$disqus_name}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>