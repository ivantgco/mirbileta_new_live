    <?php
    /*
        Template Name: circus_landing_tpl
    */

    $href = request_url();
    $arr = parse_url($href);
    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

    $theme_path = 'http://mirbileta.ru/wp-content/themes/mirbileta_done/';

    $global_prot = 'https';
    $global_url = 'shop.mirbileta.ru';
    $global_salesite = 'mirbileta.ru';


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

        <title>Цирковое шоу ЦИРКUS 2.0 cо 2 ноября. Большой Московский Цирк братьев Запашных. Мир Билета</title>

        <meta name="description" content="Цирковое шоу ЦИРКUS 2.0 cо 2 ноября. Большой Московский Цирк братьев Запашных. Мир Билета" />

        <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

        <?php include 'viewport.php'; ?>

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

        <script type="text/javascript" id="mbw-script-loader" data-src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/mb_widget.js" src=""></script>

        <?php wp_head(); ?>



    </head>
<!--    http://mirbileta.ru/cirkus__5612/-->

    <body <?php body_class(); ?> data-page="inner">

    <div class="circus20">

    <?php
    //get_header();
//    include('main_menu.php');

    ?>

    <style type="text/css">
        .mb-top-adv{
            display: none;
        }
    </style>


    <div class="l-fader"></div>
    <div class="l-row">


        <div class="l-bg" id="trailer">
            <video id="video" width="100%" height="auto" autoplay="autoplay" loop="loop" preload="auto">
                <source src="<?php echo $theme_path;?>/assets/img/circus/1.mp4"></source>
                <source src="<?php echo $theme_path;?>/assets/img/circus/1.webm" type="video/webm"></source>
            </video>
        </div>


        <div class="l-content">

            <div class="container posRel">

                <div class="l-page-1-data l-page-data">


                    <div class="mb-logo">MIRBILETA.RU</div>
                    <div class="phone">+7 (499) 391-61-97</div>

                    <div class="circus20-logo">
                        <img src="<?php echo $theme_path;?>/assets/img/circus/cicus20_logo.png" />
                    </div>

                    <div class="c-date">c 24 сентября по 11 декабря</div>

                    <div class="c-venue">Большой Московский Цирк<br/>
                    на проспекте Вернадского</div>


                    <div class="circus-buy-btn" alt="Купить билеты"></div>

                </div>




            </div>



        </div>

        <div class="l-page-2-top-bg" style="width: 100%; height:229px;background-image: url(<?php echo $theme_path;?>/assets/img/duzhev/3.png)"></div>

    </div>

    <div class="l-row">

        <div class="l-page-2-data l-page-data">



            <div class="l-page-2-bg">


                <div class="container posRel" style="z-index: 10;">



                </div>

            </div>

        </div>

    </div>

    <div class="l-row">

        <div class="l-page-3-bg" style="background-size: cover; background-position-y:266px;background-repeat: no-repeat;  width: 100%; height:1463px;background-image: url(<?php echo $theme_path;?>/assets/img/duzhev/lists.jpg)"></div>

        <div class="container posRel">

            <div class="l-text">
                <span class="roboto-bold">18</span> октября на главной сцене страны состоится<br/>
                концерт, посвященный 20-летию творчества<br/>
                <span class="roboto-bold">Дмитрия Дюжева!</span>
            </div>

            <div class="l-go-next l-green-next">Что Вас ждет?</div>


        </div>

        <div class="l-page-4-bg" style="">

            <div class="container l-page-4-container posRel">

                <div class="l-text-32">
                    Этой осенью москвичи увидят и услышат самые любимые<br/>
                    песни и отрывки из фильмов и спектаклей! Этому<br/>
                    поспособствуют огромные экраны и грандиозное оформление<br/>
                    главной сцены страны.
                </div>

                <div class="l-text-52">
                    Подарите себе и друзьям теплый<br/>
                    вечер и отличную музыку!
                </div>

                <div class="l-buy-holder l-buy-dark l-buy-lists">
                    <div class="mirbileta-discount-holder">
                        СКИДКА 10%<br/>
                        <span class="mirbileta-discount-sub">от mirbileta.ru</span>
                    </div>
                    <div class="multibooker-buy-button l-buy"
                         data-frame="Duduzh50PerGogogJoy"
                         data-id="4915"
                         data-host="https://shop.mirbileta.ru"
                         data-ip="shop.mirbileta.ru"
                        >
                        КУПИТЬ БИЛЕТЫ</div>
                    <div class="l-no-fee">А так же, без сервисного сбора!</div>
                </div>


            </div>
        </div>

    </div>

    <div class="l-row">

        <div class="l-page-5-bg" style="background-size: cover; background-repeat: no-repeat;  width: 100%; height:874px;background-image: url(<?php echo $theme_path;?>/assets/img/duzhev/hall.jpg)"></div>

        <div class="container posRel">

            <div class="l-page-5-circle">

                <div class="l-page-5-hl">Места в партере:</div>

                <div class="l-page-5-prices-holder">
                    <div class="l-page-5-price-text">Поближе - </div>
                    <div class="l-page-5-prices">
                        <div class="l-page-5-price-old">12,000 <i class="fa fa-ruble"></i></div>
                        <div class="l-page-5-price-new">10,800 <i class="fa fa-ruble"></i></div>
                    </div>
                </div>

                <div class="l-page-5-prices-holder">
                    <div class="l-page-5-price-text">Подальше - </div>
                    <div class="l-page-5-prices">
                        <div class="l-page-5-price-old">2,500 <i class="fa fa-ruble"></i></div>
                        <div class="l-page-5-price-new">2,250 <i class="fa fa-ruble"></i></div>
                    </div>
                </div>

                <div class="l-buy-holder l-circle-buy-holder">
                    <div class="mirbileta-discount-holder">
                        СКИДКА 10%<br/>
                        <span class="mirbileta-discount-sub">от mirbileta.ru</span>
                    </div>




                    <div class="multibooker-buy-button l-buy"
                         data-frame="Duduzh50PerGogogJoy"
                         data-id="4915"
                         data-host="https://shop.mirbileta.ru"
                         data-ip="shop.mirbileta.ru"
                        >ВЫБРАТЬ МЕСТА</div>
                    <div class="l-no-fee">А так же, без сервисного сбора!</div>
                </div>

            </div>

        </div>

    </div>

    <div class="l-row">
        <div class="l-page-6-content">
            <div class="container posRel">

                <div class="l-help l-help-1">Не получается купить билет?</div>
                <div class="l-help l-help-2">Звоните - поможем!</div>
                <div class="l-help l-help-3">+7 (499) 391-61-97</div>

                <div class="l-another-places">
                    Мне нужны другие места
                </div>
            </div>
        </div>

    </div>

    </div>
    </body>

    <link href="https://shop.mirbileta.ru/assets/widget/mb_widget_button.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://shop.mirbileta.ru/assets/widget/mb_widget_button.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $('.l-next-slide').on('click', function(){

                var ns = $(this).parents('.l-row').next();
                var sctop = ns.offset().top + 40;

                $('html, body').animate({
                    scrollTop: sctop + 'px'
                }, 240, function(){

                });

            });

            $('.l-green-next').on('click', function(){

                var ns = $('.l-page-4-bg');
                var sctop = ns.offset().top;

                $('html, body').animate({
                    scrollTop: sctop + 'px'
                }, 240, function(){

                });

            });

            $('.l-another-places').on('click', function(){

                bootbox.dialog({
                    title: 'Перезвоним и найдем Вам подходящие места!',
                    message: '<div class="form-group l-another-places-phone"><label>Ваш телефон:</label><input id="another-places-phone" type="tel" class="form-control" value="+7"/></div>',
                    buttons: {
                        success: {
                            label: 'Подтвердить',
                            callback: function(){

                                var o = {
                                    command: 'Send_Email_to_Support',
                                    params: {
                                        title: 'Дюжев, нужны другие места',
                                        message: $('#another-places-phone').val()
                                    }
                                };

                                socketQuery_site(o, function(res){
                                    console.log(res);
                                });

                            }
                        }

                    }
                })

            });

        });
    </script>


    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter32940504 = new Ya.Metrika({
                        id:32940504,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        trackHash:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/32940504" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
