<?php
/*
    Template Name: main_page_2
*/


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

    <title><?php wp_title( '-', true, 'right' ); ?></title>

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width">


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>




<?php
    get_header();

    include 'main_menu.php';

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

            <?php include 'main_slider.php';?>

            <h1 class="mb_h1">Обратите внимание на эти мероприятия:</h1>

            <?php include 'top_sales.php'; ?>

            <h1 class="mb_h1">Ближайшие мероприятия:</h1>

            <?php include 'main_page_actions.php'; ?>

            <h1 class="mb_h1">Спланируйте культурную программу заранее:</h1>

            <?php include 'nearrest_actions.php'; ?>

        </div>

    </div>
    
</div>


<?php

    get_footer();

?>


</body>
