<?php
/*
    Template Name: contacts
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

<!--    <title>--><?php //wp_title('-', true, 'right'); ?><!--</title>-->
    <?php include 'seo.php'; ?>
    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <?php include 'viewport.php'; ?>


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


    <div class="contacts-fader">

    </div>
    <div class="container">
<!--        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2246.6603270761066!2d37.66113331606984!3d55.72965500124428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54ad90555ccc1%3A0x90af535bc9433c75!2z0YPQuy4g0JrRgNGD0YLQuNGG0LrQuNC5INCS0LDQuywgMTYsINCc0L7RgdC60LLQsCwgMTA5MDQ0!5e0!3m2!1sru!2sru!4v1454514161029" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen></iframe>-->
<!--        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2242.109937072993!2d37.637150116266106!3d55.808691780568275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b535e6fb8b6e33%3A0xc2b08ad0b73bb354!2z0L_RgC3RgiDQnNC40YDQsCwgMTE00JAsINCc0L7RgdC60LLQsCwgMTI5NjI2!5e0!3m2!1sru!2sru!4v1490187011528" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen></iframe>-->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2246.6653750524524!2d37.66206621626375!3d55.729567280547144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54ad90cad3f5b%3A0x976c9aea545f92c8!2z0YPQuy4g0JrRgNGD0YLQuNGG0LrQuNC5INCS0LDQuywgMTQsINCc0L7RgdC60LLQsCwgMTA5MDQ0!5e0!3m2!1sru!2sru!4v1495717801559" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen></iframe>
        <div class="single-contacts-title-holder wid100pr flLeft">
            <h2>Контакты:</h2>


            <div class="pr50">

                <div class="pr50">
                    <b class="black">Поддержка:</b><br/><br/>
                    +7 (495) 005-30-23
                    <br/>
                    support@mirbileta.ru
                    <br/>
                    <br/><br/>

                    <b class="black">Сотрудничество:</b><br/><br/>
                    +7 (906) 063-88-66
                    <br/>
                    alextgco@gmail.com
                    <br/>
                   <!-- Гоптарев Александр Иванович
                    <br/>-->
                    <br/><br/>
                </div>

                <div class="pr50">
                    <b class="black">Москва:</b><br/><br/>
                    Адрес: Москва, Крутицкий вал, 14
                    <br/><br/>
                </div>


                <div class="pr50">
                    <b class="black">Вильнюс:</b><br/><br/>
                    UAB "Anitera"<br/>
                    Laisvės pr. 60, LT-05120, Vilnius<br/>
                    Company Number: 303436963
                </div>





            </div>




            </div>

        </div>

    </div>

<?php

get_footer();

?>


</body>
