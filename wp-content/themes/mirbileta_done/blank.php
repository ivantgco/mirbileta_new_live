<?php
/*
    Template Name: blank
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

    <div class="container">

        <div class="mb-block-sh posRel flLeft wid100pr padLeft25 padRight70 withbottom">



            <h2><?php echo get_the_title($page_id);?></h2>

            <?php

            echo get_post($id)->post_content;

            ?>


            <div class="grey-bottom">

                Остались вопросы? Звоните: +7 (499) 391-<span>61</span>-97, подскажем!

            </div>

        </div>


    </div>
</div>

<?php

get_footer();

?>


</body>
