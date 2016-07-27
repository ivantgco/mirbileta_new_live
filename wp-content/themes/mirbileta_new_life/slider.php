<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:18
 */

    $url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>".$global_salesite."</url><ACTION_IN_SLIDER>TRUE</ACTION_IN_SLIDER><page_no>1</page_no><rows_max_num>7</rows_max_num>";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $resp = curl_exec($ch);

    if(curl_errno($ch))
        print curl_error($ch);
    else
        curl_close($ch);

    $columns = json_decode($resp)->results["0"]->data_columns;
    $data = json_decode($resp)->results["0"]->data;

    $action_count = count($data);
    $full_width = $action_count * 100;
    $single_width = ($action_count > 0) ? 100 / $action_count : 0;


?>

<div class="slider-wrapper">
    <div class="slider-overflower">

        <div class="slider-train" data-max="<?php echo $full_width;?>" data-move="0" style="width: <?php echo $full_width;?>%">


            <?php

                $slidesHtml = "";
                $indexer = 0;

                foreach ($data as $key => $value){

                    $act_id =                   $value[array_search("ACTION_ID", $columns)];
                    $alias =                    $value[array_search("ACTION_URL_ALIAS", $columns)];
                    $action_slider_image =      $value[array_search("ACTION_SLIDER_IMAGE", $columns)];
                    $action_name =              $value[array_search("ACTION_NAME", $columns)];
                    $venue =                    $value[array_search("VENUE_NAME", $columns)];
                    $act_date =                 $value[array_search("ACTION_DATE_STR", $columns)];
                    $description =              $value[array_search("DESCRIPTION", $columns)];
                    $cutted_desc =              mb_substr($description,0,200,'utf-8');


                    $slidesHtml .= '<div class="slider-item-vagon" style="width: '. $single_width .'%" data-slide="'.$indexer.'">'
                                   .'<div class="slider-item slider-item-'.$indexer.'" style="background-image: url('.$action_slider_image.')"></div>'
                                   .'<div class="container slider-item-info" >'
                                        .'<div class="slide-info">'
                                            .'<div class="sa-title">'.$action_name.'</div>'
                                            .'<div class="sa-venue">'.$venue.'</div>'
                                            .'<div class="sa-date">'.$act_date.'</div>'

                                            .'<div class="sa-buy-wrapper">'
                                                .'<a class="nounderline" href="/'.$alias.'"><div class="mb-buy mb-buy32 yellow">Купить билет</div></a>'
                                            .'</div>'

                                            .'<div class="sa-reviews-wrapper">'
                                                .'<ul>'
                                                    .'<li>'
                                                        .$cutted_desc . '&#8230;'
                                                        .'<div class="sa-review-chevron fa fa-chevron-right"></div>'
                                                    .'</li>'
                                                .'</ul>'
                                            .'</div>'

                                        .'</div>'

                                        .'<div class="slide-reviews-expanded">'
                                            .'<div class="sc_tabulatorParent">'
                                                .'<div class="tabsTogglersRow sc_tabulatorToggleRow">'

                                                    .'<div class="tabToggle sc_tabulatorToggler opened" dataitem="0" title="">'
                                                        .'<span class="">Описание</span>'
                                                    .'</div>'

                                                    .'<div class="tabToggle sc_tabulatorToggler" dataitem="1" title="">'
                                                        .'<span class=""></span>' //Отзывы
                                                    .'</div>'

                                                    .'<div class="sl-reviews-exp-close"></div>'

                                                .'</div>'

                                                .'<div class="ddRow notZindexed sc_tabulatorDDRow">'

                                                    .'<div class="tabulatorDDItem sc_tabulatorDDItem opened noMaxHeight chromeScroll" dataitem="0">'
                                                        .$description
                                                    .'</div>'

                                                    .'<div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight chromeScroll" dataitem="1">'
                                                        .'asdadsdasdsa'
                                                    .'</div>'

                                                .'</div>'

                                            .'</div>'
                                        .'</div>'


                                    .'</div>'
                                .'</div>';
                    $indexer ++;
                }

                echo $slidesHtml;

                echo '</div><div class="slider-dots-wrapper">';

                $dots_html = '';
                $indexer2 = 0;


                foreach ($data as $key2 => $value2){

                    if($indexer2 == 0){

                        $dots_html .= '<div class="slider-dot active" data-slide="'.$indexer2.'"></div>';

                    }else{

                        $dots_html .= '<div class="slider-dot" data-slide="'.$indexer2.'"></div>';

                    }

                    $indexer2 ++;
                }

                echo $dots_html;

                echo '</div>';



            ?>



            <div class="main-menu-wrapper-main-page">
                <div class="container">

                    <?php
                    $args = array(
                        'menu'            => 'main_menu',     // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                        // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                        'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                        'container_class' => 'main-menu',     // (string) class контейнера (div тега)
                        'container_id'    => '',              // (string) id контейнера (div тега)
                        'menu_class'      => '',              // (string) class самого меню (ul тега)
                        'menu_id'         => '',              // (string) id самого меню (ul тега)
                        'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                        'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                        'before'          => '',              // (string) Текст перед <a> каждой ссылки
                        'after'           => '',              // (string) Текст после </a> каждой ссылки
                        'link_before'     => '<div class="mm-title-mp"><span class="afisha-icon"></span>',              // (string) Текст перед анкором (текстом) ссылки
                        'link_after'      => '</div>',              // (string) Текст после анкора (текста) ссылки
                        'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                        'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
                        'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
                    );

                    wp_nav_menu($args)
                    ?>

                </div>
            </div>




    </div>

</div>

<!--<div class="container posRel">-->
<!--    <a href="/contest-fast"><div class="contest-fast-launcher"><span class="contest-fast-launcher-sub">Конкурс</span><br/>"Кто быстрее?!"</div></a>-->
<!--</div>-->