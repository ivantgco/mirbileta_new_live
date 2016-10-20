    <?php
    /*
        Template Name: single_action
    */

    $href = request_url();
    $arr = parse_url($href);
    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);


//    $global_prot = 'http';
//    $global_url = '192.168.1.190';
//    $global_salesite = 'dev.mirbileta.ru';
//
//    $global_prot = 'http';
//    $global_url = '95.165.147.252';
//    $global_salesite = 'dev.mirbileta.ru';



    $global_prot = 'https';
    $global_url = 'shop.mirbileta.ru';
    $global_salesite = 'mirbileta.ru';



    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>".$global_salesite."</url><action_url_alias>".$action_alias."</action_url_alias>";

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

    $columns = json_decode($resp)->results["0"]->data_columns;
    $data = json_decode($resp)->results["0"]->data[0];

    $act_id =       $data[array_search("ACTION_ID", $columns)];
    $widget_act_id =$data[array_search("ACTION_ID", $columns)];
    $alias =        $data[array_search("ACTION_URL_ALIAS", $columns)];
    $show_alias =   $data[array_search("SHOW_URL_ALIAS", $columns)];
    $frame =        $data[array_search("FRAME", $columns)];
    $widget_frame = $data[array_search("FRAME", $columns)];
    $act_name =     $data[array_search("ACTION_NAME", $columns)];
    $g_act_name =     $data[array_search("ACTION_NAME", $columns)];
    $thumb =        (strlen($data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0) ? (strpos("http", $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $defaultPoster;
    $poster =       (strlen($data[array_search("ACTION_POSTER_IMAGE", $columns)])> 0) ? (strpos("http", $data[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?                          $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_IMAGE", $columns)]: $defaultPoster;
    $act_date_full =     $data[array_search("ACTION_DATE", $columns)];
    $act_date =     $data[array_search("ACTION_DATE_STR", $columns)];
    $act_date_year =    to_afisha_date($data[array_search("ACTION_DATE", $columns)], 'year', 'rus');
    $act_time =     $data[array_search("ACTION_TIME_STR", $columns)];
    $hall =         $data[array_search("HALL_NAME", $columns)];
    $genre =        $data[array_search("SHOW_GENRE", $columns)];
    $venue =        $data[array_search("VENUE_NAME", $columns)];
    $venue_alias =  $data[array_search("VENUE_URL_ALIAS", $columns)];
    $address =      $data[array_search("HALL_ADDR", $columns)];
    $g_address =    $data[array_search("HALL_GOOGLE_ADDRESS", $columns)];
    $free_places =  $data[array_search("FREE_PLACE_COUNT", $columns)];
    $minprice =     $data[array_search("MIN_PRICE", $columns)];
    $maxprice =     $data[array_search("MAX_PRICE", $columns)];
    $day_of_week =  $data[array_search("ACTION_DAY_OF_WEEK", $columns)];
    $duration =     $data[array_search("DURATION_HOUR_MIN", $columns)];
    $is_wo =        $data[array_search("ACTION_TYPE", $columns)] == 'ACTION_WO_PLACES';
    $sbag =         $data[array_search("SPLIT_BY_AREA_GROUP", $columns)] == 'TRUE';
    $tag_list =     $data[array_search("ACTION_TAG_LIST", $columns)];
    $actor_list =   $data[array_search("ACTION_ACTOR_LIST", $columns)];
    $images_list =   $data[array_search("ACTION_IMAGES_LIST", $columns)];

    $isInfo = strlen($description) > 0;
    $description = $data[array_search("DESCRIPTION", $columns)];

    $ageCat = strlen($data[array_search("AGE_CATEGORY", $columns)]) ? $data[array_search("AGE_CATEGORY", $columns)] : '0+';
    $act_date_time = $data[array_search("ACTION_DATE_TIME", $columns)];

    $short_date = to_afisha_date($act_date_time, "short_date", "rus");
    $short_date_with_year = to_afisha_date($act_date_time, "short_date_with_year", "rus");
    $week_and_time = to_afisha_date($act_date_time, "week_and_time", "rus");
    $weekday = to_afisha_date($act_date_time, "weekday", "rus");
    $weekday_short = to_afisha_date($act_date_time, "weekday_short", "rus");
    $time = to_afisha_date($act_date_time, "time", "rus");


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

        <meta charset="UTF-8"/>

        <title><?php wp_title('-', true, 'right'); ?></title>

        <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

        <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

        <?php include 'viewport.php'; ?>


        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

        <script type="text/javascript" id="mbw-script-loader" data-src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/mb_widget.js" src=""></script>

        <?php wp_head(); ?>

    </head>



    <body <?php body_class(); ?> data-page="inner">

    <?php
    get_header();
    include('main_menu.php');

    ?>


    <div class="site-content white-bg action-page">
        <div class="site-container">

            <div class="site-sidebar" style="border-right: 0;">
                <div class="sidebar-block">

                    <div class="action-sidebar-holder">


                        <div title="<?php echo $act_name; ?> Купить билеты" class="action-buy-button ">Купить билеты</div>


                        <div class="action-prices">
                            от <?php echo $minprice; ?>&nbsp;<i class="fa fa-ruble"></i>
                        </div>

                        <div class="action-actors-holder">


                                <?php
                                $actorsArray = json_decode($actor_list);

                                if(count($actorsArray) > 0): ?>

                                <h2 class="ap-title">Исполнители:</h2>

                                <?php endif ?>

                                <ul>

                                    <?php

                                    // Подгружаем актеров


                                    $actors_html = "";

                                    foreach ($actorsArray as $key2 => $value2){

                                        $actor_id =     $value2->id;
                                        $actor_alias =  $value2->alias;
                                        $actor_name =   $value2->name;
                                        $actor_image_small =  $value2->url_image_small;




                                        $actors_html .= '<li data-id="'.$actor_id.'"><a class="one-action-actor-link" href="/'.$actor_alias.'"><div class="one-action-actor-image" style="background-image: url('.$actor_image_small.')"></div>'
                                            .'<div class="one-action-actor-name">'.$actor_name.'</div>'
                                            .'</a></li>';
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

                            foreach ($tagsArray as $key3 => $value3){

                                $tag_id =             $value3->id;
                                $tag_name =           $value3->name;



                                $tag_html .= '<a class="sidebar-tag-item" href="/extend_search?action_tag_id='.$tag_id.'">'.$tag_name.'</a>';

                                if($indexer == 0){
                                    $tag_ids .= $tag_id;
                                }else{
                                    $tag_ids .= ','.$tag_id;
                                }


                                $indexer++;
                            }

                            echo $tag_html;

                            ?>
                        </div>

                    </div>



                </div>
            </div>

            <div class="mb-site-content">

                <h1 class="action-title" title="<?php echo $act_name; ?>"><?php echo $act_name; ?></h1>

                <div class="mirbileta-get-discount-holder">
                    <a target="_blank" href="/get_discount/"><div class="mirbileta-get-discount"></div></a>
                </div>


                <?php

                    $another_date_link = (strlen($show_alias) > 1)? '<a class="another-date-link" href="/'.$show_alias.'/"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Выбрать другую дату</a>' : '';

                ?>

                <div class="action-date"><?php echo $act_date .' '. $act_date_year; ?> <span class="weekday">(<?php echo $weekday_short;?>)</span> <?php echo $act_time;?> <?php echo $another_date_link; ?></div>

                <?php

                $show_hall = ($venue == $hall)? '' : ' - '.$hall;

                ?>

                <div class="action-venue"><a href="/<?php echo $venue_alias; ?>/" target="_blank"><?php echo $venue; ?></a><?php echo $show_hall; ?></div>


                <div class="action-places-info-holder">
                    <div class="a-places-info-title">
                        Есть <b>2 отличных места</b> в партере<br/>
                        по 5500 руб! <span class="a-places-info-link">Смотреть</span>
                    </div>
                    <div class="a-places-info-sub">
                        Всего осталось более 100 билетов<br/>
                        от 1000 до 5000 руб.
                    </div>
                </div>



                <div class="a-image-reviews-holder">


                    <div class="image-gallery-holder">


                        <div class="ig-main-wrapper">
                            <img class="ig-main-img" src="<?php echo $poster; ?>" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                        </div>

                        <div class="ig-list-wrapper">

                            <div class="ig-list-train">

                                <?php

                                $images = explode(',', $images_list);


                                $images_html = '';

                                if(strlen($images_list) > 5){

                                    $images_html .= '<div data-type="img" data-url="'.$poster.'" class="ig-list-item"><img class="ig-main-img" src="'.$poster.'" alt="'. $act_name .' Купить билеты" title="'. $act_name .' Купить билеты" /></div>';

                                }


                                if(strlen($images_list) > 5){
                                    foreach ($images as $key1 => $value1){

                                        if(strpos($value1, 'youtube.com')){
                                            $images_html .= '<div class="one-action-image-list-item ig-list-item" alt="'.$act_name . ' Купить билет" data-url="'.$value1.'" data-type="video"><div class="video_play" alt="Смотерть видео"></div></div>';
                                        }else{
                                            $images_html .= '<div data-type="img" data-url="'.$value1.'" class="ig-list-item"><img class="ig-main-img" src="'.$value1.'" alt="'. $act_name .' Купить билеты" title="'. $act_name .' Купить билеты" /></div>';
                                        }

                                    }
                                }


                                echo($images_html);

                                ?>

                            </div>
                        </div>



<!--                        <div class="ig-list-wrapper">-->
<!---->
<!--                            <div class="ig-list-train">-->
<!---->
<!--                                <div class="ig-list-item">-->
<!--                                    <img class="ig-main-img" src="http://mirbileta.ru/images/sov_igra_v_djin.jpg" alt="--><?php //echo $act_name; ?><!--" title="--><?php //echo $act_name; ?><!--" />-->
<!--                                </div>-->
<!--                                <div class="ig-list-item video">-->
<!--                                    <img class="ig-main-img" src="http://mirbileta.ru/images/sov_dvoe_na_kachelah.jpg" alt="--><?php //echo $act_name; ?><!--" title="--><?php //echo $act_name; ?><!--" />-->
<!--                                    <div class="ig-video-corners"></div>-->
<!--                                </div>-->
<!--                                <div class="ig-list-item">-->
<!--                                    <img class="ig-main-img" src="http://mirbileta.ru/images/sov_jalta.jpg" alt="--><?php //echo $act_name; ?><!--" title="--><?php //echo $act_name; ?><!--" />-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->

                    </div>

                    <?php if(strlen($description) > 5) :?>

                    <div class="action-description">

                        <h2 class="ap-title">Описание</h2>

                        <?php echo $description; ?>


                        <div class="buy-button-holder">

                            <div title="<?php echo $act_name; ?> Купить билеты" class="action-buy-button ">Купить билеты</div>

                            <div class="action-prices">
                                от <?php echo $minprice; ?>&nbsp;<i class="fa fa-ruble"></i>
                            </div>

                        </div>

                    </div>

                    <?php endif;?>

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

                    $similar_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_similar_action</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>4</rows_max_num><action_url_alias>".$alias."</action_url_alias>";

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_URL, $similar_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                    $resp4 = curl_exec($ch);

                    if(curl_errno($ch))
                        print curl_error($ch);
                    else
                        curl_close($ch);

                    if(json_decode($resp4)->results["0"]->code && json_decode($resp4)->results["0"]->code != 0){

                        echo '';
//                        echo '<div class="somethinggoeswrong">Нет похожих мероприятий</div>';



                    }else{

                        echo '<h1 class="mb_h1">Посмотрите еще эти мероприятия:</h1>';

                        $sim_columns = json_decode($resp4)->results["0"]->data_columns;
                        $sim_data = json_decode($resp4)->results["0"]->data;


                        $sim_actionsHtml = "";

                        foreach ($sim_data as $key4 => $value4){

                            $act_id =       $value4[array_search("ACTION_ID", $sim_columns)];
                            $alias =        $value4[array_search("ACTION_URL_ALIAS", $sim_columns)];
                            $venue_alias =        $value4[array_search("VENUE_URL_ALIAS", $sim_columns)];
                            $frame =        $value4[array_search("FRAME", $sim_columns)];
                            $act_name =     $value4[array_search("ACTION_NAME", $sim_columns)];
                            $poster =       (strlen($value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]) > 0)? (strpos("http" , $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]) == -1)? $global_prot.'://'.$global_url.'/upload/' . $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]: $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)] : $defaultPoster;
                            $act_date =     $value4[array_search("ACTION_DATE_STR", $sim_columns)];
                            $act_time =     $value4[array_search("ACTION_TIME_STR", $sim_columns)];
                            $hall =         $value4[array_search("HALL", $sim_columns)];
                            $genre =        $value4[array_search("SHOW_GENRE", $sim_columns)];
                            $venue =        $value4[array_search("VENUE_NAME", $sim_columns)];
                            $minprice =     $value4[array_search("MIN_PRICE", $sim_columns)];
                            $maxprice =     $value4[array_search("MAX_PRICE", $sim_columns)];

                            $isInfo =       strlen($description) > 0;
                            $description =  $value4[array_search("DESCRIPTION", $sim_columns)];

                            $ageCat =       strlen($value4[array_search("AGE_CATEGORY", $sim_columns)])? $value4[array_search("AGE_CATEGORY", $sim_columns)]: '0+';
                            $act_date_time = $value4[array_search("ACTION_DATE_TIME", $sim_columns)];

                            $prices_str = ($minprice || $minprice)? ( $minprice == $maxprice)? 'от&nbsp;'.$minprice . '&nbsp;<i class="fa fa-ruble"></i>' : 'от&nbsp;'.$minprice . '&nbsp;<i class="fa fa-ruble"></i>': '&nbsp;';

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
                                .'<div class="mb-block mb-action" data-id="'.$act_id.'"><a href="/'.$alias.'">'
                                .'<div class="mb-action-image-holder"><img src="'.$poster.'"></div>'
                                .'<div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div>'
                                .'<div class="mb-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                                .'<div class="mb-a-venue">'.$venue.'</div>'
                                .'<div class="mb-a-prices-and-buy"><div class="ma-a-prices">'.$prices_str.'</div><div class="ma-a-buy">Купить билет</div></div>'
                                .'</a></div>'
                                .'';
                        }

                        if(strlen($sim_actionsHtml) == 0){
                            echo '<div class="somethinggoeswrong">Мероприятие настолько уникально, что нет ничего похожего...</div>';
                        }else{
                            echo $sim_actionsHtml;
                        }
                    }



                    ?>

                </div>




<!--                <div id="multibooker-afisha-wrapper"-->
<!--                     data-host=--><?php //echo $global_prot ."://". $global_url.'/'; ?>
<!--                     data-ip="--><?php //echo $global_url; ?><!--"-->
<!--                    ></div>-->


            </div>

        </div>
    </div>



            <?php

            get_footer();


            ?>

    <div class="modal-widget-holder">
        <div class="modal-widget-inner">


            <div id="multibooker-widget-wrapper"
                 data-actions="<?php echo $widget_act_id; ?>"
                 data-mirbileta="true"
                 data-frame="<?php echo $widget_frame; ?>"
                 data-host=<?php echo $global_prot ."://". $global_url.'/'; ?>
                 data-ip="<?php echo $global_url; ?>">

                <div class="mirbileta-widget-wrapper-wait-text"><i class="fa fa-cog fa-spin"></i>&nbsp;&nbsp;Подождите, загружается модуль продажи билетов...</div>

            </div>

        </div>
    </div>


    <?php




    if($free_places > 0){


        //7562 бой
        //7556
        //7564 отменим

    ?>

<!--        <script type="text/javascript" src="--><?php //echo $global_prot .'://'. $global_url?><!--/assets/widget/afisha.js"></script>-->

    <?php

    }
    ?>






    </body>

    <?php if(strlen($address) > 0): ?>
    <script type="text/javascript">
        $(document).ready(function(){
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