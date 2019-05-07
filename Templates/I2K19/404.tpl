<ol class="breadcrumb" xmlns="http://www.w3.org/1999/html">
    <li><a href="{$default["url"]}">{$lang->home}</a></li>
    <li class="active">{$page}</li>
</ol>
<div class="container">
    <div class="row">
        <div class="error-template">
            <h1>{$lang->error}!</h1>
            <h2>{$lang->page_not_found}</h2>
            <div class="error-actions">
                <a href="{$default["url"]}" class="btn btn-primary">
                    <i class="icon-home icon-white"></i> {$lang->home} </a>
            </div>
        </div>
    </div>
</div>