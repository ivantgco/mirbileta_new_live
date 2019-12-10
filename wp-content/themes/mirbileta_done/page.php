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
<html style="margin-top: 0px!important;" <?php language_attributes(); ?>>
<!--<![endif]-->


<head>

    <meta charset="UTF-8" />
    <?php include 'seo.php'; ?>
    <!--    <title>--><?php //wp_title( '-', true, 'right' ); 
                        ?>
    <!--</title>-->

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">



    <?php include 'viewport.php'; ?>


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />

    <?php wp_head(); ?>


</head>

<body <?php body_class(); ?>>




    <?php
    get_header();

    include 'main_menu.php';

    ?>




    <div class="site-content">


        <div class="new-slider">
            <?php include 'new_slider.php'; ?>
        </div>

        <div class="site-container">

           

            <div class="mb-site-content mb-site-content_main">

                <div class="mirbileta-get-discount-holder">
                    <a target="_blank" href="/get_discount">
                        <div class="mirbileta-get-discount"></div>
                    </a>
                </div>

                <!--            --><?php //include 'main_slider.php';
                                    ?>

                <div class="main-info">
                    <div class="main-info__item">
                        <div class="main-info__item__wrap"></div>
                        <h3>Мы продаем электронные билеты</h3>
                    </div>
                    <div class="main-info__item">
                        <div class="main-info__item__wrap"></div>
                        <div class="main-info__item__text">
                            <p>Оплачивайте заказ в режиме онлайн не выходя из дома, а мы просто пришлем билеты на Вашу электронную почту</p>
                            <a href="http://mirbileta.ru/how_to_buy/"><button>Подробнее</button></a>
                        </div>
                    </div>
                </div>

                <h1 class="mb_h1">Премьера</h1>



                <?php include 'top_sales.php'; ?>
                <div class="mb-title-popup">
                    <h1 class="mb_h1">Афиша</h1>
                    <button class="show-cal">Фильтр по дате</button>
                </div>
                

                <?php include 'main_page_actions.php'; ?>

                


                <?php /* Вывод содержимого на главной */ ?>
                <div style="">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php the_content(); ?>
                    <?php endwhile;
                    endif; ?>
                </div>
                <?php /* /Вывод содержимого на главной */ ?>


                <div class="main-prefoot-info">
                    <div class="main-prefoot-info__item">
                        <div class="main-prefoot-info__item__text">
                            <h3>Официальные билеты</h3>
                            <p>Пользуясь нашим сервисом Вы получаете билеты напрямую от организаторов. Благодаря нашему сервису обезапасьте себя от подделок и мошенничества</p>
                        </div>
                    </div>
                    <div class="main-prefoot-info__item">
                        <div class="main-prefoot-info__item__text">
                            <h3>Электронные билеты</h3>
                            <p>Не желаете стоять в очередях и тратить время на дорогу? Теперь это необязательно. Оплачивайте билеты на сайте и получайте их на электронную почту</p>
                        </div>
                    </div>
                </div>

                <div class="main-how">
                    <div class="main-how-title">Как купить билет?</div>
                    <div class="main-how-content">
                        <div class="main-how-content-item">
                            <p>Продажа электронных билетов крепко вошла в нашу жизнь. Чтобы купить билеты в Москве, не нужно торопиться до закрытия билетного киоска и томиться в очереди.</p>

                            <p> Московское билетное Интернет-агентство MIRBILETA.RU продаёт электронные билеты и абонементы на зрелищные мероприятия.
                                Надежная служба поддержки <a href="tel:84950053023">+7 (495) 005-30-23</a> всегда готова помочь выбрать событие, и, учитывая ваши вкусы, посоветовать концерт, шоу или мюзикл.</p>

                            

                            <p> Наш сайт не требует регистрации. Удобная навигация позволят выбрать любое мероприятие и купить билет без временных затрат. Осуществите заказ и оплатите билет посредством платежных систем Visa и MasterCard.</p>

                            <p> Наша афиша вмещает все события Москвы, и наша задача – сделать каждое событие доступным!</p>
                        </div>
                        <div class="main-how-content-item">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/prefoote-img.png" alt="">
                        </div>
                    </div>
                </div>

            </div>




        </div>

    </div>


    <div class="popup-cal">
        <div class="popup-cal-content">
            <div class="popup-cal-content-close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/close.png" alt="Закрыть окно"></div>
            <?php include 'sidebar_calendar.php'; ?>
        </div>
    </div>


    <?php

    get_footer();

    ?>


</body>