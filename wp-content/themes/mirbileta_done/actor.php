
<?php
//// Получаем свойства текущего MODX-шаблона
//$properties = $modx->resource->getOne('Template')->getProperties();
//
//
//
//if(!empty($properties['tpl'])){
//    $tpl = $properties['tpl'];
//}
//else{
//    $tpl = 'index.tpl';
//}
//
//// Если документ не кешируемый, то отключаем кеширование Smarty
//// (кеширование Smarty включается/выключается в настройках modxSmarty. По умолчанию отключено).
//if ($modx->resource->cacheable != '1') {
//    $modx->smarty->caching = false;
//}
//// Отрабатываем Smarty-шаблон и возвращаем результат
//
//$user_agent = $_SERVER['HTTP_USER_AGENT'];
//
//$ipod = strpos($user_agent,"iPod");
//$iphone = strpos($user_agent,"iPhone");
//$android = strpos($user_agent,"Android");
//$symb = strpos($user_agent,"Symbian");
//$winphone = strpos($user_agent,"WindowsPhone");
//$wp7 = strpos($user_agent,"WP7");
//$wp8 = strpos($user_agent,"WP8");
//$operam = strpos($user_agent,"Opera M");
//$palm = strpos($user_agent,"webOS");
//$berry = strpos($user_agent,"BlackBerry");
//$mobile = strpos($user_agent,"Mobile");
//$htc = strpos($user_agent,"HTC_");
//$fennec = strpos($user_agent,"Fennec/");
//$nokia = strpos($user_agent,"Nokia");
//
//if ($ipod || $iphone || $android || $symb || $winphone || $wp7 || $wp8 || $operam || $palm || $berry || $mobile || $htc || $fennec || $nokia) {
//    $modx->smarty->assign('mobileDevice', true);
//} else {
//    $modx->smarty->assign('mobileDevice', false);
//}
//
//
//return $modx->smarty->fetch("core/tpl/{$tpl}");
//
//?>

<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

//    $cur_url = $_SERVER["REQUEST_URI"];
//
//    $actor_alias = substr($cur_url, 1, (strlen($cur_url) - 2));
//    $actor_alias = (strpos($actor_alias, '-') > -1)? substr($actor_alias,0, strpos($actor_alias, '-')) : substr($cur_url, 1, (strlen($cur_url) - 2));

/*
    Template Name: single_actor
*/

    $href = request_url();
    $arr = parse_url($href);
    $actor_alias = preg_replace('/^\//','',$arr['path']);
    $actor_alias = preg_replace('/(^\w+)\/.*/','$1',$actor_alias);


    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actor</command><url>mirbileta.ru</url><actor_url_alias>".$actor_alias."</actor_url_alias>";

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
    $actor_id = $data[array_search("ACTOR_ID", $columns)];


//    define('BASE_PATH', dirname(dirname(__DIR__)) . '/plugins/Petrovich/');



    require_once ('wp-content/plugins/Petrovich/Petrovich.php');


    $petrovich = new Petrovich(Petrovich::GENDER_MALE);





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

    <?php include 'viewport.php'; ?>


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


    $ar_names = explode(' ',$data[array_search("ACTOR_NAME", $columns)]);
    $ar_name = $ar_names[0];
    $ar_surname = $ar_names[2];

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

            <h1 class="mb_h1 mh130">
                <?php

                echo $data[array_search("ACTOR_NAME", $columns)];


//                $petrovich->detectGender("Петрович");
//                $firstname = $petrovich->firstname($ar_name, Petrovich::CASE_INSTRUMENTAL); //   Александра;//CASE_INSTRUMENTAL
//                $lastname =  $petrovich->lastname($ar_surname, Petrovich::CASE_INSTRUMENTAL); //   Александра;//CASE_INSTRUMENTAL
//
//
//
////
////                echo $petrovich->detectGender("Петровна");  // Petrovich::GENDER_FEMALE (см. пункт Пол)
////                echo '<br /><strong>Родительный падеж:</strong><br />';
////                echo $petrovich->firstname($firstname, Petrovich::CASE_GENITIVE).'<br />'; //   Александра
////                echo $petrovich->middlename($middlename, Petrovich::CASE_GENITIVE).'<br />'; // Сергеевича
////                echo $petrovich->lastname($lastname, Petrovich::CASE_GENITIVE).'<br />'; //     Пушкина


                ?>


                <div class="mb-venue-to-actions">Смотреть афишу</div>

            </h1>


            <div class="mb-actor-image-and-desc">

                    <div class="col-md-4"><img src="<?php echo $data[array_search("URL_IMAGE_BIG", $columns)]; ?>"></div>

                    <div class="col-md-6"><?php echo $data[array_search("DESCRIPTION", $columns)]; ?></div>

            </div>





            <div class="mb-center-headline"><span class="venue-name">АФИША</span></div>
            <div class="mb-center-subheadline">В наличии билеты на мероприятия с <span class="venue-name">
<!--                    --><?php //echo $firstname . ' ' . $lastname; ?>
                    <?php echo $data[array_search("ACTOR_NAME", $columns)]; ?>
                </span>:</div>

            <div class="actions-wrapper marTop40">
                <?php


                $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_afisha</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>15</rows_max_num><actor_id>" . $actor_id . "</actor_id>";

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
                        .'<div class="mb-a-prices-and-buy"><div class="ma-a-prices">от '.$min_html.'&nbsp;<i class="fa fa-ruble"></i></div><div class="ma-a-buy">Купить билет</div></div>'
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
                    echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
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





<!--**********************************************************-->


<!---->
<!---->
<!--<!DOCTYPE html>-->
<!--<!--[if IE 7]>-->
<!--<html class="ie ie7" --><?php //language_attributes(); ?><!-->-->
<!--<![endif]-->-->
<!--<!--[if IE 8]>-->
<!--<html class="ie ie8" --><?php //language_attributes(); ?><!-->-->
<!--<![endif]-->-->
<!--<!--[if !(IE 7) | !(IE 8) ]><!-->-->
<!--<html --><?php //language_attributes(); ?><!-->-->
<!--<!--<![endif]-->-->
<!---->
<!---->
<!--<head>-->
<!---->
<!--    <meta charset="UTF-8"/>-->
<!---->
<!--    <title>--><?php //wp_title('-', true, 'right'); ?><!--</title>-->
<!---->
<!--    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->-->
<!---->
<!--    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">-->
<!---->
<!--    <meta name="viewport" content="width=device-width">-->
<!---->
<!---->
<!--    <link rel="profile" href="http://gmpg.org/xfn/11">-->
<!--    <link rel="pingback" href="--><?php //bloginfo('pingback_url'); ?><!--">-->
<!--    <link rel='stylesheet' id='main-style' href='--><?php //echo get_stylesheet_uri(); ?><!--' type='text/css' media='all'/>-->
<!---->
<!--    --><?php //wp_head(); ?>
<!---->
<!--</head>-->
<!---->
<!--<body --><?php //body_class(); ?><!--  data-actor="--><?php //echo $actor_id;?><!--" data-page="inner">-->
<!---->
<?php
//get_header();
//include('main_menu.php');
//?>
<!---->
<!---->
<!---->
<!--<div class="site-content actor-page">-->
<!---->
<!--    <div class="container">-->
<!---->
<!--        <div class="mb-block-sh posRel flLeft wid100pr">-->
<!---->
<!--            <h2 class="padLeft25">--><?php //echo $data[array_search("ACTOR_NAME", $columns)]; ?><!--</h2>-->
<!---->
<!--            <div class="single-image-holder pr30"style="background-image: url('--><?php //echo $data[array_search("URL_IMAGE_BIG", $columns)]; ?><!--')"></div>-->
<!---->
<!--            <div class="pr70">-->
<!--                <div class="plain-text padLeft25 padRight25">-->
<!--                    --><?php //echo $data[array_search("DESCRIPTION", $columns)]; ?>
<!--                </div>-->
<!---->
<!---->
<!---->
<!---->
<!--            </div>-->
<!---->
<!--            <div class="page-headline-wrapper flLeft marTop40 wid100pr">-->
<!--                <div class="p-h-line"></div>-->
<!--                <div class="p-h-title"><span>В мероприятиях:</span></div>-->
<!--            </div>-->
<!---->
<!---->
<!--            <div class="actions-wrapper flLeft wid100pr">-->
<!--                --><?php
//
//                $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_afisha</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>15</rows_max_num><actor_id>" . $actor_id . "</actor_id>";
//
//
//
//                $ch = curl_init();
//
//                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//                curl_setopt($ch, CURLOPT_URL, $url);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//
//                $resp = curl_exec($ch);
//
//                if (curl_errno($ch))
//                    print curl_error($ch);
//                else
//                    curl_close($ch);
//
//
//                $columns = json_decode($resp)->results["0"]->data_columns;
//                $data = json_decode($resp)->results["0"]->data;
//                $actions_count = count($data);
//                $show_next_button = $actions_count == 15;
//
//                $actionsHtml = "";
//
//                foreach ($data as $key => $value) {
//
//                    $act_id = $value[array_search("ACTION_ID", $columns)];
//                    $alias = (strlen($value[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? $value[array_search("SHOW_URL_ALIAS", $columns)] : $value[array_search("ACTION_URL_ALIAS", $columns)];
//                    $venue_alias = $value[array_search("VENUE_URL_ALIAS", $columns)];
//                    $frame = $value[array_search("FRAME", $columns)];
//                    $act_name = $value[array_search("ACTION_NAME", $columns)];
//                    $thumb =    (strlen($value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0)? (strpos("http", $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]: $defaultPoster;
//                    $poster =   (strlen($value[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0 ) ? (strpos("http" , $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultPoster;
////                    $poster = (strpos("http", $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_IMAGE", $columns)];
//                    $act_date = $value[array_search("ACTION_DATE_STR", $columns)];
//                    $act_time = $value[array_search("ACTION_TIME_STR", $columns)];
//                    $hall = $value[array_search("HALL", $columns)];
//                    $genre = $value[array_search("SHOW_GENRE", $columns)];
//                    $venue = $value[array_search("VENUE_NAME", $columns)];
//                    $minprice = $value[array_search("MIN_PRICE", $columns)];
//                    $maxprice = $value[array_search("MAX_PRICE", $columns)];
//
//                    $isInfo = strlen($description) > 0;
//                    $description = $value[array_search("DESCRIPTION", $columns)];
//
//                    $ageCat = strlen($value[array_search("AGE_CATEGORY", $columns)]) ? $value[array_search("AGE_CATEGORY", $columns)] : '0+';
//                    $act_date_time = $value[array_search("ACTION_DATE_TIME", $columns)];
//
//                    $short_date = to_afisha_date($act_date_time, "short_date", "rus");
//                    $short_date_with_year = to_afisha_date($act_date_time, "short_date_with_year", "rus");
//                    $week_and_time = to_afisha_date($act_date_time, "week_and_time", "rus");
//                    $weekday = to_afisha_date($act_date_time, "weekday", "rus");
//                    $time = to_afisha_date($act_date_time, "time", "rus");
//                    $isShow = (strlen($value[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? 'c': '';
//
//                    $actionsHtml .= '<div class="mb-block mb-action" data-id="' . $act_id . '">'
//                        . '<a href="/'.$alias.'"><div class="mb-a-image" style="background-image: url(\'' . $poster . '\');"></div></a>'
//                        . '<a href="/'.$alias.'"><div class="mb-a-title">' . $act_name . '<span class="mb-a-age">' . $ageCat . '</span></div></a>'
//                        . '<div class="mb-a-date"> '.$isShow.' ' . $act_date . ', <span class="mb-a-time">' . $act_time . '</span></div>'
//                        . '<a class="venue-link" href="/'.$venue_alias.'"><div class="mb-a-venue">' . $venue . '</div></a>'
//                        . '<div class="mb-a-buy-holder">'
//                        . '<a href="/'.$alias.'"><div class="mb-buy mb-buy32 soft">Купить билет</div></a>' //'.$minprice.' руб.
//                        . '</div>'
//                        . '</div>';
//                }
//
//                if (strlen($actionsHtml) == 0) {
//                    echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
//                } else {
//                    echo $actionsHtml;
//                }
//
//                //            echo $url;
//                ?>
<!--            </div>-->
<!---->
<!--            --><?php //if($show_next_button): ?>
<!---->
<!--                <div id="load_next" class="load_next_style_1">Загрузить еще</div>-->
<!---->
<!--            --><?php //endif ?>
<!---->
<!--        </div>-->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--    </div>-->
<!--</div>-->
<!---->
<?php
//
//get_footer();
//
//?>
<!---->
<!---->
<!--</body>-->



