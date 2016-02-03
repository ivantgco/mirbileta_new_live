<?php


    $type =  $_GET['type']; // ACTION | ACTOR | VENUE
    $alias = $_GET['alias'];
    $title = $_GET['name'];
    $code =  $_GET['code'];


    if($code == 'zYjs0987djJJshy'){
        $tpl = '';

        switch($type){
            case 'ACTION':
                $tpl = 'action.php';
                break;
            case 'ACTOR':
                $tpl = 'actor.php';
                break;
            case 'VENUE':
                $tpl = 'venue.php';
                break;
        }


        require_once('wp-load.php');

        $my_post = array(
            'post_title' => $title,
            'post_name' => $alias,
            'post_type' => 'page',
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => array(8,39)
        );

        // Вставляем запись в базу данных
        $newPageId =  wp_insert_post( $my_post );

        update_post_meta($newPageId, '_wp_page_template', $tpl);

        echo 'success';
    }else{
        echo 'error';
    }



?>