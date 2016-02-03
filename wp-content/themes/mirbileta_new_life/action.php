    <?php
    /*
        Template Name: single_action
    */

    //$action_alias = $_GET['alias'];
    $cur_url = $_SERVER["REQUEST_URI"];
    $action_alias = substr($cur_url, 1, (strlen($cur_url) - 2));//parse_url($cur_url)->path;

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
    $frame =        $data[array_search("FRAME", $columns)];
    $act_name =     $data[array_search("ACTION_NAME", $columns)];
    $thumb =        (strpos("http", $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)];
    $poster =       (strpos("http", $data[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?               $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_IMAGE", $columns)];
    $act_date =     $data[array_search("ACTION_DATE_STR", $columns)];
    $act_time =     $data[array_search("ACTION_TIME_STR", $columns)];
    $hall =         $data[array_search("HALL_NAME", $columns)];
    $genre =        $data[array_search("SHOW_GENRE", $columns)];
    $venue =        $data[array_search("VENUE_NAME", $columns)];
    $address =      $data[array_search("VENUE_ADDRESS", $columns)];
    $free_places =  $data[array_search("FREE_PLACE_COUNT", $columns)];
    $minprice =     $data[array_search("MIN_PRICE", $columns)];
    $maxprice =     $data[array_search("MAX_PRICE", $columns)];
    $day_of_week =     $data[array_search("ACTION_DAY_OF_WEEK", $columns)];
    $duration =     $data[array_search("DURATION_HOUR_MIN", $columns)];

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
    ?>

    <div class="site-content">

        <div class="container">


            <div class="mb-block-sh posRel">

                <div class="one-action-title"><?php echo $act_name; ?></div>
                <div class="one-action-age"><?php echo $ageCat; ?></div>
                <div class="one-action-venue"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<span class="one-action-hall"><?php echo $hall; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="one-action-address"><i class="fa fa-map-o"></i>&nbsp;&nbsp; <?php echo $address; ?> <span class="show-gmap-hint">Показать карту</span></span></div>
<!--                &nbsp;&nbsp;--><?php //echo $venue;?><!--,-->
                <div class="one-action-gmap">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d8982.005857353408!2d37.6140337!3d55.749790600000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1453912939564" width="100%" height="280" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

                <div class="flLeft one-action-date"><?php echo $act_date;?>, <span class="one-action-time"><?php echo $act_time; ?></span>&nbsp;&nbsp;<span class="one-action-weekday"><?php echo $day_of_week; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="one-action-length">Продолжительность: <?php echo $duration; ?></span></div>

                <div class="mb-buy mb-buy32 yellow flLeft one-action-buy-link">Купить билет</div>



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
                                        <span class="">Отзывы (6)</span>
                                    </div>

                                </div>

                                <div class="ddRow notZindexed sc_tabulatorDDRow">

                                    <div class="tabulatorDDItem sc_tabulatorDDItem opened noMaxHeight" dataitem="0">


                                        <?php echo $description;?>

                                    </div>

                                    <div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight" dataitem="1">



                                    </div>

                                </div>

                            </div>



                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="one-action-actors pr50 flLeft">
                            <div class="one-action-actors-header">Действующе лица:</div>

                            <ul>

                                <?php

                                // Подгружаем актеров

                                $actor_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actor_for_action</command><url>mirbileta.ru</url><action_id>".$act_id."</action_id>";

                                $ch = curl_init();

                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_URL, $actor_url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                                $resp2 = curl_exec($ch);

                                if(curl_errno($ch))
                                print curl_error($ch);
                                else
                                curl_close($ch);

                                $actor_columns = json_decode($resp2)->results["0"]->data_columns;
                                $actor_data = json_decode($resp2)->results["0"]->data;



                                $actors_html = "";

                                foreach ($actor_data as $key2 => $value2){

                                    $actor_id =     $value2[array_search("ACTOR_ID", $actor_columns)];
                                    $actor_name =   $value2[array_search("ACTOR_NAME", $actor_columns)];
                                    $actor_image =  $value2[array_search("URL_IMAGE_MEDIUM", $actor_columns)];
                                    $actor_image_small =  $value2[array_search("URL_IMAGE_SMALL", $actor_columns)];




                                    $actors_html .= '<li data-id="'.$actor_id.'"><a class="one-action-actor-link" href="/actor/?actor_id='.$actor_id.'"><div class="one-action-actor-image" style="background-image: url('.$actor_image_small.')"></div>'
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

                                // Подгружаем актеров

                                $tag_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_action_tag</command><url>mirbileta.ru</url><action_id>".$act_id."</action_id>";
                                $tag_ids = '';
                                $ch = curl_init();

                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                curl_setopt($ch, CURLOPT_URL, $tag_url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                                $resp3 = curl_exec($ch);

                                if(curl_errno($ch))
                                    print curl_error($ch);
                                else
                                    curl_close($ch);

                                $tag_columns = json_decode($resp3)->results["0"]->data_columns;
                                $tag_data = json_decode($resp3)->results["0"]->data;



                                $tag_html = "";
                                $indexer = 0;
                                foreach ($tag_data as $key3 => $value3){

                                    $tag_id =             $value3[array_search("ACTION_TAG_ID", $tag_columns)];
                                    $tag_name =           $value3[array_search("ACTION_TAG", $tag_columns)];

                                    $tag_html .= '<div class="action-tag" data-id="'.$tag_id.'">'.$tag_name.'</div>';

                                    if($indexer == 0){
                                        $tag_ids .= $tag_id;
                                    }else{
                                        $tag_ids .= ','.$tag_id;
                                    }


                                    $indexer++;
                                }

    //                                                            var_dump($tag_columns);
    //                                                            var_dump($tag_data);

                                echo $tag_html;

                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 ">
                        <div class="one-action-widget-header">Купить билет: <span class="one-action-free-places"><?php echo $free_places; ?></span></div>
                        <div class="one-action-widget-how-to">

                            <div class="one-action-widget-how-to-item">1. Выберите сектор <div class="arrow"></div><div class="hint">Кликните по интересующему вас сектору на интеркативной схеме зала.</div></div>
                            <div class="one-action-widget-how-to-item">2. Выберите места <div class="arrow"></div><div class="hint">Для добавления билета в корзину кликните по интересующему вас месту, чтобы вернуться к выбору сектора нажмите кнопку <br/>"К секторам" в левой нижней части схемы.</div></div>
                            <div class="one-action-widget-how-to-item">3. Нажмите "Купить" <div class="arrow"></div><div class="hint">Выбрав билеты нажмите кнопку "Купить", примите условия пользовательского соглашения и нажмите "Подтвердить"</div></div>
                            <div class="one-action-widget-how-to-item">4. Оплата <div class="arrow"></div><div class="hint">После подтверждения система направит вас на страницу оплаты. Оплтаите билеты с помощью банковской карты.</div></div>
                            <div class="one-action-widget-how-to-item">5. Билеты <div class="arrow"></div><div class="hint">После успешной оплаты электронные билеты будут отправлены вам на email указанный при оплате. Распечатайте их и предъявите при проходе на мероприятие.</div></div>

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

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="similar-bg ">


                            <div class="one-action-similar-header">Похожие мероприятия:</div>
                            <div class="one-action-similar-wrapper actions-wrapper marTop40">
                                <?php

                                $similar_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>4</rows_max_num><action_tag_id>".$tag_ids."</action_tag_id>";

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

                                $sim_columns = json_decode($resp4)->results["0"]->data_columns;
                                $sim_data = json_decode($resp4)->results["0"]->data;


                                $sim_actionsHtml = "";

                                foreach ($sim_data as $key4 => $value4){

                                    $act_id =       $value4[array_search("ACTION_ID", $sim_columns)];
                                    $alias =        $value4[array_search("ACTION_URL_ALIAS", $sim_columns)];
                                    $frame =        $value4[array_search("FRAME", $sim_columns)];
                                    $act_name =     $value4[array_search("ACTION_NAME", $sim_columns)];
                                    $poster =       (strpos("http" , $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]) == -1)? $global_prot.'://'.$global_url.'/upload/' . $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)]: $value4[array_search("ACTION_POSTER_IMAGE", $sim_columns)];
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
                                        .'<div class="mb-a-image" style="background-image: url(\''.$poster.'\');"></div>'
                                        .'<a href="/'.$alias.'"><div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div></a>'
                                        .'<div class="mb-a-date">'.$act_date.', <span class="mb-a-time">'.$act_time.'</span></div>'
                                        .'<div class="mb-a-venue">'.$venue.'</div>'
                                        .'<div class="mb-a-buy-holder">'
                                        .'<a href="/'.$alias.'"><div class="mb-buy mb-buy32 yellow">Купить билет</div></a>' //'.$minprice.' руб.
                                        .'</div>'
                                        .'</div>';
                                }

                                if(strlen($sim_actionsHtml) == 0){
                                    echo '<div class="somethinggoeswrong">-</div>';
                                }else{
                                    echo $sim_actionsHtml;
                                }

                                ?>
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



    <script type="text/javascript" src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/widget.js"></script>
    </body>
