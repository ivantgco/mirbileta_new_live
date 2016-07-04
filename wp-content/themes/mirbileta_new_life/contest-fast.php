<?php
/*
    Template Name: contest-fast
*/

require('./vendor/lawondyss/moment-php/src/MomentPHP/MomentPHP.php');

$page_id = get_the_ID();

$url = $global_prot . "://" . $global_url . "/cgi-bin/b2e?request=<command>get_contest_results</command><url>mirbileta.ru</url>";

$ch = curl_init();

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$resp = curl_exec($ch);

if (curl_errno($ch))
    print curl_error($ch);
else
    curl_close($ch);

$columns = json_decode($resp)->results["0"]->data_columns;
$data = json_decode($resp)->results["0"]->data;


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

<div class="site-content contest-page">

<div class="container">

<div class="contest-fast-winner">
    <div class="cfw-header">

        Поздравляем победителей!
        <!--                Поздравляем победителей конкурса <span class="cfw-red">"Кто быстрее?!"</span>-->
    </div>

    <div class="pr50">
        <div class="cfw-type-title">Компьютерный</div>
        <div class="cfw-photo">
            <img style="width: 377px;" src="http://mirbileta.ru/images/contest-fast-winner-desktop.jpg"/>
        </div>
        <div class="cfw-name">
            Юлия Сазонова
        </div>
        <div class="cfw-result">
            1 минута 23 секунды 45 миллисекунд
        </div>
        <div class="cfw-feedback">
            Все супер! И супер честно! Огромное спасибо за акцию! Давно хотела сходить на Басту и наконец таки моя мини
            мечта сбудется )
            <br/><br/>
            спасибо mirbileta.ru большое!
        </div>
    </div>
    <div class="pr50">
        <div class="cfw-type-title">Мобильный</div>
        <div class="cfw-photo">
            <img style="width: 377px;" src="http://mirbileta.ru/images/contest-fast-winner-mobile.jpg"/>
        </div>
        <div class="cfw-name">
            Елена В.
        </div>
        <div class="cfw-result">
            2 минуты 40 секунд 18 миллисекунд
        </div>
        <div class="cfw-feedback">
            Спасибо!!! "мир билета" очень удобный сайт, покупала на нем билеты в Кремлевский дворец на балет, попала в
            конкурс и не задумываясь выиграла два билета на прекрасный спектакль, потому как сайт на столько удобен и
            качественен, что по скорости покупки опередила всех конкурентов😀😀😀 Никогда нигде не выигрывала а тут
            такое счастье!
            <br/><br/>
            Спасибо "мир билета", спасибо вашей команде, спасибо за конкурсы! Так держать! Елена В.
        </div>
    </div>
</div>

<div class="contest-page-holder posRel flLeft wid100pr">

<div class="contest-page-block contest-page-block-1">

    <div class="contest-page-title">Кто быстрее?!</div>

    <div class="contest-page-image"></div>

    <div class="contest-page-promo">
        Победителю конкурса<br/>
        <span class="boldwhite">2 билета в партере на концерт «Баста с симфоническим оркесторм»</span>
        18 апреля в Государственном Кремлевском Дворце<br/>
        <span class="boldwhite">в подарок!</span>
    </div>
</div>

<div class="contest-page-block contest-page-block-2">

    <div class="contest-rules-title">Простые правила:</div>
    <div class="contest-rules-text">
        <b>Задача:</b><br/>
        Максимально быстро оформить заказ и оплатить Электронные билеты на <b>ЛЮБОЕ</b> мероприятие на сайте
        www.mirbileta.ru в течение
        периода проведения Акции.<br/>
        Участник, потративший минимум времени, признается победителем.<br/><br/>
        <b>Сроки проведения:</b><br/> с 10.03.2016 12:00 по 14.04.2016 15:59<br/><br/>
        <b>Приз победителю:</b><br/> 2 билета на концерт "Баста с симфоническим оркестром" 18.04.2016<br/><br/>

        Полная информация об организаторе Акции, количестве призов, сроках, месте и порядке их получения доступна в<br/>
        <a href="/contest-fast-rules.pdf" target="_blank">Правилах проведения Акции.</a>
    </div>

</div>

<div class="contest-page-block contest-page-block-3">
    <div class="contest-rules-title">Результаты конкурса:</div>

    <div class="find-contest-result-wrapper">
        <div class="find-contest-result-title">Найдите свой результат:</div>
        <input type="text" class="find-contest-result-input" placeholder="Номер заказа"/>
    </div>


    <div class="find-contest-results-holder chromeScroll">

        <h3 style="text-align:center ">Десктопный</h3>

        <table class="contest-fast-results">
            <thead>
            <tr>
                <th>#</th>
                <th>Заказ</th>
                <th>Участник</th>
                <th>Результат</th>
            </tr>
            </thead>
            <tbody>


            <?php
            $resultsHtml = "";

            $place = 1;
            foreach ($data as $key => $value) {


                $id = $value[array_search("ORDER_ID", $columns)];
                $name = $value[array_search("CRM_USER_NAME", $columns)];
                $time = $value[array_search("TOTAL_TIME_STR", $columns)];
                $isMobile = $value[array_search("USER_AGENT", $columns)] == 'MOBILE';

                if (!$isMobile) {

                    if ($id == 91257 || $id == 91260 || $id == 91258) {
                        $resultsHtml .= ' <tr data-order="' . $id . '">'
                            . '<td> - </td>'
                            . '<td style="text-decoration:line-through;">' . $id . '</td>'
                            . '<td>' . $name . ' - Результат недействителен.</td>'
                            . '<td style="text-decoration:line-through;">' . $time . '</td>'
                            . '</tr>';

//                                        $place++;
                    } else {

                        if ($place != 1) {
                            $resultsHtml .= ' <tr data-order="' . $id . '">'
                                . '<td>' . $place . '</td>'
                                . '<td>' . $id . '</td>'
                                . '<td>' . $name . '</td>'
                                . '<td>' . $time . '</td>'
                                . '</tr>';
                        } else {
                            $resultsHtml .= ' <tr data-order="' . $id . '">'
                                . '<td><i class="fa fa-star" style="color:red;"></i></td>'
                                . '<td>' . $id . '</td>'
                                . '<td>' . $name . '</td>'
                                . '<td>' . $time . '</td>'
                                . '</tr>';
                        }


                        $place++;
                    }


                }

            }


            if (strlen($resultsHtml) == 0) {
//                                echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
            } else {
                echo $resultsHtml;
            }
            ?>

            </tbody>
        </table>
    </div>

    <div class="find-contest-results-holder chromeScroll">

        <h3 style="text-align:center ">Мобильный</h3>

        <table class="contest-fast-results">
            <thead>
            <tr>
                <th>#</th>
                <th>Заказ</th>
                <th>Участник</th>
                <th>Результат</th>
            </tr>
            </thead>
            <tbody>


            <?php
            $resultsHtml = "";

            $place = 1;
            foreach ($data as $key => $value) {


                $id = $value[array_search("ORDER_ID", $columns)];
                $name = $value[array_search("CRM_USER_NAME", $columns)];
                $time = $value[array_search("TOTAL_TIME_STR", $columns)];
                $isMobile = $value[array_search("USER_AGENT", $columns)] == 'MOBILE';

                if ($isMobile) {

                    if ($id == 91257 || $id == 91260 || $id == 91258) {
                        $resultsHtml .= ' <tr data-order="' . $id . '">'
                            . '<td> - </td>'
                            . '<td style="text-decoration:line-through;">' . $id . '</td>'
                            . '<td>' . $name . ' - Результат недействителен.</td>'
                            . '<td style="text-decoration:line-through;">' . $time . '</td>'
                            . '</tr>';

//                                        $place++;
                    } else {
                        if ($place != 1) {
                            $resultsHtml .= ' <tr data-order="' . $id . '">'
                                . '<td>' . $place . '</td>'
                                . '<td>' . $id . '</td>'
                                . '<td>' . $name . '</td>'
                                . '<td>' . $time . '</td>'
                                . '</tr>';

                        } else {
                            $resultsHtml .= ' <tr data-order="' . $id . '">'
                                . '<td><i class="fa fa-star"  style="color:red;"></i></td>'
                                . '<td>' . $id . '</td>'
                                . '<td>' . $name . '</td>'
                                . '<td>' . $time . '</td>'
                                . '</tr>';
                        }
                        $place++;
                    }


                }

            }


            if (strlen($resultsHtml) == 0) {
//                                echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
            } else {
                echo $resultsHtml;
            }
            ?>

            </tbody>
        </table>
    </div>

</div>

</div>
<div class="contest-page-footer posRel flLeft wid100pr">
    <div class="contest-fast-go">Принять участие!</div>
    <div class="contest-fast-full-rules">Сбросить счетчик</div>
</div>


</div>
</div>

<?php

get_footer();

?>


</body>
