<?php
/**

 * User: xlmnxp
 * Date: 9/17/17
 * Time: 7:02 PM
 */
    $page = 'edit_page';
    include_once ('header.php');
    global $db, $form, $default, $template, $language;

    $errors = array();
    $success = false;

    
    if (!isset($_GET['id'])) {
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="alert alert-danger" role="alert">
                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span>
                                الصفحة غير موجودة لذلك لن تتمكن من تعديلها<br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        exit(0);
    }

    
    if(isset($_POST['submit'])){
        if(!isset($_POST['form_key']) || !$form->validate()){
            $errors[] = $language->error_validate_key;
        }
        
        if(empty($_POST['name']) || empty($_POST['title']) || empty($_POST['template']) || !isset($_POST['name']) || !isset($_POST['title']) || !isset($_POST['template'])){
            $errors[] = $language->empty_field;
        }else{
            $db->table('pages')->where('id',$_GET['id'])->update([
                "name" => $_POST['name'],
                "title" => $_POST['title'],
                "template" => preg_replace('/\{[\s]?\$(\w+)-\&gt\;(\w+)[\s]?\}/', '{\$$1->$2}', $_POST['template'])
                ]);
                
                $success = true;
            }
        }

        $page_detail = $db->table('pages')->where('id',$_GET['id'])->select()[0];

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><?= $language->pages ?></li>
            <li class="active"><?= $language->edit_page ?></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $language->edit_page ?></h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $language->edit_page ?></div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <?php if($success == true){ ?>
                            <div class="alert alert-success" role="alert"><strong><?php echo $language->success; ?></strong></div>
                        <?php }else if(count($errors)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?php foreach (@$errors as $error){ ?>
                                    <span class="fa fa-exclamation-circle" aria-hidden="true"></span>
                                    <?php echo $error; ?><br>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?= $template->validate->key ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?= $language->page_name ?></label>
                                <div class="input-group" dir="ltr">
                                    <span class="input-group-addon"><?= $default['url'] ?>pages/</span>
                                    <input class="form-control" type="text" name="name" placeholder="<?= $language->page_name ?>" value="<?= $page_detail->name ?>"/>
                                </div>
                                <p>يدعم وسوم HTML و PHP</p>
                            </div>
                            <div class="form-group">
                                <label><?= $language->page_title ?></label>
                                <input class="form-control" type="text" name="title" placeholder="<?= $language->page_title ?>" value="<?= $page_detail->title ?>" />
                                <p>يدعم وسوم HTML و PHP</p>                                
                            </div>
                            <div class="form-group">
                                <label><?= $language->page_template ?></label>
                                <textarea class="form-control" id="page_template" name="template" placeholder="<?= $language->page_template ?>"><?= $page_detail->template ?></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit" name="submit"><svg class="glyph stroked pencil" style="height: 20px; width: 20px;"><use xlink:href="#stroked-pencil"/></svg>&nbsp;<?= $language->edit ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->
<?php include_once ('footer.php') ?>
