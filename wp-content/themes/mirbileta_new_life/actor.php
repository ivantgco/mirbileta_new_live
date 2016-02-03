<?php
/*
    Template Name: single_actor
*/
    $cur_url = $_SERVER["REQUEST_URI"];

    $actor_alias = substr($cur_url, 1, (strlen($cur_url) - 2));
    $actor_alias = (strpos($actor_alias, '-') > -1)? substr($actor_alias,0, strpos($actor_alias, '-')) : substr($cur_url, 1, (strlen($cur_url) - 2));

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



<div class="site-content">

    <div class="container">


        <div class="row">
            <div class="col-md-12">
                <div class="mb-block marTop40 marBot40">
                <div class="single-image-holder pr30"style="background-image: url('<?php echo $data[array_search("URL_IMAGE_BIG", $columns)]; ?>')"></div>

                <div class="single-a-title-holder pr70">
                    <?php echo $data[array_search("ACTOR_NAME", $columns)]; ?>
<!--                    <div class="sinlge-subtitle-holder">-->
<!--                        <i class="fa fa-map-marker"></i>&nbsp;&nbsp;--><?php //echo $data[array_search("ACTOR_ADDRESS", $columns)]; ?>
<!--                        <a class="single-ext-link" href="--><?php //echo $data[array_search("SITE_URL", $columns)]; ?><!--" target="_blank">Сайт площадки</a>-->
<!--                    </div>-->
                </div>

                <div class="single-a-desc-holder chromeScroll pr70">
                    <?php echo $data[array_search("ACTOR_DESCRIPTION", $columns)]; ?>
                </div>
                </div>
            </div>
        </div>


<!--        <div class="row marBot40">-->
<!--            <div class="col-md-12">-->
<!--                <div class="single-map-holder"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d8982.005857353408!2d37.6140337!3d55.749790600000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1453912939564" width="100%" height="280" frameborder="0" style="border:0" allowfullscreen></iframe></div>-->
<!---->

<!--            </div>-->
<!--        </div>-->

        <div class="page-headline-wrapper">
            <div class="p-h-line"></div>
            <div class="p-h-title"><span>В мероприятиях:</span></div>
        </div>

        <div class="actions-wrapper marTop40">
            <?php

            $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>15</rows_max_num><actor_id>" . $actor_id . "</actor_id>";



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
            $data = json_decode($resp)->results["0"]->data;
            $actions_count = count($data);


            $actionsHtml = "";

            foreach ($data as $key => $value) {

                $act_id = $value[array_search("ACTION_ID", $columns)];
                $alias = $value[array_search("ACTION_URL_ALIAS", $columns)];
                $frame = $value[array_search("FRAME", $columns)];
                $act_name = $value[array_search("ACTION_NAME", $columns)];
                $thumb = (strpos("http", $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)];
                $poster = (strpos("http", $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_IMAGE", $columns)];
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

                $actionsHtml .= '<div class="mb-block mb-action" data-id="' . $act_id . '">'
                    . '<div class="mb-a-image" style="background-image: url(\'' . $poster . '\');"></div>'
                    . '<div class="mb-a-title">' . $act_name . '<span class="mb-a-age">' . $ageCat . '</span></div>'
                    . '<div class="mb-a-date">' . $act_date . ', <span class="mb-a-time">' . $act_time . '</span></div>'
                    . '<div class="mb-a-venue">' . $venue . '</div>'
                    . '<div class="mb-a-buy-holder">'
                    . '<a href="/'.$alias.'"><div class="mb-buy mb-buy32 soft">Купить билет</div></a>' //'.$minprice.' руб.
                    . '</div>'
                    . '</div>';
            }

            if (strlen($actionsHtml) == 0) {
                echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
            } else {
                echo $actionsHtml;
            }

            //            echo $url;
            ?>
        </div>

    </div>
</div>

<?php

get_footer();

?>


</body>
