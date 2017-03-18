<div class="row">
    {foreach $items as $v}
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            <img class="avatar" src="{if $v['avatar'] != null}{$v['avatar']}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$v['username']}&type=PNG{/if}" alt="{$v['username']}"/>
            <div class="caption">
                <h3 class="ovtxt">{$v['fullname']}</h3>
                <h5 class="ovtxt">{$v['username']}</h5>
                <p class="ovtxt">{$v['message']}</p>
                <p><a href="snapchat://add/{$v['username']}" class="btn btn-primary" role="button" target="_blank">{$follow}</a> <a href="#" class="btn btn-danger" role="button">{$report}</a></p>
            </div>
        </div>
    </div>
    {/foreach}
</div>
{if $pages}
<nav>
    <ul class="pager">
        <li><a href="#">{$previous}</a></li>
        <li><a href="#">{$next}</a></li>
    </ul>
</nav>
{/if}