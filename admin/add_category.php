<?php
/**

 * User: xlmnxp
 * Date: 9/17/17
 * Time: 7:02 PM
 */
    $page = 'add_category';
    include_once ('header.php');
    global $db, $form, $default, $template, $language;

    $errors = array();
    $success = false;
    if(isset($_POST['submit'])){
        if(!isset($_POST['form_key']) || !$form->validate()){
            $errors[] = $language->error_validate_key;
        }

        if(empty($_POST['name']) || empty($_POST['description']) || !isset($_POST['name']) || !isset($_POST['description'])){
            $errors[] = $language->empty_field;
        }else{
            $db->table('categories')->insert([
                "name" => $_POST['name'],
                "description" => preg_replace('/\{[\s]?\$(\w+)-\&gt\;(\w+)[\s]?\}/', '{\$$1->$2}', $_POST['description'])
            ]);

            $success = true;
        }
    }

    ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><?= $language->categories ?></li>
            <li class="active"><?= $language->add_category ?></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $language->add_category ?></h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $language->add_category ?></div>
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
                                <label><?= $language->name ?></label>
                                <input class="form-control" type="text" name="name" placeholder="<?= $language->name ?>" />
                            </div>
                            <div class="form-group">
                                <label><?= $language->description ?></label>
                                <textarea class="form-control" id="category_description" name="description" placeholder="<?= $language->description ?>"></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit" name="submit"><svg class="glyph stroked pencil" style="height: 20px; width: 20px;"><use xlink:href="#stroked-pencil"/></svg>&nbsp;<?= $language->submit ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->
<?php include_once ('footer.php') ?>
