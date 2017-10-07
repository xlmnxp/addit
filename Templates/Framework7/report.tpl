<form method="post">
    {$validate->key}
    {if @$errors}
        <div class="card">
            <div class="card-content">
                <div class="card-content-inner">
                    {foreach @$errors as $error}
                        <span class="fa fa-exclamation-circle" aria-hidden="true"></span>
                        {$error}
                        <br>
                    {/foreach}
                </div>
            </div>
        </div>
    {elseif @$success}
        <div class="card">
            <div class="card-content">
                <div class="card-content-inner">
                        <span class="fa fa-check-circle" aria-hidden="true"></span>
                        <strong>{$lang->success}</strong>
                </div>
            </div>
        </div>
    {/if}

    <div class="list-block">
        <ul>
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label"><b>{$lang->report_message}</b></div>
                        <div class="item-input">
                            <textarea id="MessageTextarea" name="message" rows="5">{$default["report_message"]}</textarea>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <center>
        <div class="g-recaptcha" data-sitekey="{$grecaptcha_key}"></div>
    </center>
    <br/>
    <div class="buttons-row">
        <button type="submit" name="submit" class="button button-big button-fill" style="width: 90%;margin: 0 auto;">{$lang->submit}</button>
    </div>
</form>