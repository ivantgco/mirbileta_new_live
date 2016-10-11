<?php
/*
    Template Name: filter
*/



$page_id = get_the_ID();

$parseUrl = $_GET['action'];

$from_date =         $_GET['from_date'];
$to_date =           $_GET['to_date'];

$search_keyword =    $_GET["search_keyword"];

$show_type_alias =   get_field('show_type_filter');

$url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_afisha</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>15</rows_max_num>";

if(strlen($from_date) > 0) { $url .= '<from_date>'.$from_date.'</from_date>'; }
if(strlen($to_date) > 0) { $url .= '<to_date>'.$to_date.'</to_date>'; }
if(strlen($search_keyword) > 0) { $url .= '<search_keyword>'.$search_keyword.'</search_keyword>'; }
if(strlen($show_type_alias) > 0) { $url .= '<show_type_alias>'.$show_type_alias.'</show_type_alias>'; }

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

    <?php include 'viewport.php';?>


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner"  data-filter="<?php echo $show_type_alias; ?>">
<div class="page-holder filter-page">


<?php
get_header();

?>

<div class="site-content">

    <div class="mmb-headline"><?php echo get_the_title($page_id);?>:</div>


    <div class="filter-page-content">



        <div class="filter-page-filters-wrapper flLeft wid100pr">

            <div class="mb-tf-block" data-filter="search"></div>
            <div class="mb-tf-block" data-filter="daterange"></div>
            <div class="filter-page-filters-buttons">

                <div class="f-buttons-holder">
                    <div class="holder35 flLeft">
                        <div class="clear-filters">Сборсить</div>
                    </div>
                    <div class="holder65 flLeft">
                        <div class="submit-filters">Показать <span class="filter-count-actions"></span></div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!--        </div>-->
    <div class="container">
        <div class="actions-wrapper marTop40">

            <?php

            $actionsHtml = "";

            foreach ($data as $key => $value){

                $act_id =       $value[array_search("ACTION_ID", $columns)];
                $alias =        (strlen($value[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? $value[array_search("SHOW_URL_ALIAS", $columns)] : $value[array_search("ACTION_URL_ALIAS", $columns)];
                $venue_alias =        $value[array_search("VENUE_URL_ALIAS", $columns)];
                $frame =        $value[array_search("FRAME", $columns)];
                $act_name =     $value[array_search("ACTION_NAME", $columns)];
                $thumb =        (strlen($value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0) ? (strpos("http" , $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]: $defaultPoster;
                $poster =       (strlen($value[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0) ? (strpos("http" , $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_IMAGE", $columns)]: $defaultPoster;
                $act_date =     to_short_mth($value[array_search("ACTION_DATE_STR", $columns)]);
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

                $price_range = ($minprice && $maxprice)? ($minprice == $maxprice)? 'по ' . $minprice . ' руб.' : $minprice . ' - ' . $maxprice . ' руб.' : '';

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

                $actionsHtml .= '<a href="/'.$alias.'"><div class="mb-me-action" data-id="'.$act_id.'">'
                    .'<div class="mb-me-a-image" style="background-image: url(\''.$poster.'\');"></div>'
                    .'<div class="mb-me-a-title">'.$act_name.'<span class="mb-me-a-age">'.$ageCat.'</span></div>'
                    .'<div class="mb-me-a-venue">'.$venue.'</div>'
                    .'<div class="mb-me-a-price">от '.$min_html.'&nbsp;<i class="fa fa-ruble"></i></div>'
                    .'<div class="mb-me-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                    .'</div></a>';
            }

            if(strlen($actionsHtml) == 0){
                echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
            }else{
                echo $actionsHtml;
            }
            ?>
        </div>

        <?php if($show_next_button): ?>

            <div id="load_next" class="load_next_style_1">Загрузить еще</div>

        <?php endif ?>
    </div>

</div>

<?php

include('custom_footer.php');

?>
</div>

</body>
