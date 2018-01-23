<?php
/*
    Template Name: logotypes
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

<body <?php body_class(); ?> data-page="inner" >

<?php
get_header();
include('main_menu.php');

?>

<div class="site-content">

    <div class="contacts-fader">

    </div>
    <div class="container">


        <div class="blank-page wid100pr flLeft">
            <?php echo get_the_title($page_id);?>

            <h3>Для наружной рекламы:</h3>
            <div class="logotypes-line">
                <div class="logotype-item" style="background-image: url('assets/img/logo-dark.png')">Dark</div>
                <div class="logotype-item" style="background-image: url('assets/img/logo-light.png')">Light</div>
            </div>

        </div>

    </div>
</div>

<?php

get_footer();

?>


</body>
