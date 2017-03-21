<ol class="breadcrumb">
    <li class="active">{$lang->home}</li>
</ol>
<div class="row">
    {foreach $users as $user}
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            <a href="user.php?id={$user["id"]}">
                <img class="avatar" src="{if $user['avatar'] != null}{$user['avatar']}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$user['username']}&type=PNG{/if}" alt="{$user['username']}"/>
            </a>
            <div class="caption">
                <a href="user.php?id={$user["id"]}"><h3 class="ovtxt">{$user['fullname']}</h3></a>
                <h5 class="ovtxt">{$user['username']}</h5>
                <p class="ovtxt">{$user['message']}</p>
                <p><a href="snapchat://add/{$user['username']}" class="btn btn-primary" role="button" target="_blank">{$lang->follow}</a>
                    <a href="#" class="btn btn-danger" role="button">{$lang->report}</a></p>
            </div>
        </div>
    </div>
    {/foreach}
</div>
{if $pages}
<nav>
    <ul class="pager">
        <li><a href="#">{$lang->previous}</a></li>
        <li><a href="#">{$lang->next}</a></li>
    </ul>
</nav>
{/if}