{$search_form}
<div class="list-block list-block-search searchbar-found media-list">
    <ul>
        {foreach $users as $user}
        <li>
            <a class="item-content item-link" href="{$user["url"]}">
                <div class="item-media"><img src="{if $user['avatar'] != $default["url"]}{$user['avatar']}{else}https://feelinsonice-hrd.appspot.com/web/deeplink/snapcode?username={$user['username']}&type=PNG{/if}" width="80" height="80" style="border-radius:12px;"></div>
                <div class="item-inner">
                    <div class="item-title-row">
                        <div class="item-title">{$user['fullname']}</div>
                        <div class="item-after">{$user['username']}</div>
                    </div>
                    <div class="item-text">{$user['message']}</div>
                </div>
            </a>
        </li>
        {/foreach}
    </ul>
</div>