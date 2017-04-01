<ol class="breadcrumb">
    <li><a href="{$default["url"]}">{$lang->home}</a></li>
    <li class="active">{$page}</li>
</ol>
<form method="post">
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
        <div class="alert alert-success" role="alert"><strong>{$lang->success}</strong></div>
    {/if}
    <div class="form-group">
        <label for="username">{$lang->report_message}</label>
        <div class="input-group" style="width: 100%">
            <textarea class="form-control" id="MessageTextarea" name="report_message" rows="3">{$default["report_message"]}</textarea>
        </div>
        <small id="usernameHelp" class="form-text text-muted">{$lang->help_username}</small>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">{$lang->submit}</button>
</form>