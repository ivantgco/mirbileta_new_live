<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 19.08.16
 * Time: 22:09
 */

//$global_prot = 'https';
//$global_url = 'shop.mirbileta.ru';
//
//$global_salesite = 'mirbileta.ru';


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

echo '<div class="hidden">';
//    var_export($url);
echo '---';
//    var_export($resp);
echo '</div>';

?>


<div class="slider-overflower-height">
<div class="slider-overflower">

    <div class="slider-train" data-max="<?php echo $full_width;?>" data-move="0" style="width: <?php echo $full_width;?>%">


        <?php

        $slidesHtml = "";
        $indexer = 0;

        foreach ($data as $key => $value){

            $act_id =                   $value[array_search("ACTION_ID", $columns)];
            $fee =                      $value[array_search("SERVICE_FEE", $columns)];
            $alias =                    $value[array_search("ACTION_URL_ALIAS", $columns)];
            $action_slider_image =      $value[array_search("ACTION_SLIDER_IMAGE", $columns)];
            $action_name =              $value[array_search("ACTION_NAME", $columns)];
            $venue =                    $value[array_search("VENUE_NAME", $columns)];
            $act_date =                 $value[array_search("ACTION_DATE_STR", $columns)];
            $description =              $value[array_search("DESCRIPTION", $columns)];

            $min =              $value[array_search("MIN_PRICE", $columns)];
            $max =              $value[array_search("MAX_PRICE", $columns)];

            if((int)$fee < 0){

                $min_discounted = (int)$min - ((int)$min / 100 * abs((int)$fee));
                $max_discounted = (int)$max - ((int)$max / 100 * abs((int)$fee));

                $min_html = '<span class="mb-old-price">'.$min.'&nbsp;<i class="fa fa-ruble"></i></span>' . $min_discounted;
                $max_html = '<span class="mb-old-price">'.$max.'&nbsp;<i class="fa fa-ruble"></i></span>' . $max_discounted;

            }else{

                $min_html = $min;
                $max_html = $max;

            }



            $cutted_desc =              mb_substr($description,0,200,'utf-8');


            $slidesHtml .=   '<a href="'.$alias.'"><div class="slider-item-vagon" style="width: '. $single_width .'%" data-slide="'.$indexer.'">'
                                .'<div class="slider-headline">'
                                    .'<div class="slider-headline-name">'.$action_name.'</div>'
                                    .'<div class="slider-headline-date">'.$act_date.'</div>'
                                    .'<div class="slider-headline-venue">'.$venue.'</div>'
                                    .'<div class="slider-item-right"><div class="slider-prices">Билеты от '.$min_html.' до '.$max_html.'&nbsp;&nbsp;<i class="fa fa-ruble"></i></div>'
                                .'</div>'
                                .'<div class="slider-buy-ticket">Купить билет</div></div>'
                                .'<div class="slider-item slider-item-'.$indexer.'" style="background-image: url('.$action_slider_image.')"></div>'
                            .'</div></a>';
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



    </div>

</div>
