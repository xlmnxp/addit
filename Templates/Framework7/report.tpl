{$search_form}

<form method="post">
    {if isset($errors)}
        <div class="card">
            <div class="card-content">
                <div class="card-content-inner">
                    {foreach @$errors as $error}
                        <span class="fa fa-exclamation-circle" aria-hidden="true" style="color: orangered;"></span>
                        {$error}
                        <br>
                    {/foreach}
                </div>
            </div>
        </div>
    {elseif isset($success)}
        <div class="card">
            <div class="card-content">
                <div class="card-content-inner">
                        <span class="fa fa-check-circle" aria-hidden="true" style="color:greenyellow"></span>
                        <strong>{$lang->success}</strong>
                </div>
            </div>
        </div>
    {/if}

    {$validate->key}
    <div class="content-block-title">{$lang->report_message}</div>
    <div class="card">
        <div class="list-block">
            <ul>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-input">
                                <textarea id="MessageTextarea" name="message" rows="5">{$default["report_message"]}</textarea>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <center>
        <div class="g-recaptcha" data-sitekey="{$grecaptcha_key}"></div>
    </center>
    <br/>
    <div class="buttons-row" style="margin-bottom: 25px">
        <button type="submit" name="submit" class="button button-big button-fill" style="width: 90%;margin: 0 auto;">{$lang->submit}</button>
    </div>
</form>