<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:28
 */

    require('./vendor/lawondyss/moment-php/src/MomentPHP/MomentPHP.php');

//    require('./vendor/lawondyss/moment-php/src/Moment.php');

    $m = new MomentPHP\MomentPHP(); // default is "now" UTC
    $m2 = new MomentPHP\MomentPHP(); // default is "now" UTC
    $m3 = new MomentPHP\MomentPHP(); // default is "now" UTC
    $m4 = new MomentPHP\MomentPHP(); // default is "now" UTC


    $today = $m->format('d.m.Y');
    $dayOfWeek = $m->dayOfWeek();
    $dateOfEndOfWeek = $m2->add(7 - $dayOfWeek, 'day')->add(7,'day')->format('d.m.Y');
    $dateOfEndOfWeek2 = $m3->add(7 - $dayOfWeek, 'day')->add(7,'day');//->format('d.m.Y');
    $dateOfEndOfWeek3 = $m4->add(7 - $dayOfWeek, 'day')->add(7,'day');//->format('d.m.Y');



    $wkd_start = new MomentPHP\MomentPHP();
    $wkd_start->add(6 - $dayOfWeek, 'day');

    $wkd_end = new MomentPHP\MomentPHP();
    $wkd_end->add(7 - $dayOfWeek, 'day');

    $nwd_start = $dateOfEndOfWeek2->sub(6,'day');



    $url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_afisha</command><url>mirbileta.ru</url><form_date>'.$today.'</form_date><to_date>'. $dateOfEndOfWeek .'</form_date>";

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


    $todayActions =         array();
    $tomorrowActions =      array();
    $weekendActions =       array();
    $nextweekActions =      array();



//    echo $nwd_start->format("d.m.Y") . ' ' . $dateOfEndOfWeek;

    foreach($data as $key => $value){

        $a_date =  substr($value[array_search("ACTION_DATE", $columns)], 0, 10);


        $inst = new MomentPHP\MomentPHP($a_date);
        $inst2 = new MomentPHP\MomentPHP($a_date);
        $inst3 = new MomentPHP\MomentPHP();

        $inst3->add(1,'day');

//        echo $a_date . '  ---  {' . $inst3->format('d.m.Y') . '}  :  ';

//        echo $wkd_start->format('d.m.Y') . '  <>  ' . $wkd_end->format('d.m.Y');
//        echo $a_date . ' --  ';

        $inst2Format = $inst2->format('d.m.Y');

        if($a_date == $today){

            array_push($todayActions, $value);

        }else if($a_date == $inst3->format('d.m.Y')){

            array_push($tomorrowActions, $value);

        }else if($inst2Format == $wkd_start->format('d.m.Y') || $inst2Format == $wkd_end->format('d.m.Y')){

            array_push($weekendActions, $value);

        }else if($inst2 >= $nwd_start && $inst2 <= $dateOfEndOfWeek3){
//            echo '2  -   2';
            array_push($nextweekActions, $value);

        }
    }

//
//var_dump($todayActions);
//echo '------------';
//var_dump($tomorrowActions);
//echo '------------';
//var_dump($weekendActions);
//echo '------------';
//var_dump($nextweekActions);


?>

<div class="page-headline-wrapper">
    <div class="p-h-line"></div>
    <div class="p-h-title"><span>Ближайшие мероприятия:</span></div>
    <?php


    ?>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="mb-block">
            <div class="mb-nrs-wrapper">
                <div class="mb-nrs-header">Сегодня:</div>
                <div class="mb-nrs-body chromeScroll" data-date="today">

                    <?php

                    $today_html = '';

                    foreach($todayActions as $tdKey => $tdValue){

                        $act_id =   $tdValue[array_search("ACTION_ID", $columns)];
                        $act_name = $tdValue[array_search("ACTION_NAME", $columns)];
                        $alias =    (strlen($tdValue[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? $tdValue[array_search("SHOW_URL_ALIAS", $columns)] : $tdValue[array_search("ACTION_URL_ALIAS", $columns)];
                        $poster =   (strlen($tdValue[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0) ? $tdValue[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultSmall;
                        $venue =    $tdValue[array_search("VENUE_NAME", $columns)];

                        $minprice = $tdValue[array_search("MIN_PRICE", $columns)];
                        $maxprice = $tdValue[array_search("MAX_PRICE", $columns)];

                        $age_cat =  $tdValue[array_search("AGE_CATEGORY", $columns)];
                        $datestr =  to_short_mth($tdValue[array_search("ACTION_DATE_STR", $columns)]);
                        $timestr =  $tdValue[array_search("ACTION_TIME_STR", $columns)];

                        $minmaxString = ($minprice)? ($minprice == $maxprice)? 'по '. $minprice . ' руб.' :  $minprice . ' - ' . $maxprice . ' руб.' : '';

                        $today_html .= '<a href="/'.$alias.'">'
                                        .'<div class="mb-sm-action" data-id="'.$act_id.'">'
                                            .'<div class="mb-sm-a-image" style="background-image: url(\''.$poster.'\');"></div>'
                                            .'<div class="mb-sm-a-title">'.$act_name.'</div>'
                                            .'<div class="mb-sm-a-venue">'.$venue.'</div>'
                                            .'<div class="mb-sm-a-price">'.$minmaxString.'</div>'
                                            .'<div class="mb-sm-a-age">'.$age_cat.'</div>'
                                            .'<div class="mb-sm-a-date">'.$datestr.', <span class="mb-a-time">'.$timestr.'</span></div>'
                                        .'</div>'
                                    .'</a>';

                    }

                    if(count($todayActions) > 0){
                        echo $today_html;
                    }else{
                        echo '<div class="nothing_to_show">Ничего нет</div>';
                    }


                    ?>


                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-block">
            <div class="mb-nrs-wrapper">
                <div class="mb-nrs-header">Завтра:</div>
                <div class="mb-nrs-body chromeScroll" data-date="tomorrow">

                    <?php

                    $tomorrow_html = '';

                    foreach($tomorrowActions as $tdKey => $tdValue){

                        $act_id = $tdValue[array_search("ACTION_ID", $columns)];
                        $act_name = $tdValue[array_search("ACTION_NAME", $columns)];
                        $alias =    (strlen($tdValue[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? $tdValue[array_search("SHOW_URL_ALIAS", $columns)] : $tdValue[array_search("ACTION_URL_ALIAS", $columns)];
                        $poster =   (strlen($tdValue[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0) ? $tdValue[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultSmall;
                        $venue = $tdValue[array_search("VENUE_NAME", $columns)];

                        $minprice = $tdValue[array_search("MIN_PRICE", $columns)];
                        $maxprice = $tdValue[array_search("MAX_PRICE", $columns)];

                        $age_cat = $tdValue[array_search("AGE_CATEGORY", $columns)];
                        $datestr = to_short_mth($tdValue[array_search("ACTION_DATE_STR", $columns)]);
                        $timestr = $tdValue[array_search("ACTION_TIME_STR", $columns)];

                        $minmaxString = ($minprice)? ($minprice == $maxprice)? 'по '. $minprice . ' руб.' :  $minprice . ' - ' . $maxprice . ' руб.' : '';


                        $tomorrow_html .= '<a href="/'.$alias.'">'
                            .'<div class="mb-sm-action" data-id="'.$act_id.'">'
                            .'<div class="mb-sm-a-image" style="background-image: url(\''.$poster.'\');"></div>'
                            .'<div class="mb-sm-a-title">'.$act_name.'</div>'
                            .'<div class="mb-sm-a-venue">'.$venue.'</div>'
                            .'<div class="mb-sm-a-price">'.$minmaxString.'</div>'
                            .'<div class="mb-sm-a-age">'.$age_cat.'</div>'
                            .'<div class="mb-sm-a-date">'.$datestr.', <span class="mb-a-time">'.$timestr.'</span></div>'
                            .'</div>'
                            .'</a>';

                    }

                    if(count($tomorrowActions) > 0){
                        echo $tomorrow_html;
                    }else{
                        echo '<div class="nothing_to_show">Ничего нет</div>';
                    }


                    ?>




                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-block">
            <div class="mb-nrs-wrapper">
                <div class="mb-nrs-header">На выходных:</div>
                <div class="mb-nrs-body chromeScroll" data-date="weekend">

                    <?php

                    $weekend_html = '';

                    foreach($weekendActions as $tdKey => $tdValue){

                        $act_id = $tdValue[array_search("ACTION_ID", $columns)];
                        $act_name = $tdValue[array_search("ACTION_NAME", $columns)];
                        $alias =    (strlen($tdValue[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? $tdValue[array_search("SHOW_URL_ALIAS", $columns)] : $tdValue[array_search("ACTION_URL_ALIAS", $columns)];
                        $poster =   (strlen($tdValue[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0) ? $tdValue[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultSmall;
                        $venue = $tdValue[array_search("VENUE_NAME", $columns)];

                        $minprice = $tdValue[array_search("MIN_PRICE", $columns)];
                        $maxprice = $tdValue[array_search("MAX_PRICE", $columns)];

                        $age_cat = $tdValue[array_search("AGE_CATEGORY", $columns)];
                        $datestr = to_short_mth($tdValue[array_search("ACTION_DATE_STR", $columns)]);
                        $timestr = $tdValue[array_search("ACTION_TIME_STR", $columns)];

                        $minmaxString = ($minprice)? ($minprice == $maxprice)? 'по '. $minprice . ' руб.' :  $minprice . ' - ' . $maxprice . ' руб.' : '';


                        $weekend_html .= '<a href="/'.$alias.'">'
                            .'<div class="mb-sm-action" data-id="'.$act_id.'">'
                            .'<div class="mb-sm-a-image" style="background-image: url(\''.$poster.'\');"></div>'
                            .'<div class="mb-sm-a-title">'.$act_name.'</div>'
                            .'<div class="mb-sm-a-venue">'.$venue.'</div>'
                            .'<div class="mb-sm-a-price">'.$minmaxString.'</div>'
                            .'<div class="mb-sm-a-age">'.$age_cat.'</div>'
                            .'<div class="mb-sm-a-date">'.$datestr.', <span class="mb-a-time">'.$timestr.'</span></div>'
                            .'</div>'
                            .'</a>';

                    }

                    if(count($weekendActions) > 0){
                        echo $weekend_html;
                    }else{
                        echo '<div class="nothing_to_show">Ничего нет</div>';
                    }


                    ?>


                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-block">
            <div class="mb-nrs-wrapper">
                <div class="mb-nrs-header">Следующая неделя:</div>
                <div class="mb-nrs-body chromeScroll" data-date="nextweek">

                    <?php

                    $nextweek_html = '';

                    foreach($nextweekActions as $tdKey => $tdValue){

                        $act_id = $tdValue[array_search("ACTION_ID", $columns)];
                        $act_name = $tdValue[array_search("ACTION_NAME", $columns)];
                        $alias =    (strlen($tdValue[array_search("SHOW_URL_ALIAS", $columns)]) > 0) ? $tdValue[array_search("SHOW_URL_ALIAS", $columns)] : $tdValue[array_search("ACTION_URL_ALIAS", $columns)];
                        $poster =   (strlen($tdValue[array_search("ACTION_POSTER_IMAGE", $columns)]) > 0) ? $tdValue[array_search("ACTION_POSTER_IMAGE", $columns)] : $defaultSmall;
                        $venue = $tdValue[array_search("VENUE_NAME", $columns)];

                        $minprice = $tdValue[array_search("MIN_PRICE", $columns)];
                        $maxprice = $tdValue[array_search("MAX_PRICE", $columns)];

                        $age_cat = $tdValue[array_search("AGE_CATEGORY", $columns)];
                        $datestr = to_short_mth($tdValue[array_search("ACTION_DATE_STR", $columns)]);
                        $timestr = $tdValue[array_search("ACTION_TIME_STR", $columns)];

                        $minmaxString = ($minprice)? ($minprice == $maxprice)? 'по '. $minprice . ' руб.' :  $minprice . ' - ' . $maxprice . ' руб.' : '';


                        $nextweek_html .= '<a href="/'.$alias.'">'
                            .'<div class="mb-sm-action" data-id="'.$act_id.'">'
                            .'<div class="mb-sm-a-image" style="background-image: url(\''.$poster.'\');"></div>'
                            .'<div class="mb-sm-a-title">'.$act_name.'</div>'
                            .'<div class="mb-sm-a-venue">'.$venue.'</div>'
                            .'<div class="mb-sm-a-price">'.$minmaxString.'</div>'
                            .'<div class="mb-sm-a-age">'.$age_cat.'</div>'
                            .'<div class="mb-sm-a-date">'.$datestr.', <span class="mb-a-time">'.$timestr.'</span></div>'
                            .'</div>'
                            .'</a>';

                    }

                    if(count($nextweekActions) > 0){
                        echo $nextweek_html;
                    }else{
                        echo '<div class="nothing_to_show">Ничего нет</div>';
                    }


                    ?>


                </div>
            </div>
        </div>
    </div>
</div>