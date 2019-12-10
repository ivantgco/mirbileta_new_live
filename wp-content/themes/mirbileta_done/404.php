<?php
/*
    Template Name: 404
*/

$url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url>";

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

$ran1 = $data[rand(0, count($data))];
$ran2 = $data[rand(0, count($data))];

$actionsHtml = '';

$act_id =       $ran1[array_search("ACTION_ID", $columns)];
$alias =        $ran1[array_search("ACTION_URL_ALIAS", $columns)];
$frame =        $ran1[array_search("FRAME", $columns)];
$act_name =     $ran1[array_search("ACTION_NAME", $columns)];
$g_act_name =     $ran1[array_search("ACTION_NAME", $columns)];
$thumb = (strlen($ran1[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0) ? (strpos("http", $ran1[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://' . $global_url . '/upload/' . $ran1[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $ran1[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $defaultPoster;
$poster = (strlen($ran1[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0) ? (strpos("http", $ran1[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?                          $global_prot . '://' . $global_url . '/upload/' . $ran1[array_search("ACTION_POSTER_IMAGE", $columns)] : $ran1[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultPoster;
$act_date =     $ran1[array_search("ACTION_DATE_STR", $columns)];
$act_time =     $ran1[array_search("ACTION_TIME_STR", $columns)];
$hall =         $ran1[array_search("HALL_NAME", $columns)];
$genre =        $ran1[array_search("SHOW_GENRE", $columns)];
$venue =        $ran1[array_search("VENUE_NAME", $columns)];
$address =      $ran1[array_search("HALL_ADDR", $columns)];
$g_address =    $ran1[array_search("HALL_GOOGLE_ADDRESS", $columns)];
$free_places =  $ran1[array_search("FREE_PLACE_COUNT", $columns)];
$minprice =     $ran1[array_search("MIN_PRICE", $columns)];
$maxprice =     $ran1[array_search("MAX_PRICE", $columns)];
$day_of_week =  $ran1[array_search("ACTION_DAY_OF_WEEK", $columns)];
$duration =     $ran1[array_search("DURATION_HOUR_MIN", $columns)];
$is_wo =        $ran1[array_search("ACTION_TYPE", $columns)] == 'ACTION_WO_PLACES';
$sbag =         $ran1[array_search("SPLIT_BY_AREA_GROUP", $columns)] == 'TRUE';
$tag_list =     $ran1[array_search("ACTION_TAG_LIST", $columns)];
$actor_list =   $ran1[array_search("ACTION_ACTOR_LIST", $columns)];

$isInfo = strlen($description) > 0;
$description = $ran1[array_search("DESCRIPTION", $columns)];

$ageCat = strlen($ran1[array_search("AGE_CATEGORY", $columns)]) ? $ran1[array_search("AGE_CATEGORY", $columns)] : '0+';
$act_date_time = $ran1[array_search("ACTION_DATE_TIME", $columns)];

$short_date = to_afisha_date($act_date_time, "short_date", "rus");
$short_date_with_year = to_afisha_date($act_date_time, "short_date_with_year", "rus");
$week_and_time = to_afisha_date($act_date_time, "week_and_time", "rus");
$weekday = to_afisha_date($act_date_time, "weekday", "rus");
$time = to_afisha_date($act_date_time, "time", "rus");





/*---------------*/



$act_id2 =       $ran2[array_search("ACTION_ID", $columns)];
$alias2 =        $ran2[array_search("ACTION_URL_ALIAS", $columns)];
$frame2 =        $ran2[array_search("FRAME", $columns)];
$act_name2 =     $ran2[array_search("ACTION_NAME", $columns)];
$g_act_name2 =     $ran2[array_search("ACTION_NAME", $columns)];
$thumb2 = (strlen($ran2[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0) ? (strpos("http", $ran2[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://' . $global_url . '/upload/' . $ran2[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $ran2[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $defaultPoster;
$poster2 = (strlen($ran2[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0) ? (strpos("http", $ran2[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?                          $global_prot . '://' . $global_url . '/upload/' . $ran2[array_search("ACTION_POSTER_IMAGE", $columns)] : $ran2[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultPoster;
$act_date2 =     $ran2[array_search("ACTION_DATE_STR", $columns)];
$act_time2 =     $ran2[array_search("ACTION_TIME_STR", $columns)];
$hall2 =         $ran2[array_search("HALL_NAME", $columns)];
$genre2 =        $ran2[array_search("SHOW_GENRE", $columns)];
$venue2 =        $ran2[array_search("VENUE_NAME", $columns)];
$address2 =      $ran2[array_search("HALL_ADDR", $columns)];
$g_address2 =    $ran2[array_search("HALL_GOOGLE_ADDRESS", $columns)];
$free_places2 =  $ran2[array_search("FREE_PLACE_COUNT", $columns)];
$minprice2 =     $ran2[array_search("MIN_PRICE", $columns)];
$maxprice2 =     $ran2[array_search("MAX_PRICE", $columns)];
$day_of_week2 =  $ran2[array_search("ACTION_DAY_OF_WEEK", $columns)];
$duration2 =     $ran2[array_search("DURATION_HOUR_MIN", $columns)];
$is_wo2 =        $ran2[array_search("ACTION_TYPE", $columns)] == 'ACTION_WO_PLACES';
$sbag2 =         $ran2[array_search("SPLIT_BY_AREA_GROUP", $columns)] == 'TRUE';
$tag_list2 =     $ran2[array_search("ACTION_TAG_LIST", $columns)];
$actor_list2 =   $ran2[array_search("ACTION_ACTOR_LIST", $columns)];

$isInfo2 = strlen($description) > 0;
$description2 = $ran2[array_search("DESCRIPTION", $columns)];

$ageCat2 = strlen($ran2[array_search("AGE_CATEGORY", $columns)]) ? $ran2[array_search("AGE_CATEGORY", $columns)] : '0+';
$act_date_time2 = $ran2[array_search("ACTION_DATE_TIME", $columns)];

$short_date2 = to_afisha_date($act_date_time, "short_date", "rus");
$short_date_with_year2 = to_afisha_date($act_date_time, "short_date_with_year", "rus");
$week_and_time2 = to_afisha_date($act_date_time, "week_and_time", "rus");
$weekday2 = to_afisha_date($act_date_time, "weekday", "rus");
$time2 = to_afisha_date($act_date_time, "time", "rus");

$prices_str = ($minprice || $minprice) ? ($minprice == $maxprice) ? 'от&nbsp;' . $minprice . '&nbsp;<i class="fa fa-ruble"></i>' : 'от&nbsp;' . $minprice . '&nbsp;<i class="fa fa-ruble"></i>' : '&nbsp;';
$prices_str2 = ($minprice2 || $minprice2) ? ($minprice2 == $maxprice2) ? 'от&nbsp;' . $minprice2 . '&nbsp;<i class="fa fa-ruble"></i>' : 'от&nbsp;' . $minprice2 . '&nbsp;<i class="fa fa-ruble"></i>' : '&nbsp;';


$actionsHtml .=  ''
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


$actionsHtml .=  ''
    . '<div class="mb-block mb-action" data-id="' . $act_id2 . '"><a href="/' . $alias2 . '">'
    . '<div class="mb-action-image-holder"><img src="' . $poster2 . '"></div>'
    . '<div class="mb-a-title">' . $act_name2 . '<span class="mb-a-age">' . $ageCat2 . '</span></div>'
    . '<div class="mb-a-date">' . $act_date2 . ', <span class="mb-a-time">' . $act_time2 . '</span></div>'
    . '<div class="mb-a-venue">' . $venue2 . '</div>'
    . '<div class="mb-a-prices-and-buy"><div class="ma-a-prices">' . $prices_str2 . '</div><div class="ma-a-buy"><button class="learn-more ma-a-buy__btn">
    <div class="circle">
      <span class="icon arrow"></span>
    </div>
    <p class="button-text">Купить билет</p>
  </button></div></div>'
    . '</a></div>'
    . '';

//$actionsHtml .=      '<div class="mb-block mb-action" data-id="'.$act_id2.'">'
//    .'<a href="/'.$alias2.'"><div class="mb-a-image" style="background-image: url(\''.$poster2.'\');"></div></a>'
//    .'<a href="/'.$alias2.'"><div class="mb-a-title">'.$act_name2.'<span class="mb-a-age">'.$ageCat2.'</span></div></a>'
//    .'<div class="mb-a-date">'.$act_date2.', <span class="mb-a-time">'.$act_time2.'</span></div>'
//    .'<div class="mb-a-venue">'.$venue2.'</div>'
//    .'<div class="mb-a-buy-holder">'
//    .'<a href="/'.$alias2.'"><div class="mb-buy mb-buy32 soft">Купить билет</div></a>' //'.$minprice.' руб.
//    .'</div>'
//    .'</div>';

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
    <!--    <title>--><?php //wp_title('-', true, 'right'); 
                        ?>
    <!--</title>-->

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width">


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

    <div class="site-content">

        <div class="container">

            <h1 class="cl404">404 <span class="notfound">Страница не найдена, выберите что-нибудь себе по вкусу в <a href="/">Афише</a></span></h1>
            <h1 style="margin-bottom: 50px;">А вот Вам пара случайных мероприятий =)</h1>
            <div class="actions-wrapper">
                <?php

                echo $actionsHtml;

                ?>
            </div>

        </div>
    </div>

    <?php

    get_footer();

    ?>


</body>