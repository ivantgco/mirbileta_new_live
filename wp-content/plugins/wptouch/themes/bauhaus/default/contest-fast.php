<?php
/*
    Template Name: contest-fast
*/


$order_id = $_POST['cf'];
$email = $_POST['email'];


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

    <?php include 'viewport.php';?>


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner">

<div class="mmb-page-holder blank-page contest-page">
    <?php
    get_header();
    ?>

    <div class="mmb-blank-wrapper">

        <div class="mmb-headline">Конкурс "Кто быстрее?!"</div>
        <div style="
            background-image: none;
            font-size: 20px;
            font-family: 'Helvetica Neue',arial, sans-serif;
            font-weight: bold;
            padding-left: 20px;
            margin-top: 10px;
            height: 281px;
            margin-bottom: 10px;
        ">Итоги конкурса на полной версии сайта!</div>

<!--        <div class="mmb-cf-page-image"></div>-->

<!--        <div class="mmb-cf-page-text">-->
<!--            Оформите заказ на ЛЮБОЕ мероприятие быстрее всех, используя мобильную версию сайта!<br/>-->
<!--            Победитель конкурса получит<br/>-->
<!--            2 пригласительных <br/>-->
<!--            на спектакль <b>«С наступающим...»</b> <br/>-->
<!--            театра "Современник" 19 апреля<br/>-->
<!--            в ТКЗ "Дворец на Яузе" <br/>-->
<!--            <b>в подарок!</b>-->
<!--        </div>-->

<!--        <div class="mmb-cf-bunner-footer contest-page-footer">-->
<!---->
<!--            <div class="mmb-cf-bunner-btn contest-fast-go">Принять участие!</div>-->
<!--            <div class="contest-fast-full-rules">Сбросить счетчик</div>-->
<!---->
<!---->
<!--            <div class="mmb-cf-results-holder">-->
<!--                <h3>Промежуточные результаты:</h3>-->
<!--                <div class="find-contest-result-wrapper">-->
<!--                    <div class="find-contest-result-title">Найдите свой результат:</div>-->
<!--                    <input type="text" class="find-contest-result-input" placeholder="Номер заказа"/>-->
<!--                </div>-->
<!---->
<!--                <div class="find-contest-results-holder chromeScroll">-->
<!--                    <table class="contest-fast-results">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>#</th>-->
<!--                            <th>Заказ</th>-->
<!--                            <th>Участник</th>-->
<!--                            <th>Результат</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!---->
<!---->
<!---->
<!--                        --><?php
//                        $resultsHtml = "";
//
//                        $place = 1;
//                        foreach ($data as $key => $value){
//
//                            $id =               $value[array_search("ORDER_ID", $columns)];
//                            $name =             $value[array_search("CRM_USER_NAME", $columns)];
//                            $time =             $value[array_search("TOTAL_TIME_STR", $columns)];
//                            $isMobile =         $value[array_search("USER_AGENT", $columns)] == 'MOBILE';
//
//                            if($isMobile){
//                                $resultsHtml .= ' <tr data-order="'.$id.'">'
//                                    .'<td>'.$place.'</td>'
//                                    .'<td>'.$id.'</td>'
//                                    .'<td>'.$name.'</td>'
//                                    .'<td>'.$time.'</td>'
//                                    .'</tr>';
//
//                                $place++;
//                            }
//                        }
//
//
//                        if(strlen($resultsHtml) == 0){
////                            echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
//                        }else{
//                            echo $resultsHtml;
//                        }
//                        ?>
<!---->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!---->
<!--        </div>-->

<!--        <div class="mmb-cf-page-rules">-->
<!--            <div class="mmb-cf-page-text">Простые правила:</div>-->
<!--            <b>Задача:</b><br/>-->
<!--            Максимально быстро оформить заказ и оплатить Электронные билеты на сайте www.mirbileta.ru в течение-->
<!--            периода проведения Акции.<br/>-->
<!--            Участник, потративший минимум времени, признается победителем.<br/><br/>-->
<!--            <b>Сроки проведения:</b><br/> с 10.03.2016 12:00 по 14.04.2016 15:59<br/><br/>-->
<!--            <b>Приз победителю:</b><br/> 2 пригласительных на спектакль<br/>-->
<!--            "С наступающим..." 19.04.2016<br/><br/>-->
<!---->
<!--            Полная информация об организаторе Акции, количестве призов, сроках, месте и порядке их получения доступна в<br/>-->
<!--            <a href="/contest-fast-rules.pdf" target="_blank">Правилах проведения Акции.</a>-->
<!---->
<!--<!--            <a class="mmb-cf-full-rules-link" target="_blank" href="/contest-fast-rules.pdf">Полные правила</a>-->
<!--        </div>-->

<!--        <div class="mmb-cf-bunner-footer contest-page-footer">-->
<!--            <div class="mmb-cf-bunner-btn contest-fast-go">Принять участие!</div>-->
<!--        </div>-->

    </div>

    <?php

    include('custom_footer.php');

    ?>
</div>


</body>

