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

<body <?php body_class(); ?>  data-actor="<?php echo $actor_id;?>" data-page="inner">
<div class="page-holder actor-page">


<?php
get_header();
?>

    <div class="mmb-big-image" style="background-image: url('<?php echo $data[array_search("URL_IMAGE_BIG", $columns)]; ?>')"></div>

    <div class="mmb-big-title"><?php echo $data[array_search("ACTOR_NAME", $columns)]; ?></div>

    <?php if(strlen($data[array_search("DESCRIPTION", $columns)]) > 0): ?>

        <div class="mmb-plain-text"><?php echo $data[array_search("DESCRIPTION", $columns)]; ?></div>

    <?php endif ?>



    <div class="mmb-mid-title">
        В мероприятиях:
    </div>

    <div class="actions-wrapper flLeft wid100pr">
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
            $alias = $value[array_search("ACTION_URL_ALIAS", $columns)];
            $venue_alias = $value[array_search("VENUE_URL_ALIAS", $columns)];
            $frame = $value[array_search("FRAME", $columns)];
            $act_name = $value[array_search("ACTION_NAME", $columns)];
            $thumb =    (strlen($value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0)? (strpos("http", $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]: $defaultPoster;
            $poster =   (strlen($value[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0 ) ? (strpos("http" , $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultPoster;
//                    $poster = (strpos("http", $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)] : $value[array_search("ACTION_POSTER_IMAGE", $columns)];
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
            $price_range = ($minprice && $maxprice)? ($minprice == $maxprice)? 'по ' . $minprice . ' руб.' : $minprice . ' - ' . $maxprice . ' руб.' : '';


            $actionsHtml .= '<a href="/'.$alias.'"><div class="mb-me-action" data-id="'.$act_id.'">'
                .'<div class="mb-me-a-image" style="background-image: url(\''.$poster.'\');"></div>'
                .'<div class="mb-me-a-title">'.$act_name.'<span class="mb-me-a-age">'.$ageCat.'</span></div>'
                .'<div class="mb-me-a-venue">'.$venue.'</div>'
                .'<div class="mb-me-a-price">'.$price_range.'</div>'
                .'<div class="mb-me-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                .'</div></a>';
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




<?php

include('custom_footer.php');

?>

</div>
</body>
