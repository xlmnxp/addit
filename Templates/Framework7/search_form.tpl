<form action="{$default['url']}search" method="post" class="searchbar searchbar-init">
    <input type="hidden" name="sex" value="-1"/>
    <input type="hidden" name="category" value="-1"/>
    <input type="hidden" name="country" value="-1"/>
    <div class="searchbar-input">
        <input name="search" type="search" placeholder="بحث" value="{$search["value"]}"/>
        <a href="#" class="searchbar-clear"></a>
    </div><a href="#" class="searchbar-cancel">{$lang->cancel}</a>
    <button type="submit" name="submit" style="display: none">{$lang->submit}</button>
</form>
<div class="searchbar-overlay"></div>