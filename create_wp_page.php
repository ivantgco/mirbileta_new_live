<?php




    $type =  $_GET['type']; // ACTION | ACTOR | VENUE | SHOW
    $alias = $_GET['alias'];
    $title = $_GET['name'];

    $title_seo = $_GET['title'];
    $desc_seo = $_GET['description'];

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
                    'post_title' => $title_seo . '/'.$desc_seo,
                    'post_name' => $alias,
                    'post_type' => 'page',
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => '',
                    'post_category' => array(8,39)
                );

                // Вставляем запись в базу данных
                $newPageId =  wp_insert_post( $my_post );

                update_post_meta($newPageId, '_wp_page_template', $tpl);

                echo '<STATUS>SUCCESS</STATUS>';
            }else{

                $pbp = get_page_by_path($alias);
                $p_id = $pbp->ID;

                $my_post = array();
                $my_post['ID'] = $p_id;
                $my_post['post_title'] = $title_seo . '/'.$desc_seo;

                wp_update_post( $my_post );



                echo '<STATUS>UPDATED</STATUS>';

            }

    }else{
        echo '<STATUS>ERROR</STATUS>';
    }

?>
<!--mirbileta.ru/create_wp_page.php?type=ACTION&alias=koncert_posvyashhennij_poetu_robertu_rozhdestvenskomu_6844&title=test_title&code=zYjs0987djJJshy&description=test_desc-->