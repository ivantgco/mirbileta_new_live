<?php
/*
    Template Name: test
*/

    $order_id = $_POST['order_id'];


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

<div class="site-content thanks-page">

    <div class="container">

        <div id="multibooker-widget-wrapper"
             data-actions=""
             data-widget_theme="light"
             data-withdelivery="false"
             data-mirbileta="true"
             data-width=""
             data-frame="sdfsd9f8uorj83421o901hndhfs78df5t61yu4g1dck3h1239186yhoi"
             data-host=<?php echo $global_prot ."://". $global_url.'/'; ?>
             data-ip="<?php echo $global_url; ?>">

            <div class="mirbileta-widget-wrapper-wait-text"><i class="fa fa-cog fa-spin"></i>&nbsp;&nbsp;Подождите, загружается модуль продажи билетов...</div>

        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/widget.js"></script>

<?php

get_footer();

?>


</body>
