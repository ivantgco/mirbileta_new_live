    <?php
    /*
        Template Name: show
    */

    //$action_alias = $_GET['alias'];
    $cur_url = $_SERVER["REQUEST_URI"];
    $show_alias = substr($cur_url, 1, (strlen($cur_url) - 2));//parse_url($cur_url)->path;

    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><show_url_alias>".$show_alias."</show_url_alias>";

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

    $act_id =       $data[0][array_search("ACTION_ID", $columns)];
//    $alias =        $data[0][array_search("ACTION_URL_ALIAS", $columns)];
//    $frame =        $data[0][array_search("FRAME", $columns)];
    $act_name =     $data[0][array_search("ACTION_NAME", $columns)];
    $g_act_name =     $data[0][array_search("ACTION_NAME", $columns)];
    $thumb =        (strlen($data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] )> 0) ? (strpos("http", $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : '';
    $poster =       (strlen($data[array_search("ACTION_POSTER_IMAGE", $columns)] )> 0) ? (strpos("http", $data[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?               $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_IMAGE", $columns)]: '';
//    $thumb =        (strpos("http", $data[0][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://'. $global_url . '/upload/' . $data[0][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[0][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)];
//    $poster =       (strpos("http", $data[0][array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?               $global_prot . '://'. $global_url . '/upload/' . $data[0][array_search("ACTION_POSTER_IMAGE", $columns)] : $data[0][array_search("ACTION_POSTER_IMAGE", $columns)];
//    $act_date =     $data[0][array_search("ACTION_DATE_STR", $columns)];
//    $act_time =     $data[0][array_search("ACTION_TIME_STR", $columns)];
    $hall =         $data[0][array_search("HALL_NAME", $columns)];
    $genre =        $data[0][array_search("SHOW_GENRE", $columns)];
    $venue =        $data[0][array_search("VENUE_NAME", $columns)];
    $address =      $data[0][array_search("VENUE_ADDRESS", $columns)];
//    $free_places =  $data[0][array_search("FREE_PLACE_COUNT", $columns)];
//    $minprice =     $data[0][array_search("MIN_PRICE", $columns)];
//    $maxprice =     $data[0][array_search("MAX_PRICE", $columns)];
//    $day_of_week =  $data[0][array_search("ACTION_DAY_OF_WEEK", $columns)];
//    $duration =     $data[0][array_search("DURATION_HOUR_MIN", $columns)];
//    $is_wo =        $data[0][array_search("ACTION_TYPE", $columns)] == 'ACTION_WO_PLACES';
//    $sbag =         $data[0][array_search("SPLIT_BY_AREA_GROUP", $columns)] == 'TRUE';

    $isInfo = strlen($description) > 0;
    $description = $data[0][array_search("DESCRIPTION", $columns)];
    $ageCat = strlen($data[0][array_search("AGE_CATEGORY", $columns)]) ? $data[0][array_search("AGE_CATEGORY", $columns)] : '0+';


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

        <meta name="viewport" content="width=device-width">


        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?> data-page="inner">

    <?php
    get_header();
    include('main_menu.php');

    ?>

    <div class="site-content show-page">

        <div class="container">


            <div class="mb-block-sh posRel">

                <div class="one-action-title"><?php echo $act_name; ?></div>
                <div class="one-action-age"><?php echo $ageCat; ?></div>
                <div class="one-action-venue"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<span class="one-action-hall"><?php echo $hall; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

                    <?php if(strlen($address) > 0): ?>

                        <span class="one-action-address"><i class="fa fa-map-o"></i>&nbsp;&nbsp; <?php echo $address; ?> <span class="show-gmap-hint">Показать карту</span></span>

                    <?php endif ?>

                </div>

                <?php if(strlen($address) > 0): ?>

                    <div class="one-action-gmap">
                        <input id="address" type="hidden" value="<?php echo $address; ?>" />

                        <div style=" width: 100%; height: 280px;" id="map_canvas"></div>
                    </div>

                <?php endif ?>

                <?php

                    $durationHtml = (strlen($duration) > 0)? '<span class="one-action-length">Продолжительность: '. $duration .' </span>' : '';

                ?>

                <div class="show-dates-title">Выберите дату:</div>

                <div class="show-dates-wrapper">

                    <div class="tabsParent sc_tabulatorParent">
                        <div class="tabsTogglersRow sc_tabulatorToggleRow">

                        <?php


                        $dates_html = '';
                        $mths = array();

                        foreach($data as $key2 => $value2){

                            $itemDate = $value2[array_search("ACTION_DATE", $columns)];
                            $itemMth = substr($itemDate, 3,2);


                            $mths[$itemMth] = ($mths[$itemMth]) ? $mths[$itemMth] : array();

                        }

                        foreach($data as $k => $v){
                            $itemDate2 = $v[array_search("ACTION_DATE", $columns)];
                            $itemMth2 = substr($itemDate2, 3,2);

                            array_push($mths[$itemMth2],$v);

                        }

                        $mth_indexer = 0;

                        foreach($mths as $key_m => $value_m){
                            $opened = ($mth_indexer == 0) ? 'opened' : '';
                            $mth_title = to_afisha_date($key_m,'mounth_only', 'rus');
                            $dates_html .= '<div class="tabToggle sc_tabulatorToggler '.$opened.'" dataitem="'.$mth_indexer.'" title="">'
                                            .'<span class="">'.$mth_title.'</span>'
                                            .'</div>';
                            $mth_indexer ++;
                        }

                        $dates_html .= '</div><div class="ddRow notZindexed sc_tabulatorDDRow">';

                        $mth_indexer2 = 0;

                        foreach($mths as $key_m => $value_m){
                            $opened2 = ($mth_indexer2 == 0) ? 'opened' : '';

                            $dates_html .= '<div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight '.$opened2.'" dataitem="'.$mth_indexer2.'">';



                            foreach($value_m as $in_key => $in_value){

                                $a_alias =      $in_value[array_search("ACTION_URL_ALIAS", $columns)];
                                $a_date =       $in_value[array_search("ACTION_DATE_STR", $columns)];
                                $a_time =       $in_value[array_search("ACTION_TIME_STR", $columns)];
                                $a_hall =       $in_value[array_search("HALL_NAME", $columns)];

                                $a_free_places =  ($in_value[array_search("FREE_PLACE_COUNT", $columns)] == 0)? 'Билетов нет' :  'мест: ' . $in_value[array_search("FREE_PLACE_COUNT", $columns)];
                                $a_minprice =     $in_value[array_search("MIN_PRICE", $columns)];
                                $a_maxprice =     $in_value[array_search("MAX_PRICE", $columns)];
                                $a_day_of_week =  $in_value[array_search("ACTION_DAY_OF_WEEK", $columns)];

                                $a_date_1 =       substr($in_value[array_search("ACTION_DATE", $columns)],0,2);
                                $a_date_2 =       (substr($a_date_1,0,1) == '0')? substr($a_date_1,1,1) : $a_date_1;

                                $a_mth_1 =          substr($in_value[array_search("ACTION_DATE", $columns)],3,2);

                                $a_minmaxString = ($a_minprice && $a_maxprice)? ($a_minprice == $a_maxprice)? 'по '. $a_minprice . ' руб.' : 'от ' . $a_minprice . ' до ' . $a_maxprice . ' руб.' : '';

                                $dates_html .=   '<a class="show-action-date-link" href="/'.$a_alias.'">'
                                                 .'<div class="show-action-date">'
                                                    .'<div class="s-a-train">'

                                                        .'<div class="s-a-vagon"><div class="s-a-date">'.$a_date_2.'<span class="s-a-mth">.'.$a_mth_1.'</span></div><div class="s-a-time">'.$a_time.'</div></div>'
                                                        .'<div class="s-a-vagon"><div class="s-a-places">'.$a_free_places.'</div><div class="s-a-prices">'.$a_minmaxString.'</div><div class="s-a-hall"><i class="fa fa-bank"></i>&nbsp;&nbsp;'.$a_hall.'</div></div>'

                                                    .'</div>'


                                                 .'<div class="s-a-buy">Выбрать</div></div></a>';

                            }

                            $dates_html .= '</div>';

                            $mth_indexer2 ++;
                        }

                        $dates_html .= '</div></div>';

                        echo $dates_html;

                        ?>


                </div>

<!--                <div class="flLeft one-action-date">--><?php //echo $act_date;?><!--, <span class="one-action-time">--><?php //echo $act_time; ?><!--</span>&nbsp;&nbsp;<span class="one-action-weekday">--><?php //echo $day_of_week; ?><!--</span>&nbsp;&nbsp;&nbsp;&nbsp;--><?php //echo $durationHtml; ?><!--</div>-->



                <div class="row">
                    <div class="col-md-12">
                        <div class="one-action-image-wrapper" style="background-image: url(<?php echo $poster;?>)"></div>

                        <div class="one-action-desc">

                            <div class="tabsParent sc_tabulatorParent">
                                <div class="tabsTogglersRow sc_tabulatorToggleRow">

                                    <div class="tabToggle sc_tabulatorToggler opened" dataitem="0" title="">
                                        <span class="">Описание</span>
                                    </div>

                                    <div class="tabToggle sc_tabulatorToggler " dataitem="1" title="">
                                        <span class="">Отзывы (6)</span>
                                    </div>

                                </div>

                                <div class="ddRow notZindexed sc_tabulatorDDRow">

                                    <div class="tabulatorDDItem sc_tabulatorDDItem opened noMaxHeight" dataitem="0">


                                        <?php echo $description;?>

                                    </div>

                                    <div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight" dataitem="1">



                                    </div>

                                </div>

                            </div>



                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="one-action-actors pr50 flLeft">
                            <div class="one-action-actors-header">Действующе лица:</div>

                            <ul>

                                <?php

                                // Подгружаем актеров

                                $actor_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actor_for_action</command><url>mirbileta.ru</url><action_id>".$act_id."</action_id>";

                                $ch = curl_init();

                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_URL, $actor_url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                                $resp2 = curl_exec($ch);

                                if(curl_errno($ch))
                                print curl_error($ch);
                                else
                                curl_close($ch);

                                $actor_columns = json_decode($resp2)->results["0"]->data_columns;
                                $actor_data = json_decode($resp2)->results["0"]->data;



                                $actors_html = "";

                                foreach ($actor_data as $key2 => $value2){

                                    $actor_id =     $value2[array_search("ACTOR_ID", $actor_columns)];
                                    $actor_alias =  $value2[array_search("ACTOR_URL_ALIAS", $actor_columns)];
                                    $actor_name =   $value2[array_search("ACTOR_NAME", $actor_columns)];
                                    $actor_image =  $value2[array_search("URL_IMAGE_MEDIUM", $actor_columns)];
                                    $actor_image_small =  $value2[array_search("URL_IMAGE_SMALL", $actor_columns)];




                                    $actors_html .= '<li data-id="'.$actor_id.'"><a class="one-action-actor-link" href="/'.$actor_alias.'"><div class="one-action-actor-image" style="background-image: url('.$actor_image_small.')"></div>'
                                                        .'<div class="one-action-actor-name">'.$actor_name.'</div>'
                                                    .'</a></li>';
                                }

//                                var_dump($actor_columns);
                                echo $actors_html;

                                ?>

                            </ul>

                        </div>
                        <div class="one-action-tags pr50 flLeft">

                            <div class="one-action-actors-header">Теги мероприятия:</div>
                            <div class="one-action-tags-body">
                                <?php

                                // Подгружаем актеров

                                $tag_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_action_tag</command><url>mirbileta.ru</url><action_id>".$act_id."</action_id>";
                                $tag_ids = '';
                                $ch = curl_init();

                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_URL, $tag_url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                                $resp3 = curl_exec($ch);

                                if(curl_errno($ch))
                                    print curl_error($ch);
                                else
                                    curl_close($ch);

                                $tag_columns = json_decode($resp3)->results["0"]->data_columns;
                                $tag_data = json_decode($resp3)->results["0"]->data;



                                $tag_html = "";
                                $indexer = 0;
                                foreach ($tag_data as $key3 => $value3){

                                    $tag_id =             $value3[array_search("ACTION_TAG_ID", $tag_columns)];
                                    $tag_name =           $value3[array_search("ACTION_TAG", $tag_columns)];

                                    $tag_html .= '<a class="action-tag-link" href="/extend_search?action_tag_id='.$tag_id.'"><div class="action-tag" data-id="'.$tag_id.'">'.$tag_name.'</div></a>';

                                    if($indexer == 0){
                                        $tag_ids .= $tag_id;
                                    }else{
                                        $tag_ids .= ','.$tag_id;
                                    }


                                    $indexer++;
                                }

    //                                                            var_dump($tag_columns);
    //                                                            var_dump($tag_data);

                                echo $tag_html;

                                ?>

                            </div>
                        </div>
                    </div>
                </div>





                <div class="row">
                    <div class="col-md-12">
                        <div class="similar-bg ">


                            <div class="one-action-similar-header">Похожие мероприятия:</div>
                            <div class="one-action-similar-wrapper actions-wrapper marTop40">
                                <?php

                                $similar_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>4</rows_max_num><action_tag_id>".$tag_ids."</action_tag_id>";

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

                                $sim_columns = json_decode($resp4)->results["0"]->data_columns;
                                $sim_data = json_decode($resp4)->results["0"]->data;


                                $sim_actionsHtml = "";

                                foreach ($sim_data as $key4 => $value4){

                                    $act_id =       $value4[array_search("ACTION_ID", $sim_columns)];
                                    $alias =        $value4[array_search("ACTION_URL_ALIAS", $sim_columns)];
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


                                    $sim_actionsHtml .=      '<div class="mb-block mb-action" data-id="'.$act_id.'">'
                                        .'<a href="/'.$alias.'"><div class="mb-a-image" style="background-image: url(\''.$poster.'\');"></div></a>'
                                        .'<a href="/'.$alias.'"><div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div></a>'
                                        .'<div class="mb-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                                        .'<div class="mb-a-venue">'.$venue.'</div>'
                                        .'<div class="mb-a-buy-holder">'
                                        .'<a href="/'.$alias.'"><div class="mb-buy mb-buy32 yellow">Купить билет</div></a>' //'.$minprice.' руб.
                                        .'</div>'
                                        .'</div>';
                                }

                                if(strlen($sim_actionsHtml) == 0){
                                    echo '<div class="somethinggoeswrong">-</div>';
                                }else{
                                    echo $sim_actionsHtml;
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="action-footer-info">
                            По всем вопросам покупки электронных билетов на мероприятие <?php echo $g_act_name; ?> обращайтесь по тел.: +7 (499) 391-<span>61</span>-97
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <?php

    get_footer();

    ?>


    <?php
    if($free_places > 0){


    ?>
        <script type="text/javascript" src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/widget.js"></script>
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