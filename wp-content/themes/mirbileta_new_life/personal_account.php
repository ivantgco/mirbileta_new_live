<?php
/*
    Template Name: personal_account
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

                    <div class="pa-hello">
                        <span class="pa-hello-name">Alexandr,</span>
                        Приветсвуем вас в вашем личном кабинете!

                        <div class="pa-second-bg"></div>

                    </div>

                    <div class="pa-you-can">Здесь вы можете:</div>

                    <div class="pa-third-bg"></div>

                    <ul class="pa-color-list">

                        <li><div class="pa-color-num">1.</div><div class="pa-color-text">Получить <a href="#" target="_blank" >постоянную скидку</a> на ВСЕ билеты, это легко!</div></li>
                        <li><div class="pa-color-num">2.</div><div class="pa-color-text">Посмотреть свои <a href="#" target="_blank" >заказы</a> и <a href="#" target="_blank" >скачать билеты</a></div></li>
                        <li><div class="pa-color-num">3.</div><div class="pa-color-text">Писать <a href="#" target="_blank" >отзывы</a> о мероприятиях и действующих лицах.</div></li>
                        <li><div class="pa-color-num">4.</div><div class="pa-color-text">Ставить <a href="#" target="_blank" >оценки местам в зале.</a></div></li>
                        <li><div class="pa-color-num">5.</div><div class="pa-color-text">Управлять <a href="#" target="_blank" >подписками.</a></div></li>
                        <li><div class="pa-color-num">6.</div><div class="pa-color-text">Посмотреть или сохранить себе наши <a href="#" target="_blank" >роскошные подборки</a> лучших мероприятий.</div></li>
                        <li><div class="pa-color-num">7.</div><div class="pa-color-text">Заполнить информацию <a href="#" target="_blank" >о себе.</a></div></li>

                    </ul>

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
