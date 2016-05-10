<?php
/*
    Template Name: main_page_2
*/

//include ("../../../vendor/fightbulc/moment/src/Moment.php");

//include 'zaglushka.php';
//return false;

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
    include('slider.php');
//    include('main_menu_main.php');

?>






<div class="site-content white-bg">
    <div class="site-container">

        <div class="site-sidebar">

<!--            <div style="background-color: red; height: 40px; width: 100%;"></div>-->

            <div class="sidebar-popular-holder sidebar-block">
                <?php include('sidebar-popular.php'); ?>
            </div>
            <div class="sidebar-search-holder sidebar-block">
                <?php include('sidebar-search.php'); ?>
            </div>
            <div class="sidebar-calendar-holder sidebar-block">
                <?php include('sidebar-calendar.php'); ?>
            </div>
            <div class="sidebar-tags-holder sidebar-block">
                <?php include('sidebar-tags.php'); ?>
            </div>
            <div class="sidebar-filters-holder sidebar-block"></div>
            <div class="sidebar-price-holder sidebar-block"></div>
            <div class="sidebar-groups-holder sidebar-block"></div>

        </div>
        <div class="mb-site-content">
<!--            <div style="background-color: red; height: 40px; width: 100%;"></div>-->
        </div>




<!--        <div class="content-block most-important">-->
<!---->
<!--            --><?php //include('top_sales.php'); ?>
<!---->
<!--        </div>-->
<!---->
<!--        <div class="content-block extend-search">-->
<!---->
<!--            --><?php //include('extend_search.php'); ?>
<!---->
<!--        </div>-->
<!---->
<!--        <div class="content-block nearrest-aсtions">-->
<!---->
<!--            --><?php //include('nearrest_actions.php'); ?>
<!---->
<!--        </div>-->
    </div>
</div>

<?php

    get_footer();

?>


</body>
