<?php
/*
    Template Name: test
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

<div class="mmb-page-holder blank-page">
    <?php
    get_header();
    ?>



    <div id="multibooker-widget-wrapper"
         data-action_id="3037"
         data-frame="kjhsdfsd87789sdfjs734j238dsj834g234i58skdu4y3278gyujwe7r3"
         data-host="https://shop.mirbileta.ru/"
         data-ip="shop.mirbileta.ru">
    </div>

    <script type="text/javascript" src="https://shop.mirbileta.ru/assets/widget/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://shop.mirbileta.ru/assets/widget/widget-mobile.js"></script>


    <?php

    include('custom_footer.php');

    ?>
</div>



</body>
