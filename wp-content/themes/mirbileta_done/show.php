    <?php
    /*
        Template Name: show
    */

    //$action_alias = $_GET['alias'];

    $href = request_url();
    $arr = parse_url($href);
    $show_alias = preg_replace('/^\//', '', $arr['path']);
    $show_alias = preg_replace('/(^\w+)\/.*/', '$1', $show_alias);

    if (strpos($href, 'cirkus')) {
        header("Location: http://mirbileta.ru/circus20/?utm_source=site_page");
    }

    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>" . $global_salesite . "</url><show_url_alias>" . $show_alias . "</show_url_alias>";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $resp = curl_exec($ch);

    if (curl_errno($ch))
        print curl_error($ch);
    else
        curl_close($ch);

    //    $jData = json_decode($data);

    $columns = json_decode($resp)->results["0"]->data_columns;
    $data = json_decode($resp)->results["0"]->data;


    $first_action_idx = 0;

    foreach ($data as $kskip => $vskip) {

        $free_places_skip = $vskip[array_search("FREE_PLACE_COUNT", $columns)];


        if ($free_places_skip == 0) {
            $first_action_idx++;

            break;
        }
    }



    $act_id =       $data[$first_action_idx][array_search("ACTION_ID", $columns)];
    $free_places_skip_id = $act_id;
    $alias =        $data[$first_action_idx][array_search("ACTION_URL_ALIAS", $columns)];
    $act_frame =        $data[$first_action_idx][array_search("FRAME", $columns)];

    $act_name =     $data[$first_action_idx][array_search("ACTION_NAME", $columns)];
    $act_date_str_first =     $data[$first_action_idx][array_search("ACTION_DATE_STR", $columns)];
    $act_time_str_first =     $data[$first_action_idx][array_search("ACTION_TIME_STR", $columns)];
    $g_act_name =     $data[$first_action_idx][array_search("ACTION_NAME", $columns)];
    $thumb = (strlen($data[$first_action_idx][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0) ? (strpos("http", $data[$first_action_idx][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://' . $global_url . '/upload/' . $data[$first_action_idx][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[$first_action_idx][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : '';
    $poster = (strlen($data[$first_action_idx][array_search("ACTION_POSTER_IMAGE", $columns)]) > 0) ? (strpos("http", $data[$first_action_idx][array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?               $global_prot . '://' . $global_url . '/upload/' . $data[$first_action_idx][array_search("ACTION_POSTER_IMAGE", $columns)] : $data[$first_action_idx][array_search("ACTION_POSTER_IMAGE", $columns)] : '';
    $hall =         $data[$first_action_idx][array_search("HALL_NAME", $columns)];
    $genre =        $data[$first_action_idx][array_search("SHOW_GENRE", $columns)];
    $venue =        $data[$first_action_idx][array_search("VENUE_NAME", $columns)];
    $venue_top_alias =        $data[$first_action_idx][array_search("VENUE_URL_ALIAS", $columns)];
    $address =      $data[$first_action_idx][array_search("HALL_ADDR", $columns)];
    $minprice =      $data[$first_action_idx][array_search("MIN_PRICE", $columns)];

    $g_address =      $data[$first_action_idx][array_search("HALL_GOOGLE_ADDRESS", $columns)];
    $tag_list =     $data[$first_action_idx][array_search("ACTION_TAG_LIST", $columns)];
    $actor_list =     $data[$first_action_idx][array_search("ACTION_ACTOR_LIST", $columns)];

    $images_list =   $data[$first_action_idx][array_search("ACTION_IMAGES_LIST", $columns)];

    $isInfo = strlen($description) > 0;
    $description = $data[$first_action_idx][array_search("DESCRIPTION", $columns)];
    $ageCat = strlen($data[$first_action_idx][array_search("AGE_CATEGORY", $columns)]) ? $data[$first_action_idx][array_search("AGE_CATEGORY", $columns)] : '0+';


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

        <?php include 'seo.php'; ?>

        <!--        <title>--><?php //wp_title('-', true, 'right'); 
                                ?>
        <!--</title>-->

        <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

        <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

        <?php include 'viewport.php'; ?>


        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?> data-page="inner">

        <?php
        get_header();
        include('main_menu.php');
        ?>



        <div class="site-content white-bg action-page">
            <div class="site-container show-container">

                <!-- <div class="site-sidebar" style="border-right: 0;">
                    <div class="sidebar-block">

                        <div class="action-sidebar-holder">


                            <div title="<?php echo $act_name; ?> Купить билеты" class="action-buy-button sc-run-widget" data-id="<?php echo $act_id; ?>" data-frame="<?php echo $act_frame; ?>">Купить билеты</div>


                            <div class="action-prices">

                                <?php

                                if (strlen($minprice) > 0) {

                                    ?>

                                    от <?php echo $minprice; ?>&nbsp;<i class="fa fa-ruble"></i>

                                <?php
                                } else {

                                    echo 'Билетов нет, <span class="scroll-to-dates">выбрать другую дату</span>';
                                }

                                ?>


                            </div>

                            <div class="action-actors-holder">


                                <?php
                                $actorsArray = json_decode($actor_list);

                                if (count($actorsArray) > 0) : ?>

                                    <h2 class="ap-title">Исполнители:</h2>

                                <?php endif ?>

                                <ul>

                                    <?php

                                    // Подгружаем актеров


                                    $actors_html = "";

                                    foreach ($actorsArray as $key2 => $value2) {

                                        $actor_id =     $value2->id;
                                        $actor_alias =  $value2->alias;
                                        $actor_name =   $value2->name;
                                        $actor_image_small =  $value2->url_image_small;




                                        $actors_html .= '<li data-id="' . $actor_id . '"><a class="one-action-actor-link" href="/' . $actor_alias . '"><div class="one-action-actor-image" style="background-image: url(' . $actor_image_small . ')"></div>'
                                            . '<div class="one-action-actor-name">' . $actor_name . '</div>'
                                            . '</a></li>';
                                    }

                                    //                                var_dump($actor_columns);
                                    echo $actors_html;

                                    ?>

                                </ul>


                            </div>


                            <div class="action-tags-holder">

                                <h2 class="ap-title">Теги:</h2>

                                <?php

                                $tagsArray = json_decode($tag_list);
                                $tag_html = "";
                                $indexer = 0;

                                foreach ($tagsArray as $key3 => $value3) {

                                    $tag_id =             $value3->id;
                                    $tag_name =           $value3->name;



                                    $tag_html .= '<a class="sidebar-tag-item" href="/extend_search?action_tag_id=' . $tag_id . '">' . $tag_name . '</a>';

                                    if ($indexer == 0) {
                                        $tag_ids .= $tag_id;
                                    } else {
                                        $tag_ids .= ',' . $tag_id;
                                    }


                                    $indexer++;
                                }

                                echo $tag_html;

                                ?>
                            </div>

                            <?php

                            if ($show_alias == 'show_zateryannij_mir') {
                                echo '<a class="exscursion-link" href="http://mirbileta.ru/show_zat_mir_ekskursiya/?utm_source=from_zatmir" target="_blank">ЭКСКУРСИЯ ЗА КУЛИСЫ</a>';
                            }

                            if ($show_alias == 'show_zat_mir_ekskursiya') {
                                echo '<a class="exscursion-link" href="http://mirbileta.ru/show_zateryannij_mir/?utm_source=from_zatmir" target="_blank">БИЛЕТЫ НА СПЕКТАКЛЬ</a>';
                            }

                            ?>



                        </div>



                    </div>
                </div> -->

                <div class="mb-site-content">

                    <h1 class="action-title" title="<?php echo $act_name; ?>"><?php echo $act_name; ?></h1>

                    <div class="mirbileta-get-discount-holder">
                        <a target="_blank" href="/get_discount/">
                            <div class="mirbileta-get-discount"></div>
                        </a>
                    </div>


                    <?php

                    $show_hall = ($venue == $hall) ? '' : ' - ' . $hall;

                    ?>

                    <div class="action-venue"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<a href="/<?php echo $venue_top_alias; ?>/" target="_blank"><?php echo $venue; ?></a> <?php echo $show_hall; ?></div>


                    <div class="show-action-nearrest-date-holder">

                        Ближайшая дата: <span class="show-action-nearrest-date"><?php echo $act_date_str_first . ' ' . $act_time_str_first; ?></span> <span class="inline-buy-ticket sc-run-widget" data-id="<?php echo $act_id; ?>" data-frame="<?php echo $act_frame; ?>">Купить билеты</span>

                    </div>





                    <div class="a-image-reviews-holder">


                        <div class="image-gallery-and-desc-holder">
                            <div class="image-gallery-holder">


                                <div class="ig-main-wrapper">
                                    <img class="ig-main-img" src="<?php echo $poster; ?>" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                                </div>

                                <div class="ig-list-wrapper">

                                    <div class="ig-list-train">

                                        <?php

                                        $images = explode(',', $images_list);


                                        $images_html = '';

                                        if (strlen($images_list) > 5) {

                                            $images_html .= '<div data-type="img" data-url="' . $poster . '" class="ig-list-item"><img class="ig-main-img" src="' . $poster . '" alt="' . $act_name . ' Купить билеты" title="' . $act_name . ' Купить билеты" /></div>';
                                        }


                                        if (strlen($images_list) > 5) {
                                            foreach ($images as $key1 => $value1) {

                                                if (strpos($value1, 'youtube.com')) {
                                                    $images_html .= '<div class="one-action-image-list-item" alt="' . $act_name . ' Купить билет" data-url="' . $value1 . '" data-type="video"><div class="video_play"></div></div>';
                                                } else {
                                                    $images_html .= '<div data-type="img" data-url="' . $value1 . '" class="ig-list-item"><img class="ig-main-img" src="' . $value1 . '" alt="' . $act_name . ' Купить билеты" title="' . $act_name . ' Купить билеты" /></div>';
                                                }
                                            }
                                        }



                                        echo ($images_html);

                                        ?>

                                    </div>
                                </div>



                                <!--                        <div class="ig-list-wrapper">-->
                                <!---->
                                <!--                            <div class="ig-list-train">-->
                                <!---->
                                <!--                                <div class="ig-list-item">-->
                                <!--                                    <img class="ig-main-img" src="http://mirbileta.ru/images/sov_igra_v_djin.jpg" alt="--><?php //echo $act_name; 
                                                                                                                                                                ?>
                                <!--" title="--><?php //echo $act_name; 
                                                ?>
                                <!--" />-->
                                <!--                                </div>-->
                                <!--                                <div class="ig-list-item video">-->
                                <!--                                    <img class="ig-main-img" src="http://mirbileta.ru/images/sov_dvoe_na_kachelah.jpg" alt="--><?php //echo $act_name; 
                                                                                                                                                                    ?>
                                <!--" title="--><?php //echo $act_name; 
                                                ?>
                                <!--" />-->
                                <!--                                    <div class="ig-video-corners"></div>-->
                                <!--                                </div>-->
                                <!--                                <div class="ig-list-item">-->
                                <!--                                    <img class="ig-main-img" src="http://mirbileta.ru/images/sov_jalta.jpg" alt="--><?php //echo $act_name; 
                                                                                                                                                        ?>
                                <!--" title="--><?php //echo $act_name; 
                                                ?>
                                <!--" />-->
                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!---->
                                <!--                        </div>-->

                            </div>

                            <?php if (strlen($description) > 5) : ?>

                                <div class="action-description">

                                    <h2 class="ap-title">Описание</h2>

                                    <?php echo $description; ?>


                                    <!-- <div class="buy-button-holder">


                                        <div class="action-prices">
                                            от <?php echo $minprice; ?>&nbsp;<i class="fa fa-ruble"></i>
                                        </div>

                                    </div> -->
                                    

                                    <div class="sc-run-widget desc-action-buy-btn action-buy-button" data-id="<?php echo $act_id; ?>" data-frame="<?php echo $act_frame; ?>">Купить билеты</div>

                                </div>

                            <?php endif; ?>
                        </div>


                        <!--        777777777777777777777777777777777777777777-->


                        <div class="show-dates-wrapper">

                            <h3>Выберите дату и время:</h3>

                            <div class="tabsParent sc_tabulatorParent">
                                <div class="tabsTogglersRow sc_tabulatorToggleRow">

                                    <?php


                                    $dates_html = '';
                                    $mths = array();

                                    foreach ($data as $key2 => $value2) {

                                        $itemDate = $value2[array_search("ACTION_DATE", $columns)];
                                        $itemMth = substr($itemDate, 3, 2);


                                        $mths[$itemMth] = ($mths[$itemMth]) ? $mths[$itemMth] : array();
                                    }

                                    foreach ($data as $k => $v) {
                                        $itemDate2 = $v[array_search("ACTION_DATE", $columns)];
                                        $itemMth2 = substr($itemDate2, 3, 2);

                                        array_push($mths[$itemMth2], $v);
                                    }

                                    $mth_indexer = 0;

                                    foreach ($mths as $key_m => $value_m) {
                                        $opened = ($mth_indexer == 0) ? 'opened' : '';
                                        $mth_title = to_afisha_date($key_m, 'mounth_only', 'rus');
                                        $dates_html .= '<div class="tabToggle chromeScroll sc_tabulatorToggler ' . $opened . '" dataitem="' . $mth_indexer . '" title="">'
                                            . '<span class="">' . $mth_title . '</span>'
                                            . '</div>';
                                        $mth_indexer++;
                                    }

                                    $dates_html .= '</div><div class="ddRow notZindexed sc_tabulatorDDRow">';

                                    $mth_indexer2 = 0;

                                    foreach ($mths as $key_m => $value_m) {
                                        $opened2 = ($mth_indexer2 == 0) ? 'opened' : '';

                                        $dates_html .= '<div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight ' . $opened2 . '" dataitem="' . $mth_indexer2 . '">';


                                        foreach ($value_m as $in_key => $in_value) {

                                            $i_id =         $in_value[array_search("ACTION_ID", $columns)];
                                            $i_is_choosen_class = ($i_id == $free_places_skip_id) ? 'active_in_show' : '';
                                            $i_frame =      $in_value[array_search("FRAME", $columns)];
                                            $a_alias =      $in_value[array_search("ACTION_URL_ALIAS", $columns)];
                                            $a_date =       $in_value[array_search("ACTION_DATE_STR", $columns)];
                                            $a_time =       $in_value[array_search("ACTION_TIME_STR", $columns)];
                                            $a_hall =       $in_value[array_search("HALL_NAME", $columns)];

                                            $a_free_places = ($in_value[array_search("FREE_PLACE_COUNT", $columns)] == 0) ? 'Билетов нет' : 'мест: ' . $in_value[array_search("FREE_PLACE_COUNT", $columns)];
                                            $a_minprice =     $in_value[array_search("MIN_PRICE", $columns)];
                                            $a_maxprice =     $in_value[array_search("MAX_PRICE", $columns)];
                                            $a_day_of_week =  $in_value[array_search("ACTION_DAY_OF_WEEK", $columns)];


                                            $i_date_full = $in_value[array_search("ACTION_DATE_STR", $columns)];
                                            $i_date_arr = explode(' ', $i_date_full);

                                            $i_date_day = $i_date_arr[0];
                                            $i_date_mth = $i_date_arr[1];


                                            $a_date_1 =       substr($in_value[array_search("ACTION_DATE", $columns)], 0, 2);
                                            $a_date_2 = (substr($a_date_1, 0, 1) == '0') ? substr($a_date_1, 1, 1) : $a_date_1;

                                            $a_mth_1 =          substr($in_value[array_search("ACTION_DATE", $columns)], 3, 2);
                                            $a_mth_22 =          to_afisha_date($a_mth_1, 'mounth_only', 'rus');

                                            $is_holi =          to_afisha_date($in_value[array_search("ACTION_DATE", $columns)], 'is_holiday', 'rus');
                                            $is_holi = ($is_holi == 6 || $is_holi == 7) ? 'holiday' : '';


                                            $i_prices_str = (strlen($a_minprice) > 2) ? 'от ' . $a_minprice . '<i class="fa fa-ruble"></i>' : '&nbsp;';
                                            $i_total_tickets = $in_value[array_search("FREE_PLACE_COUNT", $columns)];
                                            $i_tickets_count = ($i_total_tickets > 0) ? ($i_total_tickets >= 70) ? 'Более 70 билетов' : $i_total_tickets . ' ' . getNoun($i_total_tickets, 'билет', 'билета', 'билетов') : 'билетов нет <span class="no-tickets-notify">уведомить Вас когда появятся?</span>';
                                            $t_show_buy_btn = ($i_total_tickets > 0) ? '<div class="a-date-item-buy sc-run-widget" data-id="' . $i_id . '" data-frame="' . $i_frame . '">Купить билеты</div>' : '';


                                            $dates_html .=   '<a class="nounderline" href="/' . $a_alias . '/"><div class="a-date-item-holder ' . $i_is_choosen_class . '">'
                                                . '<div class="a-date-item-date-holder"><span class="a-date-item-day">' . $i_date_day . '</span> ' . $i_date_mth . ' ' . $a_time . '</div>'
                                                . '<div class="a-date-item-info-holder">' . $i_tickets_count . ' ' . $i_prices_str . ' ' . $t_show_buy_btn . '</div>'
                                                . '</div></a>';

                                            //                        $dates_html .=   '<a class="show-action-date-link" href="/'.$a_alias.'">'
                                            //                            .'<div class="show-action-date">'
                                            //                            .'<div class="s-a-train">'
                                            //                            .'<div class="s-a-vagon"><div class="s-a-date '.$is_holi.'">'.$a_date_2.'<span class="s-a-dow">'.$a_day_of_week.'</span></div><div class="s-a-time">'.$a_time.'</div></div>'
                                            //                            .'<div class="s-a-vagon"><div class="s-a-places">'.$a_free_places.'</div><div class="s-a-prices">'.$a_minmaxString.'</div><div class="s-a-hall"><i class="fa fa-bank"></i>&nbsp;&nbsp;'.$a_hall.'</div></div>'
                                            //
                                            //                            .'</div>'
                                            //
                                            //
                                            //                            .'<div class="s-a-buy">Выбрать</div></div></a>';

                                        }

                                        $dates_html .= '</div>';

                                        $mth_indexer2++;
                                    }

                                    $dates_html .= '</div></div>';

                                    echo $dates_html;

                                    ?>


                                </div>


                                <!--        888888888888888888888888888888888888888888-->






                                <div class="a-reviews-holder">
                                    <h2 class="ap-title">Отзывы</h2>

                                    <div class="a-reviews-list">

                                        <div class="a-review-item good">
                                            <div class="a-review-text">
                                                Джем дома.) Мы в полном восторге! Спасибо организаторам, спасибо Сэм и всем кто был на мк и концерте.
                                            </div>

                                            <div class="a-review-media">
                                                <div class="a-review-media-item">
                                                    <img class="a-review-img" src="http://mirbileta.ru/images/sov_jalta.jpg" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                                                </div>
                                                <div class="a-review-media-item">
                                                    <img class="a-review-img" src="http://mirbileta.ru/images/sov_jalta.jpg" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                                                </div>
                                                <div class="a-review-media-item">
                                                    <img class="a-review-img" src="http://mirbileta.ru/images/sov_jalta.jpg" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                                                </div>
                                                <div class="a-review-media-item">
                                                    Еще 3 фото
                                                </div>

                                            </div>

                                            <div class="a-review-footer">
                                                <div class="a-review-rating">9.7</div>
                                                <div class="a-review-owner">Alisa</div>
                                                <div class="a-review-date">Вчера в 22:17</div>
                                            </div>

                                        </div>

                                        <div class="a-review-item bad">
                                            <div class="a-review-text">
                                                Ну мы ожидали большего... Спасибо конечно, организаторам. Но за такие деньги.. Говно.
                                            </div>

                                            <div class="a-review-media">


                                            </div>

                                            <div class="a-review-footer">
                                                <div class="a-review-rating">5.4</div>
                                                <div class="a-review-owner">Nikolay</div>
                                                <div class="a-review-date">Вчера в 21:58</div>
                                            </div>

                                        </div>

                                        <!--                            <div class="a-review-toggler">Смотреть еще 7 отзывов</div>-->

                                    </div>


                                </div>

                            </div>


                            <div class="a-similar-holder">



                                <?php

                                $similar_url =  $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_similar_action</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>4</rows_max_num><action_url_alias>" . $alias . "</action_url_alias>";

                                $ch = curl_init();

                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_URL, $similar_url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                                $resp4 = curl_exec($ch);

                                if (curl_errno($ch))
                                    print curl_error($ch);
                                else
                                    curl_close($ch);

                                if (json_decode($resp4)->results["0"]->code && json_decode($resp4)->results["0"]->code != 0) {

                                    echo '';
                                    //                        echo '<div class="somethinggoeswrong">Нет похожих мероприятий</div>';



                                } else {

                                    echo '<h1 class="mb_h1">Посмотрите еще эти мероприятия:</h1>';

                                    $sim_columns = json_decode($resp4)->results["0"]->data_columns;
                                    $sim_data = json_decode($resp4)->results["0"]->data;


                                    $sim_actionsHtml = "";

                                    foreach ($sim_data as $key4 => $value4) {

                                        $act_id =       $value4[array_search("ACTION_ID", $sim_columns)];
                                        $alias =        $value4[array_search("ACTION_URL_ALIAS", $sim_columns)];
                                        $venue_alias =        $value4[array_search("VENUE_URL_ALIAS", $sim_columns)];
                                        $frame =        $value4[array_search("FRAME", $sim_columns)];
                                        $act_name =     $value4[array_search("ACTION_NAME", $sim_columns)];
                                        $poster = (strlen($value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]) > 0) ? (strpos("http", $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]) == -1) ? $global_prot . '://' . $global_url . '/upload/' . $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)] : $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)] : $defaultPoster;
                                        $act_date =     $value4[array_search("ACTION_DATE_STR", $sim_columns)];
                                        $act_time =     $value4[array_search("ACTION_TIME_STR", $sim_columns)];
                                        $hall =         $value4[array_search("HALL", $sim_columns)];
                                        $genre =        $value4[array_search("SHOW_GENRE", $sim_columns)];
                                        $venue =        $value4[array_search("VENUE_NAME", $sim_columns)];
                                        $minprice =     $value4[array_search("MIN_PRICE", $sim_columns)];
                                        $maxprice =     $value4[array_search("MAX_PRICE", $sim_columns)];

                                        $isInfo =       strlen($description) > 0;
                                        $description =  $value4[array_search("DESCRIPTION", $sim_columns)];

                                        $ageCat =       strlen($value4[array_search("AGE_CATEGORY", $sim_columns)]) ? $value4[array_search("AGE_CATEGORY", $sim_columns)] : '0+';
                                        $act_date_time = $value4[array_search("ACTION_DATE_TIME", $sim_columns)];

                                        $prices_str = ($minprice || $minprice) ? ($minprice == $maxprice) ? 'от&nbsp;' . $minprice . '&nbsp;<i class="fa fa-ruble"></i>' : 'от&nbsp;' . $minprice . '&nbsp;<i class="fa fa-ruble"></i>' : '&nbsp;';

                                        //                            $sim_actionsHtml .=      '<div class="mb-block mb-action" data-id="'.$act_id.'">'
                                        //                                .'<a href="/'.$alias.'"><div class="mb-a-image" style="background-image: url(\''.$poster.'\');"></div></a>'
                                        //                                .'<a href="/'.$alias.'"><div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div></a>'
                                        //                                .'<div class="mb-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                                        //                                .'<a href="/'.$venue_alias.'"><div class="mb-a-venue">'.$venue.'</div></a>'
                                        //                                .'<div class="mb-a-buy-holder">'
                                        //                                .'<a href="/'.$alias.'"><div class="mb-buy mb-buy32 yellow">Купить билет</div></a>' //'.$minprice.' руб.
                                        //                                .'</div>'
                                        //                                .'</div>';

                                        $sim_actionsHtml .=  ''
                                            . '<div class="mb-block mb-action" data-id="' . $act_id . '"><a href="/' . $alias . '">'
                                            . '<div class="mb-action-image-holder"><img src="' . $poster . '"></div>'
                                            . '<div class="mb-a-title">' . $act_name . '<span class="mb-a-age">' . $ageCat . '</span></div>'
                                            . '<div class="mb-a-date">' . $act_date . ', <span class="mb-a-time">' . $act_time . '</span></div>'
                                            . '<div class="mb-a-venue">' . $venue . '</div>'
                                            . '<div class="mb-a-prices-and-buy"><div class="ma-a-prices">' . $prices_str . '</div><div class="ma-a-buy"><button class="learn-more ma-a-buy__btn">
                    <div class="circle">
                      <span class="icon arrow"></span>
                    </div>
                    <p class="button-text">Купить билет</p>
                  </button></div></div>'
                                            . '</a></div>'
                                            . '';
                                    }

                                    if (strlen($sim_actionsHtml) == 0) {
                                        echo '<div class="somethinggoeswrong">Мероприятие настолько уникально, что нет ничего похожего...</div>';
                                    } else {
                                        echo $sim_actionsHtml;
                                    }
                                }



                                ?>

                            </div>


                        </div>

                    </div>
                </div>


                <?php

                get_footer();

                ?>


                <script type="text/javascript" id="mbw-script-loader" data-src="<?php echo $global_prot . '://' . $global_url ?>/assets/widget/mb_widget.js" src=""></script>

    </body>

    <?php if (strlen($address) > 0) : ?>
        <script type="text/javascript">
            $(document).ready(function() {
                var geocoder;
                var map;
                var address = $('#address').val();

                function initialize() {
                    geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(-34.397, 150.644);
                    var myOptions = {
                        zoom: 16,
                        center: latlng,
                        mapTypeControl: true,
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                        },
                        navigationControl: true,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                    if (geocoder) {
                        geocoder.geocode({
                            'address': address
                        }, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                                    map.setCenter(results[0].geometry.location);

                                    var infowindow = new google.maps.InfoWindow({
                                        content: '<b>' + address + '</b>',
                                        size: new google.maps.Size(150, 50)
                                    });

                                    var marker = new google.maps.Marker({
                                        position: results[0].geometry.location,
                                        map: map,
                                        title: address
                                    });
                                    google.maps.event.addListener(marker, 'click', function() {
                                        infowindow.open(map, marker);
                                    });

                                } else {
                                    //                                alert("No results found");
                                }
                            } else {
                                //                            alert("Geocode was not successful for the following reason: " + status);
                            }
                        });
                    }
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            });
        </script>
    <?php endif ?>