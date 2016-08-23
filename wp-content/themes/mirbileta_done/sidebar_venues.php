<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 20.08.2016
 * Time: 14:44
 */

    $sb_venues_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_venue</command><url>".$global_salesite."</url><page_no>1</page_no><rows_max_num>3</rows_max_num>";

    $sb_venues_ch = curl_init();

    curl_setopt($sb_venues_ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($sb_venues_ch, CURLOPT_URL, $sb_venues_url);
    curl_setopt($sb_venues_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($sb_venues_ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($sb_venues_ch, CURLOPT_SSL_VERIFYHOST, 0);

    $sb_venues_resp = curl_exec($sb_venues_ch);

    if(curl_errno($sb_venues_ch))
        print curl_error($sb_venues_ch);
    else
        curl_close($sb_venues_ch);



    $sb_venues_columns = json_decode($sb_venues_resp)->results["0"]->data_columns;
    $sb_venues_data = json_decode($sb_venues_resp)->results["0"]->data;

?>

    <div class="mb-sb-headline">Площадки:</div>

<?php


    $sb_venues_actionsHtml = "";
    $sb_venues_c1 = 0;

    foreach ($sb_venues_data as $key => $value){

        if($sb_venues_c1 == 4){
            break;
        }

        $id =               $value[array_search("VENUE_ID", $sb_venues_columns)];
        $name =             $value[array_search("VENUE_NAME", $sb_venues_columns)];
        $alias =             $value[array_search("VENUE_URL_ALIAS", $sb_venues_columns)];
        $image =            (strlen($value[array_search("VENUE_URL_IMAGE_MEDIUM", $sb_venues_columns)]) > 0)? $value[array_search("VENUE_URL_IMAGE_MEDIUM", $sb_venues_columns)] : $defaultPoster;
        $actions_count =    $value[array_search("ACTIONS_COUNT", $sb_venues_columns)];
        $site_url =         $value[array_search("VENUE_SITE_URL", $sb_venues_columns)];
        $site_url_html =    ($site_url)? '<a href="'.$site_url.'" class="mb-btpl-url " target="_blank">Сайт площадки</a>' : '';
        $desc =             $value[array_search("VENUE_DESCRIPTION", $sb_venues_columns)];
        $readmore =         ($desc)? '<a class="mb-btpl-link" href="/'.$alias.'">Читать далее</a>' : '';

        $sb_venues_actionsHtml .= '<a href="/'.$alias.'"><div class="mb-sb-item mb-block mb-inpage-search-entry">'
                        .'<div class="mb-sb-image" style="background-image: url('.$image.')"></div>'
                        .'<div class="mb-sb-info">'
                            .'<div class="mb-sb-title mb-inpage-search-entry-keyword">'.$name.'</div>'
//                        .'<div class="mb-sb-desc">'.$desc.'</div>'
//                        .$readmore
                            .'<div class="mb-sb-actions-count">Мероприятия '.$actions_count.'</div>'
                        .'</div>'
//                        .$site_url_html
                        .'</div></a>';
        $sb_venues_c1++;
    }

    if(strlen($sb_venues_actionsHtml) == 0){
        echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
    }else{
        echo $sb_venues_actionsHtml;
    }
?>

    <a class="mb-sb-link-all" href="/venues/">Все площадки</a>