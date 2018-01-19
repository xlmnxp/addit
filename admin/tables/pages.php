<?php

require_once ('../../Functions/inc.php');
require_once ('../../Functions/Template.php');
global $db;
$total = $db->table('pages')->select()->count();
$limit= htmlentities($_GET['limit'], ENT_QUOTES, 'UTF-8');
$offset= htmlentities($_GET['offset'], ENT_QUOTES, 'UTF-8');
$order= htmlentities($_GET['order'], ENT_QUOTES, 'UTF-8');
$sort= htmlentities($_GET['sort'], ENT_QUOTES, 'UTF-8');
$search = htmlentities(isset($_GET['search']) ? $_GET['search'] : '', ENT_QUOTES, 'UTF-8');

$pageSearch = [
    [
        'name', 'LIKE', '%'.$search.'%'
    ],
    'Or' => [
        'title', 'LIKE', '%'.$search.'%'
    ],
    'OR' => [
        'template', 'LIKE', '%'.$search.'%'
    ]
];

$pages = $db->table("pages")
        ->where('1', '1')->parseWhere($pageSearch)->orderBy($sort ,$order)->limit($offset,$limit)->select();

?>
{
"total": <?= $total ?>,
"rows": <?= $pages ?>
}
