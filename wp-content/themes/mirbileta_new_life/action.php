    <?php
    /*
        Template Name: single_action
    */

    $href = request_url();
    $arr = parse_url($href);
    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);


    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><action_url_alias>".$action_alias."</action_url_alias>";

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
    $alias =        $data[array_search("ACTION_URL_ALIAS", $columns)];
    $show_alias =   $data[array_search("SHOW_URL_ALIAS", $columns)];
    $frame =        $data[array_search("FRAME", $columns)];
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


    <div class="site-content white-bg action-page">
        <div class="site-container">

            <div class="site-sidebar">
                <div class="sidebar-block">

                </div>
            </div>

            <div class="mb-site-content">

                <h1 class="action-title" title="<?php echo $act_name; ?>"><?php echo $act_name; ?></h1>
                <div class="action-date"><?php echo $act_date .' '. $act_date_year; ?> <span class="weekday">(<?php echo $weekday_short;?>)</span> <?php echo $act_time;?></div>
                <div class="action-venue"><?php echo $hall; ?></div>

                <div class="image-gallery-holder">

                    <div class="ig-main-wrapper">
                        <img class="ig-main-img" src="http://www.sovremennik.ru/upload/resize_cache/iblock/1d0/1177_785_2/1d0873deece2ec66410a364b96a36d8f.JPG" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                    </div>

                    <div class="ig-list-wrapper">

                        <div class="ig-list-train">
                            <div class="ig-list-item">
                                <img class="ig-main-img" src="http://mirbileta.ru/images/gkd_1001.jpg" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                            </div>
                            <div class="ig-list-item">
                                <img class="ig-main-img" src="http://mirbileta.ru/images/sov_igra_v_djin.jpg" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                            </div>
                            <div class="ig-list-item video">
                                <img class="ig-main-img" src="http://www.sovremennik.ru/upload/resize_cache/iblock/1d0/1177_785_2/1d0873deece2ec66410a364b96a36d8f.JPG" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                                <div class="ig-video-corners"></div>
                            </div>
                            <div class="ig-list-item">
                                <img class="ig-main-img" src="http://mirbileta.ru/images/sov_jalta.jpg" alt="<?php echo $act_name; ?>" title="<?php echo $act_name; ?>" />
                            </div>
                        </div>

                    </div>

                </div>

                <h2 class="ap-title">Описание</h2>

                <div class="action-description">
                    В этот вечер с большим концертом и презентацией нового альбома «Mexico» выступит легендарный Хулио Иглесиас.

                    Творческий путь Хулио Иглесиаса, которого мировая пресса давно окрестила «Великим испанцем», просто невероятен: более 300 миллионов копий 80 альбомов, выпущенных во всем мире, более пяти тысяч концертов в 600 городах планеты, 2600 платиновых и золотых дисков, самые престижные музыкальные премии...

                    В начале своей карьеры он легко завоевал песенный олимп родины, а вскоре двинулся дальше, покоряя страны и континенты. «Испанский певец номер один» гастролировал по всей Европе, срывая овации на самых престижных концертных площадках. Покорение американского континента произошло после его выступления в Лос-Анджелесе со звёздами Голливуда и последовавших совместных записей с Дайаной Росс, Стиви Уандером и многими другими знаменитыми артистами. Но главным событием американского вояжа стал выход диска «Дуэты». Иглесиас добился своей цели: патриарх американской поп-музыки, маэстро Фрэнк Синатра, пригласил Иглесиаса исполнить вместе с ним песню «Summer Wind».

                    Он поет на испанском, итальянском, французском, английском и немецком языках. Это не только расширило аудиторию певца, но и повысило тиражи его записей. В «Книгу рекордов Гиннесса» Хулио Иглесиас попал как единственный обладатель бриллиантового диска, которого он удостоился за более чем 100 миллионов проданных альбомов на шести языках.

                    Публику покоряет сдержанная манера исполнения певца. Минимум жестов и движений — в центре внимания только голос, погружающий вас в глубины страсти, заставляющий сопереживать радостям и печалям. Он оказывает на слушателей поистине гипнотическое воздействие. Иглесиас обращается именно к вам и поёт только для вас. Единожды услышав, вы уже никогда ни с кем его не перепутаете.

                    Иглесиас легко импровизирует, но не меняет «классическое» звучание всеми любимых песен. Любая вещь в его интерпретации моментально узнается слушателями. Определение манеры и стиля исполнения Хулио Иглесиаса давно не вызывает споров — критики сошлись в точной формулировке: «квинтэссенция песен о любви». Однажды кто-то из них верно отметил, что музыкальные вкусы часто меняются, но мода на Хулио Иглесиаса не проходит.

                    Каждый концерт этого элегантного кабальеро проходит в приятной, романтической атмосфере: Хулио Иглесиас поёт сердцем, для всех сразу и каждого в отдельности. «Меня переполняет страсть. Я пою, чтобы продолжать жить», — признаётся певец.

                    Новый альбом «Mexico» и лучшие хиты артиста сделают этот вечер поистине незабываемым для каждого зрителя. Не пропустите!
                </div>


            </div>

        </div>
    </div>



            <?php

    get_footer();

    ?>


    <?php
    if($free_places > 0){


        //7562 бой
        //7556
        //7564 отменим

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