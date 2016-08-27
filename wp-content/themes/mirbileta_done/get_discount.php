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


    <div class="site-content get-discount-page">

        <div class="container">

            <div class="gd-site-content">


                <div class="gd-header-holder">

                    <div class="gd-header-bg"></div>

                    <h1 class="gd-header-title-holder">
                        Покупайте билеты <span class="gd-medium-bold">ниже номинальной</span> цены,<br/>
                        по программе <span class="gd-name">«И себе и людям»</span><br/>
                        от mirbileta.ru
                    </h1>


                    <div class="gd-header-go-down">

                    </div>

                </div>

                <div class="gd-body-holder">


                    <h2 class="gd-1-header">
                        Покупайте билеты со скидкой до 11%
                    </h2>

                    <div class="gd-2-header">
                        2 простых шага к получению Вашей<br/>
                        персональной скидки:
                    </div>


                    <div class="gd-devide"></div>

                    <div class="gd-instruction-holder">

                        <div class="gd-ins-step-title">1. Получить «Код MIRBILETA»</div>

                        <div class="gd-ins-step-text">Получить персональный «Код MIRBILETA» можно в <a href="/account/?utm_source=gd_page_desktop" target="_blank">личном кабинете</a> или <span class="sc-gd-fast-code gd-fast-code">здесь</span>.</div>

                        <!----------------->

                        <div class="gd-ins-step-title">2. Раздать Ваш код друзьям.</div>

                        <div class="gd-ins-step-text">
                            Ваш «Код MIRBILETA» дает Вашим друзьям фиксированную скидку 2%
                            на покупку билетов через сайт mirbileta.ru, Вы же получаете гораздо больше!
                        </div>

                        <h1 class="gd-you-get">Что получаете лично Вы?</h1>

                        <div class="gd-ins-step-text">
                            Вы получаете скидку, размер которой напрямую зависит от
                            количества человек использовавших Ваш код для покупки
                            билетов на mirbileta.ru
                        </div>

                        <div class="gd-table-and-buttons">

                            <div class="gd-table-holder">

                                <div class="gd-table-header">Таблица роста скидки:</div>

                                <table class="gd-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            Кол-во человек<br/>
                                            использовавших Ваш<br/>
                                            «КОД MIRBILETA»
                                        </th>
                                        <th>
                                            Ваша скидка
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>0 - 4</td>
                                        <td>0%</td>
                                    </tr>

                                    <tr>
                                        <td>5 - 9</td>
                                        <td>3%</td>
                                    </tr>

                                    <tr>
                                        <td>10 - 14</td>
                                        <td>5%</td>
                                    </tr>

                                    <tr>
                                        <td>15 - 19</td>
                                        <td>7%</td>
                                    </tr>

                                    <tr>
                                        <td>20 <</td>
                                        <td>11%</td>
                                    </tr>

                                    </tbody>
                                </table>

                                <div class="gd-low-price-info">
                                    - Да, цена ниже<br/>
                                    номинала!
                                </div>

                            </div>

                            <div class="gd-buttons-holder">

                                <div class="gd-buttons-title">Мне всё понятно, хочу скидку!</div>

                                <div class="gd-get-code sc-gd-fast-code">Получить <span class="ptbold">«Код MIRBILETA»</span></div>
                                <div class="gd-ask-question sc-gd-ask-question">Задать вопрос</div>

                            </div>


                        </div>


                        <div class="gd-footer">

                            <div class="gd-thanks">Спасибо за внимание!</div>
                            <div class="gd-team">
                                С уважением, команда mirbileta.ru<br/>
                                +7 (499) 391-61-97
                            </div>

                        </div>


                    </div>

                </div>




            </div>

        </div>

    </div>




    <?php

    get_footer();

    ?>


    </body>
</html>
