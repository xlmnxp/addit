<div class="col-sm-12 thumbnail search-form">
<form id="search" action="{$default['url']}search" method="get">
    <div class="form-group">
        <div class="col-sm-4">
            <label for="search" class="ovtxt">{$lang->search}</label>
            <input class="form-control" name="q" id="search" type="text" placeholder="{$lang->search}" value="{$search["value"]}">
        </div>
        <div class="col-sm-2">
            <label for="sex" class="ovtxt">{$lang->sex}</label>
            <select name="s" id="sex" class="form-control">
                <option value="-1">{$lang->all}</option>
                {$search_sex}
            </select>
        </div>
        <div class="col-sm-2">
            <label for="category" class="ovtxt">{$lang->category}</label>
            <select name="cat" id="category" class="form-control">
                <option value="-1">{$lang->all}</option>
                {$categories}
            </select>
        </div>
        <div class="col-sm-2">
            <label for="country" class="ovtxt">{$lang->country}</label>
            <select name="cou" id="country" class="form-control">
                <option value="-1">{$lang->all}</option>
                {$countries}
            </select>
        </div>
        <div class="col-sm-2">
            <label>&nbsp;</label>
            <input class="form-control btn btn-primary" type="submit" value="{$lang->submit}" />
        </div>
    </div>
</form>
</div>
<div class="clear"></div>
