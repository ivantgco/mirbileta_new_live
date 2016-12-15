<?php
require_once('wp-load.php');
    $alias = $_GET['alias'];
    $pbp = get_page_by_path($alias);



var_export($pbp);

//
//
//
//
//
//    $pbp = get_page_by_path($alias);
//    $p_id = $pbp->ID;
//
//    echo 'IN';
//
//    echo $alias;
//    echo $p_id;


?>