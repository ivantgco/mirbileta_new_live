<?php
/*
    Template Name: multibooker
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

<div class="mmb-page-holder blank-page multibooker-page">
    <?php
    get_header();
    ?>

    <div class="mmb-blank-wrapper">

        <div class="mmb-headline">
            <?php echo get_the_title($page_id);?>
        </div>
        <div class="mmb-plain-text">
            <?php

            echo get_post($id)->post_content;

            ?>
        </div>

    </div>

    <?php

    include('custom_footer.php');

    ?>
</div>



</body>
