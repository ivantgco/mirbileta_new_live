<?php
/*
    Template Name: write_review
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

<div class="site-content ptsans">


    <div class="contacts-fader">

    </div>
    <div class="container">

        <div class="wr-header">
            Как вам мероприятие?
            <span class="wr-subtitle">Будьте объективны=)</span>
        </div>

        <div class="pr50">
            <div class="wr-group">
                <label>1.&nbsp;&nbsp;&nbsp;Напишите пару строк:</label>
                <textarea rows="5" class="wr-review-text"></textarea>
            </div>

            <div class="wr-group">
                <label>2.&nbsp;&nbsp;&nbsp;Может у вас есть фото или видео? Поделитесь!</label>

<!--                <div class="wr-review-file-add fa fa-plus">-->
                <div class="wr-review-file-holder">
                    <input class="wr-review-file" type="file" />
                </div>
<!--                </div>-->

            </div>

            <div class="wr-group">
                <label>3.&nbsp;&nbsp;&nbsp;Оцените по 10-бальнай шкале.</label>

                <div class="wr-review-rating-bar">
                    <div class="wr-review-rating-holder">
                        <div class="wr-review-rating"></div>
                    </div>
                    <div class="wr-review-rating-value">5.0</div>
                </div>
            </div>

            <div class="wr-group">
                <div class="wr-confirm"><i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Отправить</div>
                <div class="wr-error-holder"></div>
            </div>
        </div>

        <div class="pr50">

            <div class="wr-text">
                Отзывы, которые вы видите на нашем сайте
                появляются именно таким путем, доступ сюда имеют только те, кто действительно посетил мероприятие.
                Постарайтесь написать конструктивный отзыв, чтобы люди читающие его имели правильное
                представление о мероприятии!
                <br/><br/>
                Спасибо!
            </div>

        </div>


    </div>

</div>

<?php

get_footer();

?>


</body>
