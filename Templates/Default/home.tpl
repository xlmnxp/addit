<ol class="breadcrumb">
    <li class="active">{$page}</li>
</ol>

{$search_form}

<div class="row">
    {foreach $users as $user}
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            <a href="{$user["url"]}">
                <img class="avatar" src="{if $user['avatar'] != $default["url"]}{$user['avatar']}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$user['username']}&type=PNG{/if}" alt="{$user['username']}"/>
            </a>
            <div class="caption">
                <a href="{$user["url"]}"><h3 class="ovtxt"><i class="fa fa-id-card"></i>&nbsp;{$user['fullname']}</h3></a>
                <h5 class="ovtxt"><i class="fa fa-user"></i>&nbsp;{$user['username']}</h5>
                <p class="ovtxt"><i class="fa fa-envelope"></i>&nbsp;{$user['message']}</p>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="ovtxt"><i class="fa fa-venus-mars"></i>&nbsp;{$user['sex']}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="ovtxt"><i class="fa fa-comment"></i>&nbsp;<a href="{$user["url"]}#disqus_thread">{$lang->comments}</a></p>
                    </div>
                </div>
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
        </div>
    </div>
    {/foreach}
</div>
{if $pages}
<nav>
    <ul class="pager">
        <li {$class_previous}><a {$previous}>{$lang->previous}</a></li>
        <li {$class_next}><a {$next}>{$lang->next}</a></li>
    </ul>
</nav>
{/if}