<?php
/**
 * Created by PhpStorm.
 * User: xlmnxp
 * Date: 9/4/17
 * Time: 8:55 AM
 */
?>

<div class="col-sm-12 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="attribution">Template by <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a> - <a href="http://www.glyphs.co" style="color: #333;">Icons by Glyphs</a></div>
</div>	<!--/.main-->

<script src="js/ckeditor/ckeditor.js"></script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");

        if($("#page_template").length){
            CKEDITOR.replace("page_template");
            CKEDITOR.config.language = "<?= $lang->language_code ?>";
        }
    }(window.jQuery);
</script>
</body>
</html>

