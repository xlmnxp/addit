<ol class="breadcrumb">
    <li><a href="{$default["url"]}">{$lang->home}</a></li>
    <li class="active">{$page}</li>
</ol>

{$search_form}

<form id="register" method="post" class="form-horizontal" enctype="multipart/form-data">
    {if @$errors}
        <div class="alert alert-danger" role="alert">
        {foreach @$errors as $error}
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {$error}
            <br>
        {/foreach}
        </div>
    {elseif @$success}
        <div class="alert alert-success" role="alert"><strong>{$lang->success}!</strong> {$lang->success_register}</div>
    {/if}
    <fieldset>

            <!-- Prepended text-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="username">{$lang->username}</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input id="username" name="username" class="form-control" placeholder="{$lang->enter_username}" type="text" required="">
                    </div>
                    <p class="help-block">{$lang->help_username}</p>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="fullname">{$lang->fullname}</label>
                <div class="col-md-4">
                    <input id="fullname" name="fullname" type="text" placeholder="{$lang->enter_fullname}" class="form-control input-md" required="">
                </div>
            </div>

            <!-- File Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="avatar">{$lang->avatar}</label>
                <div class="col-md-4">
                    <input id="avatar" name="avatar" class="input-file" type="file">
                    <p class="help-block">{$lang->help_avatar}</p>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="category">{$lang->category}</label>
                <div class="col-md-4">
                    <select id="category" name="category" class="form-control">
                        <option value="1">Option one</option>
                        <option value="2">Option two</option>
                    </select>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="country">{$lang->country}</label>
                <div class="col-md-4">
                    <select id="country" name="country" class="form-control">
                        <option value="1">Option one</option>
                        <option value="2">Option two</option>
                    </select>
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="message">{$lang->message}</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="message" name="message"></textarea>
                </div>
            </div>

            <!-- Multiple Radios -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="sex">{$lang->sex}</label>
                <div class="col-md-4">
                    <div class="radio">
                        <label for="sex-0">
                            <input type="radio" name="sex" id="sex-0" value="0" checked="checked">
                            {$lang->male}
                        </label>
                    </div>
                    <div class="radio">
                        <label for="sex-1">
                            <input type="radio" name="sex" id="sex-1" value="1">
                            {$lang->female}
                        </label>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-primary">{$lang->submit}</button>
                </div>
            </div>
    </fieldset>
</form>