<?php
/**
 * Created by PhpStorm.
 * User: aig
 * Date: 20.08.2016
 * Time: 14:44
 */

    $sb_actors_url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actor</command><url>".$global_salesite."</url><page_no>1</page_no><rows_max_num>3</rows_max_num>";

    $sb_actors_ch = curl_init();

    curl_setopt($sb_actors_ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($sb_actors_ch, CURLOPT_URL, $sb_actors_url);
    curl_setopt($sb_actors_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($sb_actors_ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($sb_actors_ch, CURLOPT_SSL_VERIFYHOST, 0);

    $sb_actors_resp = curl_exec($sb_actors_ch);

    if(curl_errno($sb_actors_ch))
        print curl_error($sb_actors_ch);
    else
        curl_close($sb_actors_ch);



    $sb_actors_columns = json_decode($sb_actors_resp)->results["0"]->data_columns;
    $sb_actors_data = json_decode($sb_actors_resp)->results["0"]->data;

?>

    <div class="mb-sb-headline">Актеры и музыканты:</div>

<?php


    $sb_actors_actionsHtml = "";
    $sb_actors_c = 0;

    foreach ($sb_actors_data as $key => $value){

        if($sb_actors_c == 4){
            break;
        }
        $id =               $value[array_search("ACTOR_ID", $sb_actors_columns)];
        $name =             $value[array_search("ACTOR_NAME", $sb_actors_columns)];
        $alias =             $value[array_search("ACTOR_URL_ALIAS", $sb_actors_columns)];
        $image =            $value[array_search("URL_IMAGE_MEDIUM", $sb_actors_columns)];
        $actions_count =    $value[array_search("ACTION_COUNT", $sb_actors_columns)];

        $sb_actors_actionsHtml .= '<a href="/'.$alias.'"><div class="mb-sb-item mb-block mb-inpage-search-entry">'
                        .'<div class="mb-sb-image" style="background-image: url('.$image.')"></div>'
                        .'<div class="mb-sb-info">'
                            .'<div class="mb-sb-title mb-inpage-search-entry-keyword">'.$name.'</div>'
//                        .'<div class="mb-sb-desc">'.$desc.'</div>'
//                        .$readmore
                            .'<div class="mb-sb-actions-count">Мероприятия '.$actions_count.'</div>'
                        .'</div>'
//                        .$site_url_html
                        .'</div></a>';

        $sb_actors_c++;
    }

    if(strlen($sb_actors_actionsHtml) == 0){
        echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
    }else{
        echo $sb_actors_actionsHtml;
    }
?>

    <a class="mb-sb-link-all" href="/actors/">Все актеры и музыканты</a>

<script type="text/javascript" charset="utf-8" src="http://animate.adobe.com/runtime/6.0.0/edge.6.0.0.min.js"></script>
<style>
    .edgeLoad-EDGE-106327254 { visibility:hidden; }
</style>
<script>
    AdobeEdge.loadComposition('240x400', 'EDGE-106327254', {
        scaleToFit: "none",
        centerStage: "none",
        minW: "0px",
        maxW: "undefined",
        width: "240px",
        height: "400px"
    }, {"dom":{}}, {"dom":{}});
</script>

<div id="Stage" class="EDGE-106327254">
</div>