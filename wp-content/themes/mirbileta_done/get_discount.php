<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 23.08.16
 * Time: 19:20
 */

/*
    Template Name: get_discount
*/


$page_id = get_the_ID();

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

    <body <?php body_class(); ?> data-page="inner"  data-filter="<?php echo $show_type_alias; ?>">

    <?php
    get_header();
    include('main_menu.php');

    ?>


    <div class="site-content">

        <div class="site-container">

<!--            <div class="site-sidebar">-->
<!---->
<!--                --><?php //include 'sidebar_calendar.php'; ?>
<!--                --><?php //include 'sidebar_special.php'; ?>
<!---->
<!--                --><?php //include 'sidebar_venues.php'; ?>
<!---->
<!--                --><?php //include 'sidebar_actors.php'; ?>
<!---->
<!--                <div class="sidebar-popular-holder sidebar-block">-->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->


            <div class="mb-site-content">


                <div class=""></div>


            </div>

        </div>

    </div>




    <?php

    get_footer();

    ?>


    </body>
</html>
