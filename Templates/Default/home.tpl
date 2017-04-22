<ol class="breadcrumb">
    <li class="active">{$page}</li>
</ol>
<div class="col-sm-12" style="margin-bottom: 10px;">
<form id="search" action="{$default['url']}search" method="post">
    <div class="form-group">
        <div class="col-sm-4">
            <label for="search" class="ovtxt">{$lang->search}</label>
            <input class="form-control" name="search" id="search" type="text" placeholder="{$lang->search}">
        </div>
        <div class="col-sm-2">
            <label for="sex" class="ovtxt">{$lang->sex}</label>
            <select name="sex" id="sex" class="form-control">
                <option value="-1"></option>
                <option value="0">{$lang->male}</option>
                <option value="1">{$lang->female}</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label for="category" class="ovtxt">{$lang->category}</label>
            <select name="category" id="category" class="form-control">
                <option value="-1"></option>
                <option value="0">{$lang->male}</option>
                <option value="1">{$lang->female}</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label for="country" class="ovtxt">{$lang->country}</label>
            <select name="country" id="country" class="form-control">
                <option value="-1"></option>
                <option value="0">{$lang->male}</option>
                <option value="1">{$lang->female}</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label>&nbsp;</label>
            <input class="form-control btn btn-primary" name="submit" type="submit" value="{$lang->submit}" />
        </div>
    </div>
</form>
</div>
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
                <p class="ovtxt"><i class="fa fa-comment"></i>&nbsp;<a href="{$user["url"]}#disqus_thread">{$lang->comments}</a></p>
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