<?php
/*
    Template Name: account_orders
*/



    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>GET_DATA</command><object>order</object><url>".$global_salesite."</url><sid>ndrhSdvEApggSrkQDgpqlHosqVwGGArUcxSsetMxifkVomgBry</sid>";

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


    var_dump($resp);


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

<div class="site-content white-bg">
    <div class="site-container">

        <div class="site-sidebar">

            <div class="sidebar-block">
                <?php include('account_menu.php'); ?>
            </div>


        </div>
        <div class="mb-site-content">

            <div class="mb-personal-account-content">

                <div class="pa-intro-holder">





                </div>




                Фото

                Пол

                Возраст

                SHOW_TYPE

                Любимые исполнители

                Любимые авторы

                Комфортная цена билета

                Опишите как вы отдыхаете:

                - Все время мониторю кудаб сходить, хожу почти на все популярное
                - Слежу, хожу только на некоторые
                - Не слежу, меня зовут близкие
                - Попадаю куда либо редко и спонтанно
                - Вообще странно, что я здесь..

            </div>


        </div>

    </div>
</div>



<?php

get_footer();

?>


</body>
