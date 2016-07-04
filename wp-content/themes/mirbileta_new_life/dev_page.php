<?php
/*
    Template Name: dev_main
*/

//include ("../../../vendor/fightbulc/moment/src/Moment.php");

//include 'zaglushka.php';
//return false;

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

<body <?php body_class(); ?>>


<?php
    get_header();
    include('slider.php');
//    include('main_menu_main.php');

?>

<div class="contest-holder">
    <div class="contest-fast-fader"></div>

    <div class="contest-fast-close fa fa-times"></div>

    <div class="contest-fast-wrapper">
        <h1>Кто быстрее?!</h1>
        <h3>
            Вы за билетами? Как на счет увеселить<br/>процесс и поучавствовать в конкурсе?<br/><br/>
            Оформите заказ быстрее всех и получите<br/>2 билета на Хулио Иглесиаса в подарок!
        </h3>
        <div class="contest-fast-open-rules">Простые правила</div>
        <div class="contest-fast-go">Go!</div>
        <div class="contest-fast-reject">Нет, спасибо</div>
    </div>

    <div class="contest-fast-rules">
        <div class="container posRel">
            <h1>Простые правила</h1>

            Чтобы зарегистрироваться в Конкурсе, кандидату необходимо (с учетом ограничений, указанных ниже в настоящем разделе):
            (a) быть гражданином Российской Федерации или лицом, постоянно проживающим на территории Российской Федерации;
            (б) быть несовершеннолетним учащимся общеобразовательного учреждения Российской Федерации в возрасте от 6 до 17 лет включительно;
            (в) получить предварительное согласие на участие в Конкурсе от своих родителей или иных законных представителей.
            Для получения призов, указанных в настоящих Правилах, заявку на участие в конкурсе от имени участников Конкурса,
            не достигших 14 лет на дату подачи заявки, должны подать их родители или иные законные представители, а участники
            Конкурса в возрасте от 14 до 17 лет должны получить письменное согласие своих родителей либо иных законных
            представителей на участие в Конкурсе. Конкурс проводится на территории Российской Федерации и его Правила действуют
            исключительно на территории Российской Федерации.

            Работники, стажеры, подрядчики и должностные лица компании Гугл (Google), ее дочерних компаний и аффилированных лиц,
            Партнеры Конкурса, указанные в Правилах, их руководители, должностные лица, работники, а также их ближайшие
            родственники, не имеют права участвовать в данном Конкурсе. Также не имеют права принимать участие в Конкурсе лица,
            постоянно проживающие на территории Кубы, Ирана, Северной Кореи, Судана, Мьянмы (Бирмы), Сирии, Зимбабве и любой
            иной страны (части территории страны), к которой применяются экономические и торговые санкции США.

            <div class="contest-fast-reject">Нет, спасибо</div>

            <div class="contest-fast-go">Go!</div>

<!--            <div class="contest-fast-runner"></div>-->

        </div>

    </div>
</div>



<div class="site-content">
    <div class="container">
        <div class="content-block most-important">

            <?php include('top_sales.php'); ?>

        </div>

        <div class="content-block extend-search">

            <?php include('extend_search.php'); ?>

        </div>

        <div class="content-block nearrest-aсtions">

            <?php include('nearrest_actions.php'); ?>

        </div>
    </div>
</div>

<?php

    get_footer();

?>


</body>
