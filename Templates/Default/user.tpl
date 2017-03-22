<ol class="breadcrumb">
    <li><a href="{$settings_url}">{$lang->home}</a></li>
    <li class="active">{$page}</li>
</ol>
<div class="">
<div class="col-sm-6 col-md-3 thumbnail">
    <a href="user.php?id={$user->id}">
        <img class="avatar" src="{if $user->avatar != null}{$user->avatar}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$user->username}&type=PNG{/if}" alt="{$user->username}"/>
    </a>
</div>
<div class="col-sm-6 col-md-9 caption">

    <a href="user.php?id={$user->id}"><h3 style="padding: 5px;" class="ovtxt">{$user->fullname}</h3></a>
    <h5 class="ovtxt">{$user->username}</h5>
    <p class="ovtxt">{$user->message}</p>
    <p><a href="snapchat://add/{$user->username}" class="btn btn-primary" role="button" target="_blank">{$lang->follow}</a>
        <a href="#" class="btn btn-danger" role="button">{$lang->report}</a></p>
</div>
</div>
<br/><br/>
<a class="panel">{$lang->comments}</a>