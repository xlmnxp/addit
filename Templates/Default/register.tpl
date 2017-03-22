<ol class="breadcrumb">
    <li><a href="{$settings_url}">{$lang->home}</a></li>
    <li class="active">{$page}</li>
</ol>

<form method="post" enctype="multipart/form-data">
    {if @$errors}
        <div class="alert alert-danger" role="alert">
        {foreach @$errors as $error}
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {$error}
            <br>
        {/foreach}
        </div>
    {elseif @$lang->dosuccess}
        <div class="alert alert-success" role="alert"><strong>{$lang->success}!</strong> {$lang->success_register}</div>
    {/if}
    <div class="form-group">
        <label for="username">{$lang->username}</label>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="{$lang->enter_username}" aria-describedby="basic-addon1" id="username" name="username"/>
        </div>
        <small id="usernameHelp" class="form-text text-muted">{$lang->help_username}</small>
    </div>
    <div class="form-group">
        <label for="fullname">{$lang->fullname}</label>
        <input type="text" class="form-control" id="fullname" placeholder="{$lang->enter_fullname}" name="fullname"/>
    </div>
    <div class="form-group">
        <label for="AvatarInputFile">{$lang->avatar}</label>
        <input type="file" class="form-control-file" id="AvatarInputFile" aria-describedby="fileHelp" name="avatar"/>
        <small id="fileHelp" class="form-text text-muted">{$lang->help_avatar}</small>
    </div>
    <div class="form-group">
        <label for="CatagorySelect">{$lang->category}</label>
        <select class="form-control" name="category" id="CatagorySelect">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group">
        <label for="CountrySelect">{$lang->country}</label>
        <select class="form-control" name="country" id="CountrySelect">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group">
        <label for="MessageTextarea">{$lang->message}</label>
        <textarea class="form-control" id="MessageTextarea" name="message" rows="3"></textarea>
    </div>
    <fieldset class="form-group">
        <legend>{$lang->sex}</legend>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input custom-control-input" name="sex" value="0" checked/>
                {$lang->male}
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input custom-control-input" name="sex" value="1"/>
                {$lang->female}
            </label>
        </div>
    </fieldset>
    <button type="submit" name="submit" class="btn btn-primary">{$lang->submit}</button>
</form>