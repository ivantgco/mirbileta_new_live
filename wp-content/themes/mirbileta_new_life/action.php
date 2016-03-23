    <?php
    /*
        Template Name: single_action
    */

    $href = request_url();
    $arr = parse_url($href);
    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><action_url_alias>".$action_alias."</action_url_alias>";

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

//    $jData = json_decode($data);

    $columns = json_decode($resp)->results["0"]->data_columns;
    $data = json_decode($resp)->results["0"]->data[0];

    $act_id =       $data[array_search("ACTION_ID", $columns)];
    $alias =        $data[array_search("ACTION_URL_ALIAS", $columns)];
    $show_alias =   $data[array_search("SHOW_URL_ALIAS", $columns)];
    $frame =        $data[array_search("FRAME", $columns)];
    $act_name =     $data[array_search("ACTION_NAME", $columns)];
    $g_act_name =     $data[array_search("ACTION_NAME", $columns)];
    $thumb =        (strlen($data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0) ? (strpos("http", $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $defaultPoster;
    $poster =       (strlen($data[array_search("ACTION_POSTER_IMAGE", $columns)])> 0) ? (strpos("http", $data[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?                          $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_IMAGE", $columns)]: $defaultPoster;
    $act_date_full =     $data[array_search("ACTION_DATE", $columns)];
    $act_date =     $data[array_search("ACTION_DATE_STR", $columns)];
    $act_date_year =    to_afisha_date($data[array_search("ACTION_DATE", $columns)], 'year', 'rus');
    $act_time =     $data[array_search("ACTION_TIME_STR", $columns)];
    $hall =         $data[array_search("HALL_NAME", $columns)];
    $genre =        $data[array_search("SHOW_GENRE", $columns)];
    $venue =        $data[array_search("VENUE_NAME", $columns)];
    $address =      $data[array_search("HALL_ADDR", $columns)];
    $g_address =    $data[array_search("HALL_GOOGLE_ADDRESS", $columns)];
    $free_places =  $data[array_search("FREE_PLACE_COUNT", $columns)];
    $minprice =     $data[array_search("MIN_PRICE", $columns)];
    $maxprice =     $data[array_search("MAX_PRICE", $columns)];
    $day_of_week =  $data[array_search("ACTION_DAY_OF_WEEK", $columns)];
    $duration =     $data[array_search("DURATION_HOUR_MIN", $columns)];
    $is_wo =        $data[array_search("ACTION_TYPE", $columns)] == 'ACTION_WO_PLACES';
    $sbag =         $data[array_search("SPLIT_BY_AREA_GROUP", $columns)] == 'TRUE';
    $tag_list =     $data[array_search("ACTION_TAG_LIST", $columns)];
    $actor_list =   $data[array_search("ACTION_ACTOR_LIST", $columns)];

    $isInfo = strlen($description) > 0;
    $description = $data[array_search("DESCRIPTION", $columns)];

    $ageCat = strlen($data[array_search("AGE_CATEGORY", $columns)]) ? $data[array_search("AGE_CATEGORY", $columns)] : '0+';
    $act_date_time = $data[array_search("ACTION_DATE_TIME", $columns)];

    $short_date = to_afisha_date($act_date_time, "short_date", "rus");
    $short_date_with_year = to_afisha_date($act_date_time, "short_date_with_year", "rus");
    $week_and_time = to_afisha_date($act_date_time, "week_and_time", "rus");
    $weekday = to_afisha_date($act_date_time, "weekday", "rus");
    $time = to_afisha_date($act_date_time, "time", "rus");




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
//    echo $cur_url;

    ?>

    <div class="site-content">

        <div class="container">


            <div class="mb-block-sh posRel">

                <div class="one-action-title"><?php echo $act_name; ?></div>
                <div class="one-action-age"><?php echo $ageCat; ?></div>
                <div class="one-action-venue">
                    <i class="fa fa-map-marker"></i>&nbsp;&nbsp;
                    <span class="one-action-hall"><?php echo $hall; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

                    <?php if(strlen($address) > 0): ?>

                        <span class="one-action-address"><i class="fa fa-map-o"></i>&nbsp;&nbsp; <?php echo $address; ?> <span class="show-gmap-hint">Показать карту</span></span>

                    <?php endif; ?>

                    </div>

                    <?php if(strlen($address) > 0): ?>

                        <div class="one-action-gmap">

                            <input id="address" type="hidden" value="<?php echo $g_address; ?>" />

                            <div style=" width: 100%; height: 280px;" id="map_canvas"></div>

                        </div>

                    <?php endif; ?>

                <?php

                    $durationHtml = (strlen($duration) > 1)? '<span class="one-action-length">Продолжительность: '. $duration .' </span>' : '';

                ?>

<!--                -->
                <div class="flLeft one-action-date"><?php echo $act_date;?> <span class="one-action-year"><?php echo $act_date_year;?></span>, <span class="one-action-time"><?php echo $act_time; ?></span>&nbsp;&nbsp;<span class="one-action-weekday"><?php echo $day_of_week; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $durationHtml; ?></div>







                <?php
                    if($free_places == 0){

                }else{

                ?>

                <div class="mb-buy mb-buy32 yellow flLeft one-action-buy-link">Купить билет</div>

                <?php

                }

                ?>

                <?php if(strlen($show_alias) > 0):?>

                    <a href="/<?php echo $show_alias; ?>"><div class="mb-buy mb-buy32 blue flRight set-another-date">Выбрать дату</div></a>

                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="one-action-image-wrapper" style="background-image: url(<?php echo $poster;?>)"></div>

                        <div class="one-action-desc">

                            <div class="tabsParent sc_tabulatorParent">
                                <div class="tabsTogglersRow sc_tabulatorToggleRow">

                                    <div class="tabToggle sc_tabulatorToggler opened" dataitem="0" title="">
                                        <span class="">Описание</span>
                                    </div>

                                    <div class="tabToggle sc_tabulatorToggler " dataitem="1" title="">
                                        <span class=""></span>
<!--                                        Отзывы (6)-->
                                    </div>

                                </div>

                                <div class="ddRow notZindexed sc_tabulatorDDRow">

                                    <div class="tabulatorDDItem sc_tabulatorDDItem opened noMaxHeight chromeScroll" dataitem="0">


                                        <?php echo $description;?>

                                    </div>

                                    <div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight chromeScroll" dataitem="1">



                                    </div>

                                </div>

                            </div>



                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="one-action-actors pr50 flLeft">

                            <?php
                                $actorsArray = json_decode($actor_list);

                                 if(count($actorsArray) > 0): ?>

                            <div class="one-action-actors-header">Действующе лица:</div>

                            <?php endif ?>

                            <ul>

                                <?php

                                // Подгружаем актеров


                                $actors_html = "";

                                foreach ($actorsArray as $key2 => $value2){

                                    $actor_id =     $value2->id;
                                    $actor_alias =  $value2->alias;
                                    $actor_name =   $value2->name;
                                    $actor_image_small =  $value2->url_image_small;




                                    $actors_html .= '<li data-id="'.$actor_id.'"><a class="one-action-actor-link" href="/'.$actor_alias.'"><div class="one-action-actor-image" style="background-image: url('.$actor_image_small.')"></div>'
                                                        .'<div class="one-action-actor-name">'.$actor_name.'</div>'
                                                    .'</a></li>';
                                }

//                                var_dump($actor_columns);
                                echo $actors_html;

                                ?>

                            </ul>

                        </div>
                        <div class="one-action-tags pr50 flLeft">

                            <div class="one-action-actors-header">Теги мероприятия:</div>
                            <div class="one-action-tags-body">
                                <?php

                                // Собираем массив тегов

                                $tagsArray = json_decode($tag_list);


                                $tag_html = "";
                                $indexer = 0;

                                foreach ($tagsArray as $key3 => $value3){

                                    $tag_id =             $value3->id;
                                    $tag_name =           $value3->name;

                                    $tag_html .= '<a class="action-tag-link" href="/extend_search?action_tag_id='.$tag_id.'"><div class="action-tag" data-id="'.$tag_id.'">'.$tag_name.'</div></a>';

                                    if($indexer == 0){
                                        $tag_ids .= $tag_id;
                                    }else{
                                        $tag_ids .= ','.$tag_id;
                                    }


                                    $indexer++;
                                }

                                echo $tag_html;

                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 ">




                        <?php

                        $minmaxString = ($minprice == $maxprice)? 'по '. $minprice . ' рублей' : 'от ' . $minprice . ' до ' . $maxprice . ' рублей';

                        ?>

                        <?php
                            if($free_places == 0){

                            ?>

                                <div class="net-bilet">Билетов нет. Звоните +7 (906) 063-88-66</div>


                            <?php

                            }else{

                        ?>
                                <div class="one-action-widget-header">Купить билет: <span class="one-action-free-places"><?php echo $free_places; ?> мест, <?php echo $minmaxString; ?></div>
                                <div class="one-action-widget-how-to">


                                    <?php
                                    $manualHtml = '<div class="one-action-widget-how-instruction">ИНСТРУКЦИЯ:</div>';

                                    if($is_wo){
                                        $manualHtml .=    '<div class="one-action-widget-how-to-item">1. Выберите места <div class="arrow"></div><div class="hint">Добавьте входные билеты в корзину.</div></div>'
                                                        .'<div class="one-action-widget-how-to-item">2. Нажмите "Купить" <div class="arrow"></div><div class="hint">Выбрав билеты нажмите кнопку "Купить", примите условия пользовательского соглашения и нажмите "Подтвердить"</div></div>'
                                                        .'<div class="one-action-widget-how-to-item">3. Оплата <div class="arrow"></div><div class="hint">После подтверждения система направит вас на страницу оплаты. Оплтаите билеты с помощью банковской карты.</div></div>'
                                                        .'<div class="one-action-widget-how-to-item">4. Билеты <div class="arrow"></div><div class="hint">После успешной оплаты электронные билеты будут отправлены вам на email указанный при оплате. Распечатайте их и предъявите при проходе на мероприятие.</div></div>';
                                    }else{

                                        if($sbag){

                                            $manualHtml .=    '<div class="one-action-widget-how-to-item">1. Выберите сектор <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-sectors"></div><div class="text-holder">Наведите курсор на интересующий вас сектор.<br/>Сектора подсвечивающиеся синим цветом доступны для продажи, серые - нет.<br/><br/>Для выбора сектора кликните по нему левой кнопкой мыши.<br/>Чтобы вернуться к выбору секторов нажмите кнопку «К секторам» в нижней левой части экрана.<br/><br/>Для перемещения схемы зажмите левую клавишу мыши и перевдиньте курсор.<br/>Для масштабирования схемы используйте колесико мыши или кнопки «+» и «-»</div></div></div>'
                                                            .'<div class="one-action-widget-how-to-item">2. Выберите места <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-places"></div> <div class="text-holder">Для добавления места в корзину кликните по нему левой кнопкой мыши,<br/>для удаления места из корзины кликните по нему повторно.<br/><br/>Для перемещения схемы зажмите левую клавишу мыши и перевдиньте курсор.<br/>Для масштабирования схемы используйте колесико мыши или кнопки «+» и «-»</div> </div></div>'
                                                            .'<div class="one-action-widget-how-to-item">3. Нажмите "Купить" <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-buy"></div><div class="text-holder">После добавления мест в корзину нажмите кнопку «Купить» в нижней правой части<br/>экрана, подтвердите свое согласие с правилами покупки во всплывающем окне<br/>и нажмите «Подтвердить».<br/><br/>Далее система перенаправит вас на страницу платежной системы для оплаты заказа.</div></div></div>'
                                                            .'<div class="one-action-widget-how-to-item">4. Оплата <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-purchase"></div><div class="text-holder">Оплатите ваш заказ с помощью банковской карты.<br/><br/>Будьте внимательны при указании адреса электронной почты, ведь именно на нее мы отправим вам билеты.<br/><br/>Не рекомендуется указывать корпоративную почту,<br/>так как письмо может не пройти через спам-фильтры почтового сервера.</div></div></div>'
                                                            .'<div class="one-action-widget-how-to-item">5. Билеты <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-tickets"></div><div class="text-holder">После успешной оплаты билеты автоматически отправятся на указанный<br/>вами адрес электронной почты, распечатайте их и предъявите при проходе на мероприятие.<br/><br/>Если билеты не пришли в течении 10 минут, позвоните нам: +7 (499) 391-61-97</div></div></div>';

                                        }else{
                                            $manualHtml .=    '<div class="one-action-widget-how-to-item">1. Выберите места <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-places"></div> <div class="text-holder">Для добавления места в корзину кликните по нему левой кнопкой мыши,<br/>для удаления места из корзины кликните по нему повторно.<br/><br/>Для перемещения схемы зажмите левую клавишу мыши и перевдиньте курсор.<br/>Для масштабирования схемы используйте колесико мыши или кнопки «+» и «-»</div> </div></div>'
                                                            .'<div class="one-action-widget-how-to-item">2. Нажмите "Купить" <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-buy"></div><div class="text-holder">После добавления мест в корзину нажмите кнопку «Купить» в нижней правой части<br/>экрана, подтвердите свое согласие с правилами покупки во всплывающем окне<br/>и нажмите «Подтвердить».<br/><br/>Далее система перенаправит вас на страницу платежной системы для оплаты заказа.</div></div></div>'
                                                            .'<div class="one-action-widget-how-to-item">3. Оплата <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-purchase"></div><div class="text-holder">Оплатите ваш заказ с помощью банковской карты.<br/><br/>Будьте внимательны при указании адреса электронной почты, ведь именно на нее мы отправим вам билеты.<br/><br/>Не рекомендуется указывать корпоративную почту,<br/>так как письмо может не пройти через спам-фильтры почтового сервера.</div></div></div>'
                                                            .'<div class="one-action-widget-how-to-item">4. Билеты <div class="arrow"></div><div class="hint"><span class="infoi">i</span><div class="image-holder hint-tickets"></div><div class="text-holder">После успешной оплаты билеты автоматически отправятся на указанный<br/>вами адрес электронной почты, распечатайте их и предъявите при проходе на мероприятие.<br/><br/>Если билеты не пришли в течении 10 минут, позвоните нам: +7 (499) 391-61-97</div></div></div>';
                                        }

                                    }
                                    echo $manualHtml;

                                    ?>




                                </div>
                                <div class="one-action-widget-wrapper">

                                    <div id="multibooker-widget-wrapper"
                                         data-actions="<?php echo $act_id ?>"
                                         data-widget_theme="light"
                                         data-withdelivery="false"
                                         data-mirbileta="true"
                                         data-width=""
                                         data-frame="<?php echo $frame ?>"
                                         data-host=<?php echo $global_prot ."://". $global_url.'/'; ?>
                                         data-ip="<?php echo $global_url; ?>">

                                        <div class="mirbileta-widget-wrapper-wait-text"><i class="fa fa-cog fa-spin"></i>&nbsp;&nbsp;Подождите, загружается модуль продажи билетов...</div>

                                    </div>


                                    <div class="one-action-widget-underwrapper zi20 posRel"></div>

                                </div>

                        <?php
                            }
                        ?>



                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="similar-bg ">


                            <div class="one-action-similar-header">Похожие мероприятия:</div>
                            <div class="one-action-similar-wrapper actions-wrapper marTop40">
                                <?php

                                $similar_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_similar_action</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>4</rows_max_num><action_url_alias>".$alias."</action_url_alias>";

                                $ch = curl_init();

                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_URL, $similar_url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                                $resp4 = curl_exec($ch);

                                if(curl_errno($ch))
                                    print curl_error($ch);
                                else
                                    curl_close($ch);

                                if(json_decode($resp4)->results["0"]->code && json_decode($resp4)->results["0"]->code != 0){

                                    echo '<div class="somethinggoeswrong">Нет похожих мероприятий</div>';



                                }else{
                                    $sim_columns = json_decode($resp4)->results["0"]->data_columns;
                                    $sim_data = json_decode($resp4)->results["0"]->data;


                                    $sim_actionsHtml = "";

                                    foreach ($sim_data as $key4 => $value4){

                                        $act_id =       $value4[array_search("ACTION_ID", $sim_columns)];
                                        $alias =        $value4[array_search("ACTION_URL_ALIAS", $sim_columns)];
                                        $venue_alias =        $value4[array_search("VENUE_URL_ALIAS", $sim_columns)];
                                        $frame =        $value4[array_search("FRAME", $sim_columns)];
                                        $act_name =     $value4[array_search("ACTION_NAME", $sim_columns)];
                                        $poster =       (strlen($value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]) > 0)? (strpos("http" , $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]) == -1)? $global_prot.'://'.$global_url.'/upload/' . $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]: $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)] : $defaultPoster;
                                        $act_date =     $value4[array_search("ACTION_DATE_STR", $sim_columns)];
                                        $act_time =     $value4[array_search("ACTION_TIME_STR", $sim_columns)];
                                        $hall =         $value4[array_search("HALL", $sim_columns)];
                                        $genre =        $value4[array_search("SHOW_GENRE", $sim_columns)];
                                        $venue =        $value4[array_search("VENUE_NAME", $sim_columns)];
                                        $minprice =     $value4[array_search("MIN_PRICE", $sim_columns)];
                                        $maxprice =     $value4[array_search("MAX_PRICE", $sim_columns)];

                                        $isInfo =       strlen($description) > 0;
                                        $description =  $value4[array_search("DESCRIPTION", $sim_columns)];

                                        $ageCat =       strlen($value4[array_search("AGE_CATEGORY", $sim_columns)])? $value4[array_search("AGE_CATEGORY", $sim_columns)]: '0+';
                                        $act_date_time = $value4[array_search("ACTION_DATE_TIME", $sim_columns)];


                                        $sim_actionsHtml .=      '<div class="mb-block mb-action" data-id="'.$act_id.'">'
                                            .'<a href="/'.$alias.'"><div class="mb-a-image" style="background-image: url(\''.$poster.'\');"></div></a>'
                                            .'<a href="/'.$alias.'"><div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div></a>'
                                            .'<div class="mb-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                                            .'<a href="/'.$venue_alias.'"><div class="mb-a-venue">'.$venue.'</div></a>'
                                            .'<div class="mb-a-buy-holder">'
                                            .'<a href="/'.$alias.'"><div class="mb-buy mb-buy32 yellow">Купить билет</div></a>' //'.$minprice.' руб.
                                            .'</div>'
                                            .'</div>';
                                    }

                                    if(strlen($sim_actionsHtml) == 0){
                                        echo '<div class="somethinggoeswrong">Мероприятие настолько уникально, что нет ничего похожего...</div>';
                                    }else{
                                        echo $sim_actionsHtml;
                                    }
                                }



                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="action-footer-info">
                            По всем вопросам покупки электронных билетов на мероприятие <?php echo $g_act_name; ?> обращайтесь по тел.: +7 (499) 391-<span>61</span>-97
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <?php

    get_footer();

    ?>


    <?php
    if($free_places > 0){


        //7562 бой
        //7556
        //7564 отменим

    ?>
        <script type="text/javascript" src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/widget.js"></script>
    <?php

    }
    ?>




    </body>

    <?php if(strlen($address) > 0): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var geocoder;
            var map;
            var address = $('#address').val();
            function initialize() {
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(-34.397, 150.644);
                var myOptions = {
                    zoom: 16,
                    center: latlng,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                    },
                    navigationControl: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                if (geocoder) {
                    geocoder.geocode({
                        'address': address
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                                map.setCenter(results[0].geometry.location);

                                var infowindow = new google.maps.InfoWindow({
                                    content: '<b>' + address + '</b>',
                                    size: new google.maps.Size(150, 50)
                                });

                                var marker = new google.maps.Marker({
                                    position: results[0].geometry.location,
                                    map: map,
                                    title: address
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                    infowindow.open(map, marker);
                                });

                            } else {
//                                alert("No results found");
                            }
                        } else {
//                            alert("Geocode was not successful for the following reason: " + status);
                        }
                    });
                }
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        });
    </script>
    <?php endif ?>