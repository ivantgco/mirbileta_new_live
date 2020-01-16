<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 12.05.16
 * Time: 13:16
 */

    $url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><page_no>1</page_no><rows_max_num>10</rows_max_num>";
    error_log('IN main-actions.php '. $url);
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

    $actionsHtml = "";

    foreach ($data as $key => $value){

        $act_id =       $value[array_search("ACTION_ID", $columns)];
        $alias =        $value[array_search("ACTION_URL_ALIAS", $columns)];
        $venue_alias =  $value[array_search("VENUE_URL_ALIAS", $columns)];
        $frame =        $value[array_search("FRAME", $columns)];
        $act_name =     $value[array_search("ACTION_NAME", $columns)];
    //        $thumb =        (strpos("http" , $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)];
        $poster =       (strpos("http" , $value[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1)? 'https://shop.mirbileta.ru/upload/' . $value[array_search("ACTION_POSTER_IMAGE", $columns)]: $value[array_search("ACTION_POSTER_IMAGE", $columns)];
        $act_date =     $value[array_search("ACTION_DATE_STR", $columns)];
        $act_time =     $value[array_search("ACTION_TIME_STR", $columns)];
        $hall =         $value[array_search("HALL", $columns)];
        $genre =        $value[array_search("SHOW_GENRE", $columns)];
        $venue =        $value[array_search("VENUE_NAME", $columns)];
        $minprice =     $value[array_search("MIN_PRICE", $columns)];
        $maxprice =     $value[array_search("MAX_PRICE", $columns)];

        $description =  $value[array_search("DESCRIPTION", $columns)];
        $isInfo =       strlen($description) > 0;

        $ageCat =       strlen($value[array_search("AGE_CATEGORY", $columns)])? $value[array_search("AGE_CATEGORY", $columns)]: '0+';
        $act_date_time = $value[array_search("ACTION_DATE", $columns)];

        $year =                     to_afisha_date($act_date_time, "year", "rus");
        $short_date =               to_afisha_date($act_date_time, "short_date", "rus");
        $short_date_with_year =     to_afisha_date($act_date_time, "short_date_with_year", "rus");
        $week_and_time =            to_afisha_date($act_date_time, "week_and_time", "rus");
        $weekday =                  to_afisha_date($act_date_time, "weekday", "rus");
        $time =                     to_afisha_date($act_date_time, "time", "rus");

        $actionsHtml .=

             '<div class="mb-a" data-id="'.$act_id.'">'
            .'<a href="/'.$alias.'"><div class="mb-a-image" style="background-image: url(\''.$poster.'\');"></div></a>'
            .'<a href="/'.$alias.'"><div class="mb-a-title">'.$act_name.'<span class="mb-a-age">'.$ageCat.'</span></div></a>'
            .'<div class="mb-a-date">'.$act_date.' '.$year.', <span class="mb-a-time">'.$act_time.'</span><span class="mb-week">'.$weekday.'</span></div>'

            .'<a class="venue-link" href="/'.$venue_alias.'"><div class="mb-a-venue">'.$venue.'</div></a>'
//            .'<div class="mb-a-buy-holder">'
//            .'<a href="/'.$alias.'"><div class="mb-buy mb-buy32 soft">Купить билет</div></a>' //'.$minprice.' руб.
//            .'</div>'
            .'<div class="mb-a-reviews">Отзывы (<span class="mb-a-reviews-count">3</span>)</div>'
            .'</div>';
    }

    if(strlen($actionsHtml) == 0){
        echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
    }else{
        echo $actionsHtml;
    }
?>
