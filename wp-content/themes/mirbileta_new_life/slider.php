<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:18
 */

    $url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><ACTION_IN_SLIDER>TRUE</ACTION_IN_SLIDER><page_no>1</page_no><rows_max_num>7</rows_max_num>";

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
    $single_width = 100 / $action_count;


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




<!--            <div class="slider-item-vagon" style="width: 33.333%" data-slide="1">-->
<!--                <div class="slider-item slider-item-1" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/slide-2.jpg)"></div>-->
<!---->
<!--                <div class="container slider-item-info">-->
<!--                    <div class="slide-info">-->
<!---->
<!--                        <div class="sa-title">Детские игры</div>-->
<!--                        <div class="sa-venue">театр «Современник»</div>-->
<!--                        <div class="sa-date">27 апреля</div>-->
<!--                        <div class="sa-buy-wrapper">-->
<!--                            <div class="mb-buy mb-buy32 yellow">от 3000 руб.</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="sa-reviews-wrapper">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    Спектакль просто супер, ходили на него уже давно,-->
<!--                                    а впечатлений хоть отбавляй.-->
<!--                                    Советую сходить всем!!! :)-->
<!--                                    <div class="sa-review-chevron fa fa-chevron-right"></div>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    Ходили на спектакль с учениками 6 класса. Всем-->
<!--                                    детям понравилось. Кто-то тайком утирал слёзы.-->
<!--                                    Кто-то держался...-->
<!--                                    <div class="sa-review-chevron fa fa-chevron-right"></div>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                    <div class="slide-reviews-expanded">-->
<!--                        <div class="slide-reviews-expanded-header">-->
<!---->
<!--                            <div class="sl-reviews-exp-nav sl-reviews-exp-prev">-->
<!--                                <div class="sl-reviews-exp-nav-title">Ольга</div>-->
<!--                                <div class="sl-reviews-exp-nav-sub">13 ноября 2015</div>-->
<!--                            </div>-->
<!--                            <div class="sl-reviews-exp-nav sl-reviews-exp-current">-->
<!--                                <div class="sl-reviews-exp-nav-title">Александра</div>-->
<!--                                <div class="sl-reviews-exp-nav-sub">21 декабря 2015</div>-->
<!--                            </div>-->
<!--                            <div class="sl-reviews-exp-nav sl-reviews-exp-next">-->
<!--                                <div class="sl-reviews-exp-nav-title">Сергей</div>-->
<!--                                <div class="sl-reviews-exp-nav-sub">2 января 2016</div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="sl-reviews-exp-close"></div>-->
<!--                        </div>-->
<!--                        <div class="slide-reviews-expanded-body">-->
<!--                            А знаете, Алксандр, мы как раз ходили с детьми 8 и 10 лет, и всем все было понятно! Мне не хотелось бы кого-либо в чем-то разубеждать, т.к., наверное, раз на раз не приходится - актеры не играют дважды абсолютно одинаково, бывает и лучше и хуже, да и люди, которые смотрят спектакль, видят происходящее каждый под своим углом. Но мы во время просмотра "Собак" не препарировали каждую деталь, как то: "очки-пиночеты", "а причем тут Modern Talking?" и проч., однако в глазах детей (и взрослых тоже) стояли искренние слезы, и они верили всему тому, что видели на сцене, забывая, что перед ними люди-актеры, а не это ли высшая похвала актерской игре?!!-->
<!--                            Что касается самой пьесы и затронутой в ней темы, то я расценивала бы ее как "инъекцию человечности", которой так не хватает нам всем в нынешнее время, - увы... Дело ведь не только в брошенных собачках, спектакль учит добру, состраданию, участию, дружбе - прописные, кажется, понятия, но многие даже не догадываются об их подлинном значении. Разумеется, сколько людей - столько и мнений, мне лично спектакль "Собаки" понравился очень, равно как и всем моим абсолютно разновозрастным друзьям и родственникам (10 человек от 8 до 67 лет), также с удовольствием посмотревшим этот спектакль.-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="slider-item-vagon" style="width: 33.333%" data-slide="2">-->
<!--                <div class="slider-item slider-item-2" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/slide-3.jpg)"></div>-->
<!---->
<!--                <div class="container slider-item-info">-->
<!--                    <div class="slide-info">-->
<!---->
<!--                        <div class="sa-title">Матч Россия - Австрия</div>-->
<!--                        <div class="sa-venue">стадион «Открытие Арена»</div>-->
<!--                        <div class="sa-date">14 апреля</div>-->
<!--                        <div class="sa-buy-wrapper">-->
<!--                            <div class="mb-buy mb-buy32 yellow">от 900 руб.</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="sa-reviews-wrapper">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    Спектакль просто супер, ходили на него уже давно,-->
<!--                                    а впечатлений хоть отбавляй.-->
<!--                                    Советую сходить всем!!! :)-->
<!--                                    <div class="sa-review-chevron fa fa-chevron-right"></div>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    Ходили на спектакль с учениками 6 класса. Всем-->
<!--                                    детям понравилось. Кто-то тайком утирал слёзы.-->
<!--                                    Кто-то держался...-->
<!--                                    <div class="sa-review-chevron fa fa-chevron-right"></div>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                    <div class="slide-reviews-expanded">-->
<!--                        <div class="slide-reviews-expanded-header">-->
<!---->
<!--                            <div class="sl-reviews-exp-nav sl-reviews-exp-prev">-->
<!--                                <div class="sl-reviews-exp-nav-title">Ольга</div>-->
<!--                                <div class="sl-reviews-exp-nav-sub">13 ноября 2015</div>-->
<!--                            </div>-->
<!--                            <div class="sl-reviews-exp-nav sl-reviews-exp-current">-->
<!--                                <div class="sl-reviews-exp-nav-title">Александра</div>-->
<!--                                <div class="sl-reviews-exp-nav-sub">21 декабря 2015</div>-->
<!--                            </div>-->
<!--                            <div class="sl-reviews-exp-nav sl-reviews-exp-next">-->
<!--                                <div class="sl-reviews-exp-nav-title">Сергей</div>-->
<!--                                <div class="sl-reviews-exp-nav-sub">2 января 2016</div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="sl-reviews-exp-close"></div>-->
<!--                        </div>-->
<!--                        <div class="slide-reviews-expanded-body">-->
<!--                            А знаете, Алксандр, мы как раз ходили с детьми 8 и 10 лет, и всем все было понятно! Мне не хотелось бы кого-либо в чем-то разубеждать, т.к., наверное, раз на раз не приходится - актеры не играют дважды абсолютно одинаково, бывает и лучше и хуже, да и люди, которые смотрят спектакль, видят происходящее каждый под своим углом. Но мы во время просмотра "Собак" не препарировали каждую деталь, как то: "очки-пиночеты", "а причем тут Modern Talking?" и проч., однако в глазах детей (и взрослых тоже) стояли искренние слезы, и они верили всему тому, что видели на сцене, забывая, что перед ними люди-актеры, а не это ли высшая похвала актерской игре?!!-->
<!--                            Что касается самой пьесы и затронутой в ней темы, то я расценивала бы ее как "инъекцию человечности", которой так не хватает нам всем в нынешнее время, - увы... Дело ведь не только в брошенных собачках, спектакль учит добру, состраданию, участию, дружбе - прописные, кажется, понятия, но многие даже не догадываются об их подлинном значении. Разумеется, сколько людей - столько и мнений, мне лично спектакль "Собаки" понравился очень, равно как и всем моим абсолютно разновозрастным друзьям и родственникам (10 человек от 8 до 67 лет), также с удовольствием посмотревшим этот спектакль.-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->


    </div>
</div>