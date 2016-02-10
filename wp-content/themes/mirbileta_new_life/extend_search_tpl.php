<?php
/*
    Template Name: extend_search
*/

    $page_id = get_the_ID();

    $from_date =         $_GET['from_date'];
    $to_date =           $_GET['to_date'];
    $search_keyword =    $_GET['search_keyword'];
    $min_price =         $_GET['min_price'];
    $max_price =         $_GET['max_price'];

    $venue_id =          $_GET['venue_id'];
    $actor_id =          $_GET['actor_id'];
    $author_id =         $_GET['author_id'];
    $action_tag_id =     $_GET['action_tag_id'];

    $url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>15</rows_max_num>";

    if(strlen($from_date) > 0) { $url .= '<from_date>'.$from_date.'</from_date>'; }
    if(strlen($to_date) > 0) { $url .= '<to_date>'.$to_date.'</to_date>'; }
    if(strlen($search_keyword) > 0) { $url .= '<search_keyword>'.$search_keyword.'</search_keyword>'; }
    if(strlen($min_price) > 0) { $url .= '<min_price>'.$min_price.'</min_price>'; }
    if(strlen($max_price) > 0) { $url .= '<max_price>'.$max_price.'</max_price>'; }

    if(strlen($venue_id) > 0) { $url .= '<venue_id>'.$venue_id.'</venue_id>'; }
    if(strlen($actor_id) > 0) { $url .= '<actor_id>'.$actor_id.'</actor_id>'; }
    if(strlen($author_id) > 0) { $url .= '<author_id>'.$author_id.'</author_id>'; }
    if(strlen($action_tag_id) > 0) { $url .= '<action_tag_id>'.$action_tag_id.'</action_tag_id>'; }

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $resp = curl_exec($ch);

    if(curl_errno($ch))
        print curl_error($ch);
    else
        curl_close($ch);

    $jData = json_decode($data);

    $columns = json_decode($resp)->results["0"]->data_columns;
    $data = json_decode($resp)->results["0"]->data;
    $actions_count = count($data);
    $show_next_button = $actions_count == 15;

?>


<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->


<head>

    <meta charset="UTF-8" />

    <script>
        console.log("<?php echo $url; ?>");
    </script>

    <title><?php wp_title( '-', true, 'right' ); ?></title>

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width">


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner"  data-filter="<?php echo $show_type_alias; ?>">

<?php
get_header();
include('main_menu.php');

?>

<div class="site-content actor-page extend-search-page">

    <div class="container">

        <div class="mb-block-sh flLeft posRel">

            <div class="flLeft mb-tag-filter-wrapper posRel">

                <h2 class="padLeft25"><?php echo get_the_title($page_id);?></h2>

                <div class="mb-tag-filter-col-1">

                    <div class="mb-tf-block with_border" data-filter="venue_id"></div>

                    <div class="mb-tf-block" data-filter="actor_id"></div>

                </div>

                <div class="mb-tag-filter-col-2">

                    <div class="mb-tf-block with_border left_border" data-filter="action_tag_id"></div>

                    <div class="pr50">
                        <div class="mb-tf-block left_border header_left_border" data-filter="author_id"></div>
                    </div>

                    <div class="pr50">
                        <div class="mb-tf-block" data-inputs="false" data-filter="price"></div>
                    </div>

                </div>

                <div class="extend-search-clear sc-clear-filters">Сбросить</div>
                <div class="extend-search-confirm sc-submit-filters">Показать <span class="mb-tf-count-results sc-filter-count-actions"></span></div>

            </div>

            <h3 class="padLeft25 wid100pr flLeft">Результаты поиска:</h3>


            <div class="actions-wrapper">

                <?php


                $actionsHtml = "";

                foreach ($data as $key => $value){

                    $act_id =       $value[array_search("ACTION_ID", $columns)];
                    $alias =        $value[array_search("ACTION_URL_ALIAS", $columns)];
                    $venue_alias =        $value[array_search("VENUE_URL_ALIAS", $columns)];
                    $frame =        $value[array_search("FRAME", $columns)];
                    $act_name =     $value[array_search("ACTION_NAME", $columns)];
                    $thumb =        (strpos("http" , $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)];
                    $poster =       (strpos("http" , $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_IMAGE", $columns)];
                    $act_date =     $value[array_search("ACTION_DATE_STR", $columns)];
                    $act_time =     $value[array_search("ACTION_TIME_STR", $columns)];
                    $hall =         $value[array_search("HALL", $columns)];
                    $genre =        $value[array_search("SHOW_GENRE", $columns)];
                    $venue =        $value[array_search("VENUE_NAME", $columns)];
                    $minprice =     $value[array_search("MIN_PRICE", $columns)];
                    $maxprice =     $value[array_search("MAX_PRICE", $columns)];

                    $isInfo =       strlen($description) > 0;
                    $description =  $value[array_search("DESCRIPTION", $columns)];

                    $ageCat =       strlen($value[array_search("AGE_CATEGORY", $columns)])? $value[array_search("AGE_CATEGORY", $columns)]: '0+';
                    $act_date_time = $value[array_search("ACTION_DATE_TIME", $columns)];

                    $short_date =               to_afisha_date($act_date_time, "short_date", "rus");
                    $short_date_with_year =     to_afisha_date($act_date_time, "short_date_with_year", "rus");
                    $week_and_time =            to_afisha_date($act_date_time, "week_and_time", "rus");
                    $weekday =                  to_afisha_date($act_date_time, "weekday", "rus");
                    $time =                     to_afisha_date($act_date_time, "time", "rus");

                    $actionsHtml .=      '<div class="mb-block mb-action" data-id="'.$act_id.'">'
                        .'<a href="/'.$alias.'"><div class="mb-a-image" style="background-image: url(\''.$poster.'\');"></div></a>'
                        .'<a href="/'.$alias.'"><div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div></a>'
                        .'<div class="mb-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                        .'<a class="venue-link" href="/'.$venue_alias.'"><div class="mb-a-venue">'.$venue.'</div></a>'
                        .'<div class="mb-a-buy-holder">'
                        .'<a href="/'.$alias.'"><div class="mb-buy mb-buy32 soft">Купить билет</div></a>' //'.$minprice.' руб.
                        .'</div>'
                        .'</div>';
                }

                if(strlen($actionsHtml) == 0){
                    echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
                }else{
                    echo $actionsHtml;
                }
                ?>
            </div>


<!--            --><?php //if($show_next_button): ?>

                <div id="load_next" class="load_next_style_2">Загрузить еще</div>

<!--            --><?php //endif ?>


        </div>

    </div>


</div>

<?php

get_footer();

?>


</body>
