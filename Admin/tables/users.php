<?php

    require_once ('../../Functions/inc.php');
    require_once ('../../Functions/Template.php');
    $hello = $db->table('users')->select(['id','username','fullname','avatar']);
    echo $hello;
?>