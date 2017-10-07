<ol class="breadcrumb">
    <li><a href="{$default["url"]}">{$lang->home}</a></li>
    <li class="active">{$page}</li>
</ol>

{$search_form}

<form class="col-sm-12" method="post">
    {$validate->key}
    {if @$errors}
        <div class="alert alert-danger" role="alert">
            {foreach @$errors as $error}
                <span class="ion ion-alert-circled" aria-hidden="true"></span>
                {$error}
                <br>
            {/foreach}
        </div>
    {elseif @$success}
        <div class="alert alert-success" role="alert"><strong>{$lang->success}</strong></div>
    {/if}
    <div class="form-group">
        <label for="username">{$lang->report_message}</label>
        <textarea class="form-control" id="MessageTextarea" name="message" rows="3">{$default["report_message"]}</textarea>
    </div>
    <div class="g-recaptcha" data-sitekey="{$grecaptcha_key}"></div>
    <button type="submit" name="submit" class="btn btn-primary">{$lang->submit}</button>
</form>
