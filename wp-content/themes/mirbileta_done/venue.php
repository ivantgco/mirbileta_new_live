<?php
/*
    Template Name: single_venue
*/

//    $cur_url = $_SERVER["REQUEST_URI"];
//
//    $venue_alias = substr($cur_url, 1, (strlen($cur_url) - 2));
//    $venue_alias = (strpos($venue_alias, '-') > -1)? substr($venue_alias,0, strpos($venue_alias, '-')) : substr($cur_url, 1, (strlen($cur_url) - 2));

    $href = request_url();
    $arr = parse_url($href);
    $venue_alias = preg_replace('/^\//','',$arr['path']);
    $venue_alias = preg_replace('/(^\w+)\/.*/','$1',$venue_alias);



    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_venue</command><url>mirbileta.ru</url><venue_url_alias>".$venue_alias."</venue_url_alias>";


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

    $jData = json_decode($data);

    $columns = json_decode($resp)->results["0"]->data_columns;
    $data = json_decode($resp)->results["0"]->data[0];
    $venue_id = $data[array_search("VENUE_ID", $columns)];
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
    <?php include 'seo.php'; ?>

<!--    <title>--><?php //wp_title('-', true, 'right'); ?><!--</title>-->

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width">


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner" data-venue="<?php echo $venue_id;?>" data-border="noborder">

<?php
get_header();
include('main_menu.php');
//echo $url;

$address = $data[array_search("VENUE_ADDRESS", $columns)];
$g_address = $data[array_search("VENUE_GOGLE_ADDRESS", $columns)];



?>



<div class="site-content">


    <div class="site-container">

        <div class="site-sidebar">

            <?php include 'sidebar_calendar.php'; ?>
            <?php include 'sidebar_special.php'; ?>

            <?php include 'sidebar_venues.php'; ?>

            <?php include 'sidebar_actors.php'; ?>

            <div class="sidebar-popular-holder sidebar-block">

            </div>

        </div>

        <div class="mb-site-content">

            <div class="mirbileta-get-discount-holder">
                <a target="_blank" href="/get_discount"><div class="mirbileta-get-discount"></div></a>
            </div>

            <h1 class="mb_h1">
                <?php echo $data[array_search("VENUE_NAME", $columns)]; ?>

                <div class="sinlge-subtitle-holder"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo $data[array_search("VENUE_ADDRESS", $columns)]; ?><span class="mb-show-map">Как добраться?</span></div>

                <div class="mb-venue-to-actions">Смотреть афишу</div>

<!--                <div class="single-title-holder wid100pr flLeft">-->
<!--                    <div class="mb-venue-to-actions mb-buy blue mb-buy32">Смотреть афишу</div>-->
<!--                </div>-->

            </h1>



            <?php if(strlen($address) > 0): ?>

                <div class="one-action-gmap">

                    <input id="address" type="hidden" value="<?php echo $g_address; ?>" />

                    <div style=" width: 100%; height: 280px;" id="map_canvas"></div>

                </div>

            <?php endif; ?>


            <div class="mb-venue-image-and-desc">

                <div class="mb-venue-image">

                    <div class="single-big-image-holder" style="background-image: url('<?php echo $data[array_search("VENUE_URL_IMAGE_BIG", $columns)]; ?>')"></div>

                </div>

                <div class="mb-venue-desc">

<?php
/* Выводим содержимое страницы, если оно есть, если его нет выводится curl запрос */
if (have_posts()) :
   while (have_posts()) :
      the_post();
         $mb_page_cont = get_the_content();
   endwhile;
endif;

if ($mb_page_cont !== '') {
  echo $mb_page_cont;
}
else {
  echo $data[array_search("VENUE_DESCRIPTION", $columns)];
}

?>

                </div>

            </div>





            <div class="mb-center-headline"><span class="venue-name">АФИША</span></div>
            <div class="mb-center-subheadline">В наличии билеты в <span class="venue-name"><?php echo $data[array_search("VENUE_NAME", $columns)]; ?></span> на мероприятия:</div>

            <div class="mb-center-search-holder"><input type="text" data-venue="<?php echo $data[array_search("VENUE_ID", $columns)]; ?>" class="mb-center-search" placeholder="Поиск мероприятий"/><div class="mb-center-search-hint">Введите 3 символа и начнем поиск</div></div>

            <div class="actions-wrapper marTop40 venue-content">
                <?php


                $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_afisha</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>15</rows_max_num><venue_id>" . $venue_id . "</venue_id>";

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
                $data = json_decode($resp)->results["0"]->data;
                $actions_count = count($data);
                $show_next_button = $actions_count == 15;

                $actionsHtml = "";

                foreach ($data as $key => $value) {

                    $act_id = $value[array_search("ACTION_ID", $columns)];
                    $alias = (strlen($value[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? $value[array_search("SHOW_URL_ALIAS", $columns)] : $value[array_search("ACTION_URL_ALIAS", $columns)];
                    $frame = $value[array_search("FRAME", $columns)];
                    $act_name = $value[array_search("ACTION_NAME", $columns)];
                    $thumb = (strlen($value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0)? (strpos("http", $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $defaultPoster;
                    $poster = (strlen($value[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0 )? (strpos("http" , $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultPoster;
//                $poster = (strpos("http", $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_IMAGE", $columns)];
                    $act_date = $value[array_search("ACTION_DATE_STR", $columns)];
                    $act_time = $value[array_search("ACTION_TIME_STR", $columns)];
                    $hall = $value[array_search("HALL", $columns)];
                    $genre = $value[array_search("SHOW_GENRE", $columns)];
                    $venue = $value[array_search("VENUE_NAME", $columns)];
                    $minprice = $value[array_search("MIN_PRICE", $columns)];
                    $maxprice = $value[array_search("MAX_PRICE", $columns)];

                    $isInfo = strlen($description) > 0;
                    $description = $value[array_search("DESCRIPTION", $columns)];

                    $ageCat = strlen($value[array_search("AGE_CATEGORY", $columns)]) ? $value[array_search("AGE_CATEGORY", $columns)] : '0+';
                    $act_date_time = $value[array_search("ACTION_DATE_TIME", $columns)];

                    $short_date = to_afisha_date($act_date_time, "short_date", "rus");
                    $short_date_with_year = to_afisha_date($act_date_time, "short_date_with_year", "rus");
                    $week_and_time = to_afisha_date($act_date_time, "week_and_time", "rus");
                    $weekday = to_afisha_date($act_date_time, "weekday", "rus");
                    $time = to_afisha_date($act_date_time, "time", "rus");
                    $isShow = (strlen($value[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? 'c': '';


                    $prices_str = ($minprice || $minprice)? ( $minprice == $maxprice)? 'от&nbsp;'.$minprice . '&nbsp;<i class="fa fa-ruble"></i>' : 'от&nbsp;'.$minprice . '&nbsp;<i class="fa fa-ruble"></i>': '&nbsp;';

                    $fee =              $value[array_search("SERVICE_FEE", $columns)];
                    $min =              $value[array_search("MIN_PRICE", $columns)];
                    $max =              $value[array_search("MAX_PRICE", $columns)];

                    if((int)$fee < 0){

                        $min_discounted = (int)$min - ((int)$min / 100 * abs((int)$fee));
                        $max_discounted = (int)$max - ((int)$max / 100 * abs((int)$fee));

                        $min_html = '<span class="mb-old-price">'.$min.'&nbsp;<i class="fa fa-ruble"></i></span>' . $min_discounted;
                        $max_html = '<span class="mb-old-price">'.$max.'&nbsp;<i class="fa fa-ruble"></i></span>' . $max_discounted;

                    }else{

                        $min_html = $min;
                        $max_html = $max;

                    }

                    $actionsHtml .=  ''
                                        .'<div class="mb-block mb-action" data-id="'.$act_id.'"><a href="/'.$alias.'">'
                                            .'<div class="mb-action-image-holder"><img src="'.$poster.'"></div>'
                                            .'<div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div>'
                                            .'<div class="mb-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                                            .'<div class="mb-a-venue">'.$venue.'</div>'
                                            .'<div class="mb-a-prices-and-buy"><div class="ma-a-prices">от '.$min_html.'&nbsp;<i class="fa fa-ruble"></i></div><div class="ma-a-buy"><button class="learn-more ma-a-buy__btn">
                                            <div class="circle">
                                              <span class="icon arrow"></span>
                                            </div>
                                            <p class="button-text">Купить билет</p>
                                          </button></div></div>'
                                        .'</a></div>'
                                    .'';

//                        '<a href="/'.$alias.'"><div class="mb-block mb-action" data-id="'.$act_id.'">'
//                                            .'<div class="mb-action-image-holder"><img src="'.$poster.'"></div>'
//                                            .'<div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div>'
//                                            .'<div class="mb-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div></a>'
//                                            .'<a class="venue-link" href="/'.$venue_alias.'"><div class="mb-a-venue">'.$venue.'</div></a>'
//                                            .'<a href="/'.$alias.'"><div class="mb-a-prices-and-buy"><div class="ma-a-prices">'.$prices_str.'</div><div class="ma-a-buy">Купить билет</div></div>'
//                                            .'</div></a>';
                }

                if (strlen($actionsHtml) == 0) {
                    echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (495) 005-30-23 </div>';
                } else {
                    echo $actionsHtml;
                }

                //            echo $url;
                ?>
            </div>

            <?php if($show_next_button): ?>

                <div id="load_next" class="load_next_style_1">Загрузить еще</div>

            <?php endif ?>



        </div>

    </div>

</div>

<?php

get_footer();

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
        //                            alert("No results found");
                                }
                            } else {
        //                        alert("Geocode was not successful for the following reason: " + status);
                            }
                        });
                    }
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            });
        </script>
    <?php endif ?>