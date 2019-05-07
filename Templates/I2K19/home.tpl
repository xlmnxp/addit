<ol class="breadcrumb">
    <li class="active">{$page}</li>
</ol>

{$search_form}

<div class="row">
    {foreach $users as $user}
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            <a href="{$user['url']}">
                <img class="avatar" src="{if $user['avatar'] != $default['url']}{$user['avatar']}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$user['username']}&type=PNG{/if}" alt="{$user['username']}"/>
            </a>
            <div class="caption">
                <a href="{$user['url']}"><h3 class="ovtxt"><i class="ion ion-card"></i>&nbsp;{$user['fullname']}</h3></a>
                <div class="row">
                    <div class="col-sm-9">
                        <h5 class="ovtxt"><i class="ion ion-ios-person"></i>&nbsp;{$user['username']}</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5 style="text-align: center;"><img src="{$default['url']}Flags/{$user['country']}.png" alt="{$user['country_name']}" width="30" height="20" /></h5>
                    </div>
                </div>
                <p class="ovtxt"><i class="ion ion-ios-paper"></i>&nbsp;{$user['message']}</p>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="ovtxt"><i class="ion ion-man"></i>&nbsp;{$user['sex']}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="ovtxt"><i class="ion ion-ios-email"></i>&nbsp;<a href="{$user["url"]}#disqus_thread">{$lang->comments}</a></p>
                    </div>
                </div>
                <p>
                    <div class="row">
                        <div class="col-sm-6">
                            <a class="btn btn-warning fullwidth btn-copy" role="button" data-clipboard-text="{$user["username"]}">
                                <i class="ion ion-ios-copy"></i>&nbsp;{$lang->copy_username}
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-danger fullwidth" href="{$default["url"]}report/{$user["id"]}" role="button">
                                <i class="ion ion-ios-flag"></i>&nbsp;{$lang->report}
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <a class="btn btn-primary fullwidth" href="snapchat://add/{$user['username']}" role="button" target="_blank">
                                <i class="ion ion-social-snapchat"></i>&nbsp;{$lang->follow}
                            </a>
                        </div>
                    </div>
                </p>
            </div>
        </div>
    </div>
    {/foreach}
</div>
<center>
    <ul class="pagination">
        {foreach $pages as $number}
            <li{if $number['active']} class="active" {/if}><a href="{$number['page']}">{$number['name']}</a></li>
        {/foreach}
    </ul>
</center>

