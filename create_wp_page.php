<?php




    $type =  $_GET['type']; // ACTION | ACTOR | VENUE | SHOW
    $alias = $_GET['alias'];
    $title = $_GET['name'];
    $code =  $_GET['code'];

    function the_slug_exists($post_name) {
        global $wpdb;
        if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
            return true;
        } else {
            return false;
        }
    }

    if($code == 'zYjs0987djJJshy'){

        require_once('wp-load.php');

            if(!the_slug_exists($alias)){
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
                    case 'SHOW':
                        $tpl = 'show.php';
                        break;
                }


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

                echo 'already exsists';

            }

    }else{
        echo 'error code';
    }

?>