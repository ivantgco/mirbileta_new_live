<?php
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
    $single_width = ($action_count > 0 )? 100 / $action_count: 0;
?>

<div class="mmb-slider-holder">
    <div class="mmb-slider-overflow">

        <div class="mmb-slider-train" data-max="<?php echo $full_width;?>" data-move="0" style="width: <?php echo $full_width;?>%">


            <?php

                $slidesHtml = "";
                $indexer = 0;

                foreach ($data as $key => $value){

                    $act_id =                   $value[array_search("ACTION_ID", $columns)];
                    $alias =                    $value[array_search("ACTION_URL_ALIAS", $columns)];
                    $action_slider_image =      (strlen($value[array_search("MOBILE_SLIDER_IMAGE_URL", $columns)]) > 0)? $value[array_search("MOBILE_SLIDER_IMAGE_URL", $columns)] : $value[array_search("ACTION_SLIDER_IMAGE", $columns)];
                    $action_name =              $value[array_search("ACTION_NAME", $columns)];
                    $venue =                    $value[array_search("VENUE_NAME", $columns)];
                    $act_date =                 mmb_get_day($value[array_search("ACTION_DATE_STR", $columns)]);
                    $act_mth =                  mmb_get_mth($value[array_search("ACTION_DATE_STR", $columns)]);
                    $description =              $value[array_search("DESCRIPTION", $columns)];
                    $cutted_desc =              mb_substr($description,0,200,'utf-8');


                    $slidesHtml .= '<div class="mmb-slider-vagon" style="width: '. $single_width .'%" data-slide="'.$indexer.'">'
                        .'<div class="slider-item slider-item-'.$indexer.'" style="background-image: url('.$action_slider_image.')"></div>'
                        .'<div class="container slider-item-info" >'
                        .'<div class="mmb-slider-date">'.$act_date.'<div class="mmb-slider-mth">'.$act_mth.'</div></div>'
                        .'<div class="mmb-slider-venue">'.$venue.'</div>'
                        .'<div class="mmb-slider-title">'.$action_name.'</div>'
                        .'<div class="sa-buy-wrapper">'
                            .'<a class="nounderline" href="/'.$alias.'"><div class="mb-buy mb-buy32 yellow">Купить билет</div></a>'
                        .'</div>'

                        .'</div>'
                        .'</div>';
                    $indexer ++;
                }

                echo $slidesHtml;

            ?>

            <div class="mmb-slider-vagon">

            </div>

        </div>
        <div class="mmb-slider-underline"></div>
    </div>
</div>