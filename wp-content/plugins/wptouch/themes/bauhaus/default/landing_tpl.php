    <?php
    /*
        Template Name: landing_tpl
    */

    $href = request_url();
    $arr = parse_url($href);
    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

    $theme_path = 'http://mirbileta.ru/wp-content/themes/mirbileta_done/';



    $global_prot = 'https';
    $global_url = 'shop.mirbileta.ru';
    $global_salesite = 'mirbileta.ru';



//    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>".$global_salesite."</url><action_url_alias>".$action_alias."</action_url_alias>";
//
//    $ch = curl_init();
//
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//
//    $resp = curl_exec($ch);
//
//    if (curl_errno($ch))
//        print curl_error($ch);
//    else
//        curl_close($ch);

//    $columns = json_decode($resp)->results["0"]->data_columns;
//    $data = json_decode($resp)->results["0"]->data[0];
//
//    $act_id =       $data[array_search("ACTION_ID", $columns)];
//    $widget_act_id =$data[array_search("ACTION_ID", $columns)];
//    $alias =        $data[array_search("ACTION_URL_ALIAS", $columns)];
//    $show_alias =   $data[array_search("SHOW_URL_ALIAS", $columns)];
//    $frame =        $data[array_search("FRAME", $columns)];
//    $widget_frame = $data[array_search("FRAME", $columns)];
//    $act_name =     $data[array_search("ACTION_NAME", $columns)];
//    $g_act_name =     $data[array_search("ACTION_NAME", $columns)];
//    $thumb =        (strlen($data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0) ? (strpos("http", $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $defaultPoster;
//    $poster =       (strlen($data[array_search("ACTION_POSTER_IMAGE", $columns)])> 0) ? (strpos("http", $data[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?                          $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_IMAGE", $columns)]: $defaultPoster;
//    $act_date_full =     $data[array_search("ACTION_DATE", $columns)];
//    $act_date =     $data[array_search("ACTION_DATE_STR", $columns)];
//    $act_date_year =    to_afisha_date($data[array_search("ACTION_DATE", $columns)], 'year', 'rus');
//    $act_time =     $data[array_search("ACTION_TIME_STR", $columns)];
//    $hall =         $data[array_search("HALL_NAME", $columns)];
//    $genre =        $data[array_search("SHOW_GENRE", $columns)];
//    $venue =        $data[array_search("VENUE_NAME", $columns)];
//    $venue_alias =  $data[array_search("VENUE_URL_ALIAS", $columns)];
//    $address =      $data[array_search("HALL_ADDR", $columns)];
//    $g_address =    $data[array_search("HALL_GOOGLE_ADDRESS", $columns)];
//    $free_places =  $data[array_search("FREE_PLACE_COUNT", $columns)];
//    $minprice =     $data[array_search("MIN_PRICE", $columns)];
//    $maxprice =     $data[array_search("MAX_PRICE", $columns)];
//    $day_of_week =  $data[array_search("ACTION_DAY_OF_WEEK", $columns)];
//    $duration =     $data[array_search("DURATION_HOUR_MIN", $columns)];
//    $is_wo =        $data[array_search("ACTION_TYPE", $columns)] == 'ACTION_WO_PLACES';
//    $sbag =         $data[array_search("SPLIT_BY_AREA_GROUP", $columns)] == 'TRUE';
//    $tag_list =     $data[array_search("ACTION_TAG_LIST", $columns)];
//    $actor_list =   $data[array_search("ACTION_ACTOR_LIST", $columns)];
//    $images_list =   $data[array_search("ACTION_IMAGES_LIST", $columns)];
//
//    $isInfo = strlen($description) > 0;
//    $description = $data[array_search("DESCRIPTION", $columns)];
//
//    $ageCat = strlen($data[array_search("AGE_CATEGORY", $columns)]) ? $data[array_search("AGE_CATEGORY", $columns)] : '0+';
//    $act_date_time = $data[array_search("ACTION_DATE_TIME", $columns)];
//
//    $short_date = to_afisha_date($act_date_time, "short_date", "rus");
//    $short_date_with_year = to_afisha_date($act_date_time, "short_date_with_year", "rus");
//    $week_and_time = to_afisha_date($act_date_time, "week_and_time", "rus");
//    $weekday = to_afisha_date($act_date_time, "weekday", "rus");
//    $weekday_short = to_afisha_date($act_date_time, "weekday_short", "rus");
//    $time = to_afisha_date($act_date_time, "time", "rus");


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

        <?php include 'viewport.php'; ?>


        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

        <script type="text/javascript" id="mbw-script-loader" data-src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/mb_widget.js" src=""></script>

        <?php wp_head(); ?>



    </head>



    <body <?php body_class(); ?> data-page="inner">

    <?php
    get_header();
    include('main_menu.php');

    ?>


    <div class="l-fader"></div>
    <div class="l-row">

        <div class="l-bg" style="background-size: cover; background-image: url(<?php echo $theme_path;?>/assets/img/duzhev/1.jpg)"></div>

        <div class="l-content">

            <div class="container posRel">

                <div class="l-page-1-data l-page-data">

                    <div class="l-date-holder">
                        <div class="l-date-date">18</div>
                        <div class="l-date-mth">ОКТЯБРЯ</div>
                        <div class="l-date-year">2016</div>
                    </div>

                    <div class="l-venue-holder">
                        <div class="l-venue">ГОСУДАРСТВЕННЫЙ КРЕМЛЁВСКИЙ ДВОРЕЦ</div>
                    </div>

                    <div class="l-show-name">
                        <div class="l-show-image" alt="Я люблю тебя, жизнь" style="width: 348px; height:57px;background-image: url(<?php echo $theme_path;?>/assets/img/duzhev/2.png)"></div>
                    </div>

                    <div class="l-action">
                        <h1 class="l-action-name">ДМИТРИЙ ДЮЖЕВ</h1>
                    </div>

                    <div class="l-actors-holder">
                        <div class="l-actors">
                            ТАМАРА ГВЕРДЦИТЕЛИ  /  ЕКАТЕРИНА ГУСЕВА  /  НИКОЛАЙ РАСТОРГУЕВ <br/>
                            ДЕНИС МАЙДАНОВ  /  АЛЕКСАНДР БУЙНОВ  /  ИРИНА АЛЛЕГРОВА <br/>
                            ВАЛЕРИЙ СЮТКИН  /  ЭЛЬМИРА КАЛИМУЛЛИНА  /  ИОСИФ КОБЗОН <br/>
                            ГРИГОРИЙ ЛЕПС  /  ВЛАДИМИР ПРЕСНЯКОВ
                        </div>
                    </div>

                    <div class="l-buy-holder">
                        <div class="mirbileta-discount-holder">
                            СКИДКА 10%<br/>
                            <span class="mirbileta-discount-sub">от mirbileta.ru</span>
                        </div>
                        <div class="multibooker-buy-button l-buy"
                             data-frame="Duduzh50PerGogogJoy"
                             data-id="4915"
                             data-host="https://shop.mirbileta.ru"
                             data-ip="shop.mirbileta.ru"
                            >КУПИТЬ БИЛЕТЫ</div>
                        <div class="l-next-slide">Подробнее о концерте</div>
                        <div class="l-no-fee">А так же, без сервисного сбора!</div>

                    </div>
                </div>




            </div>



        </div>

        <div class="l-page-2-top-bg" style="width: 100%; height:229px;background-image: url(<?php echo $theme_path;?>/assets/img/duzhev/3.png)"></div>

    </div>

    <div class="l-row">

        <div class="l-page-2-data l-page-data">



            <div class="l-page-2-bg">

                <div class="l-page-2-stars stars-left"></div>
                <div class="l-page-2-stars stars-right"></div>

                <div class="l-purple-bg"></div>
                <div class="l-purple-bg-2"></div>

                <div class="container posRel" style="z-index: 10;">

                    <h2>
                        В КОНЦЕРТЕ УЧАВСТВУЮТ:
                    </h2>

                    <div class="row">

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_1.jpg" />
                            <h3>Дмитрий Дюжев</h3>
                            <h4>Всенародно любимый актер театра и кино</h4>
                        </div>

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_2.jpg" />
                            <h3>Тамара Гвердцители</h3>
                            <h4>Народная артистка России</h4>
                        </div>

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_3.jpg" />
                            <h3>Екатерина Гусева</h3>
                            <h4>Заслуженная артистка России</h4>
                        </div>

<!--                        -->

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_25.jpg" />
                            <h3>Николай Расторгуев</h3>
                            <h4>Народный артист России</h4>
                        </div>

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_4.jpg" />
                            <h3>Денис Майданов</h3>
                            <h4>Российский автор-исполнитель песен</h4>
                        </div>

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_5.jpg" />
                            <h3>Александр Буйнов</h3>
                            <h4>Народный артист России</h4>
                        </div>

<!---->

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_6.jpg" />
                            <h3>Ирина Аллегрова</h3>
                            <h4>Народная артистка России</h4>
                        </div>

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_7.jpg" />
                            <h3>Валерий Сюткин</h3>
                            <h4>Заслуженный артист России</h4>
                        </div>

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_8.jpg" />
                            <h3>Эльмира Калимуллина</h3>
                            <h4>Участница проекта “Голос”</h4>
                        </div>


<!--                        -->

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_9.jpg" />
                            <h3>Иосиф Кобзон</h3>
                            <h4>Народный артист СССР</h4>
                        </div>

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_10.jpg" />
                            <h3>Григорий Лепс</h3>
                            <h4>Заслуженный артист России</h4>
                        </div>

                        <div class="col-md-4 l-a-item">
                            <img src="<?php echo $theme_path;?>/assets/img/duzhev/a_11.jpg" />
                            <h3>Владимир Пресняков</h3>
                            <h4>Советский и российский эстрадный
                                певец</h4>
                        </div>
                    </div>

                    <div class="l-purple-btns-holder">

                        <div class="l-purple-btn multibooker-buy-button"
                             data-frame="Duduzh50PerGogogJoy"
                             data-id="4915"
                             data-host="https://shop.mirbileta.ru"
                             data-ip="shop.mirbileta.ru"
                            >

                            <div class="l-purple-text">Места в амфитеатре от </div>
                            <div class="l-prices">
                                <div class="l-old-price">1500 <i class="fa fa-ruble"></i></div>
                                <div class="l-new-price">1350 <i class="fa fa-ruble"></i></div>
                            </div>
                        </div>

                        <div class="l-purple-btn multibooker-buy-button"
                             data-frame="Duduzh50PerGogogJoy"
                             data-id="4915"
                             data-host="https://shop.mirbileta.ru"
                             data-ip="shop.mirbileta.ru"
                            >
                            <div class="l-purple-text">Места в партере от </div>
                            <div class="l-prices">
                                <div class="l-old-price">2500 <i class="fa fa-ruble"></i></div>
                                <div class="l-new-price">2250 <i class="fa fa-ruble"></i></div>
                            </div>
                        </div>

                    </div>

                    <div class="mirbileta-discount-notifier">Скидку 10% предоставляет mirbileta.ru</div>

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
                    message: '<div class="form-group"><label>Ваш телефон:</label><input type="tel" class="form-control" value="+7"/></div>',
                    buttons: {
                        success: {
                            label: 'Подтвердить',
                            callback: function(){

                            }
                        }

                    }
                })

            });

        });
    </script>



