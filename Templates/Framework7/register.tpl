{$search_form}

<div class="col-lg-12">
    <form id="register" method="post" class="form-horizontal" enctype="multipart/form-data">
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
            <div class="content-block-title">{$lang->username}</div>
            <div class="card">
                    <div class="card-content item-inner list-block">
                        <ul>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <input type="text" id="username" name="username" placeholder="{$lang->enter_username}" required="" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                <div class="card-footer">
                    {$lang->help_username}
                </div>
            </div>

            <div class="content-block-title">{$lang->fullname}</div>
            <div class="card">
                <div class="card-content item-inner list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="text" id="fullname" name="fullname" placeholder="{$lang->enter_fullname}" required="" />
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="content-block-title">{$lang->avatar}</div>
            <div class="card">
                <div class="card-content" style="padding: 20px">
                    <input id="avatar" name="avatar" class="input-file" type="file">
                </div>
                <div class="card-footer">
                    {$lang->help_avatar}
                </div>
            </div>

            <div class="content-block-title">{$lang->category}</div>
            <div class="card">
                <div class="card-content item-inner list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <select id="category" name="category">
                                            {$categories}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="content-block-title">{$lang->country}</div>
            <div class="card">
                <div class="card-content item-inner list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <select id="country" name="country">
                                            {$countries}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="content-block-title">{$lang->message}</div>
            <div class="card">
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <textarea id="message" name="message" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="content-block-title">{$lang->sex}</div>
            <div class="card">
                <div class="list-block">
                    <ul>
                        <li>
                            <label class="label-radio item-content">
                                <!-- Checked by default -->
                                <input type="radio" name="sex" value="0">
                                <div class="item-inner">
                                    <div class="item-title">{$lang->male}</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <label class="label-radio item-content">
                                <!-- Checked by default -->
                                <input type="radio" name="sex" value="1">
                                <div class="item-inner">
                                    <div class="item-title">{$lang->female}</div>
                                </div>
                            </label>
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
</div>