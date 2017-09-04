<div class="col-sm-12" style="margin-bottom: 10px;">
<form id="search" action="{$default['url']}search" method="post">
    <div class="form-group">
        <div class="col-sm-4">
            <label for="search" class="ovtxt">{$lang->search}</label>
            <input class="form-control" name="search" id="search" type="text" placeholder="{$lang->search}" value="{$search["value"]}">
        </div>
        <div class="col-sm-2">
            <label for="sex" class="ovtxt">{$lang->sex}</label>
            <select name="sex" id="sex" class="form-control" onload="this.selectedIndex = {$search["sex"]};">
                <option value="-1"></option>
                {$search_sex}
            </select>
        </div>
        <div class="col-sm-2">
            <label for="category" class="ovtxt">{$lang->category}</label>
            <select name="category" id="category" class="form-control">
                <option value="-1"></option>
                {$categories}
            </select>
        </div>
        <div class="col-sm-2">
            <label for="country" class="ovtxt">{$lang->country}</label>
            <select name="country" id="country" class="form-control">
                <option value="-1"></option>
                {$countries}
            </select>
        </div>
        <div class="col-sm-2">
            <label>&nbsp;</label>
            <input class="form-control btn btn-primary" name="submit" type="submit" value="{$lang->submit}" />
        </div>
    </div>
</form>
</div>
