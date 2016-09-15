<?php
/*
    Template Name: show
*/


    $href = request_url();
    $arr = parse_url($href);
    $show_alias = preg_replace('/^\//','',$arr['path']);
    $show_alias = preg_replace('/(^\w+)\/.*/','$1',$show_alias);

    $url = $global_prot . "://" . $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><show_url_alias>".$show_alias."</show_url_alias>";

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

    $columns = json_decode($resp)->results["0"]->data_columns;
    $data = json_decode($resp)->results["0"]->data;

    $act_id =       $data[0][array_search("ACTION_ID", $columns)];
    $alias =        $data[0][array_search("ACTION_URL_ALIAS", $columns)];

    $act_name =     $data[0][array_search("ACTION_NAME", $columns)];
    $g_act_name =     $data[0][array_search("ACTION_NAME", $columns)];
    $thumb =        (strlen($data[0][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] )> 0) ? (strpos("http", $data[0][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://'. $global_url . '/upload/' . $data[0][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[0][array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : '';
    $poster =       (strlen($data[0][array_search("ACTION_POSTER_IMAGE", $columns)] )> 0) ? (strpos("http", $data[0][array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?               $global_prot . '://'. $global_url . '/upload/' . $data[0][array_search("ACTION_POSTER_IMAGE", $columns)] : $data[0][array_search("ACTION_POSTER_IMAGE", $columns)]: '';
    $hall =         $data[0][array_search("HALL_NAME", $columns)];
    $genre =        $data[0][array_search("SHOW_GENRE", $columns)];
    $venue =        $data[0][array_search("VENUE_NAME", $columns)];
    $address =      $data[0][array_search("HALL_ADDR", $columns)];
    $g_address =    $data[0][array_search("HALL_GOOGLE_ADDRESS", $columns)];
    $tag_list =     $data[0][array_search("ACTION_TAG_LIST", $columns)];
    $actor_list =     $data[0][array_search("ACTION_ACTOR_LIST", $columns)];

    $isInfo = strlen($description) > 0;
    $description = $data[0][array_search("DESCRIPTION", $columns)];
    $ageCat = strlen($data[0][array_search("AGE_CATEGORY", $columns)]) ? $data[0][array_search("AGE_CATEGORY", $columns)] : '0+';





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

    <?php include 'viewport.php';?>


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner">
<div class="page-holder action-page">
<?php
    get_header();
?>



<div class="mmb-one-action-wrapper">

    <div class="mmb-oa-image" style="background-image: url(<?php echo $poster;?>)"></div>

    <div class="mmb-show-info">

        <?php

        if($act_id == 3382){
        echo '<div class="mmb-oa-title">ВНИМАНИЕ! Замена: <span style="text-decoration: line-through;">'. $act_name .'</span> Три товарища</div> <a href="http://sovremennik.ru/news/sezon_2015_2016/may_2016/4_maya_2016_goda_viesto_spektaklya_anarkhiya_sostoitsya_spektakl_tri_tovarishcha/" target="_blank" style="color: red;">Подробнее</a>';
        }else{
        echo '<div class="mmb-oa-title">'. $act_name .'</div>';
        }

        ?>

<!--        <div class="mmb-oa-title">--><?php //echo $act_name;?><!--</div>-->
        <div class="mmb-oa-venue"><?php echo $hall;?></div>




    </div>
    <div class="mmb-show-dates-wrapper">
        <div class="mmb-show-dates-title"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;Выберите дату:</div>

        <div class="mmb-show-dates-overflow">
            <div class="mmb-show-dates-train" style="width: <?php echo (count($data) * 90) . 'px' ?>">

                <?php

                $dates_html = '';

                foreach($data as $key => $value){

                    $a_date =     mmb_get_day($value[array_search("ACTION_DATE_STR", $columns)]);
                    $a_mth =      mmb_get_mth($value[array_search("ACTION_DATE_STR", $columns)]);
                    $a_time =     $value[array_search("ACTION_TIME_STR", $columns)];
                    $a_alias =    $value[array_search("ACTION_URL_ALIAS", $columns)];


                    $dates_html .= '<a class="mmb-show-dates-item-link" href="/'.$a_alias.'"><div class="mmb-show-dates-vagon">'
                        .'<div class="mmb-show-date">'.$a_date.'<span class="mmb-show-mth">'.$a_mth.'</span></div>'
                        .'<div class="mmb-show-time">'.$a_time.'</div>'
                        .'</div></a>';

                }

                echo $dates_html;

                ?>


            </div>
        </div>

    </div>



    <div class="mmb-oa-content-wrapper">

        <div class="tabsParent mmb-tabsParent sc_tabulatorParent">
            <div class="tabsTogglersRow sc_tabulatorToggleRow">

                <div class="tabToggle sc_tabulatorToggler opened" dataitem="0" title="">
                    <span class="">Описание</span>
                </div>

                <div class="tabToggle sc_tabulatorToggler " dataitem="1" title="">
                    <span class="">Место</span>
                </div>

                <div class="tabToggle sc_tabulatorToggler " dataitem="2" title="">
                    <span class="">Исполнители</span>
                </div>

            </div>

            <div class="ddRow notZindexed sc_tabulatorDDRow">

                <div class="tabulatorDDItem sc_tabulatorDDItem  noMaxHeight chromeScroll opened" dataitem="0">

                    <?php echo $description;?>

                </div>

                <div class="tabulatorDDItem sc_tabulatorDDItem  noMaxHeight" dataitem="1">

                    <div class="mmb-oa-venue-wrapper">
                        <div class="mmb-oa-venue-title"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo $hall; ?></div>

                        <?php if(strlen($address) > 0): ?>

                            <div class="mmb-oa-venue-address"><i class="fa fa-map-o"></i>&nbsp;&nbsp;<?php echo $address; ?></div>

                            <div class="one-action-gmap">

                                <input id="address" type="hidden" value="<?php echo $g_address; ?>" />

                                <div style=" width: 100%; height: 280px;" id="map_canvas"></div>

                            </div>

                        <?php endif; ?>

                    </div>



                </div>


                <div class="tabulatorDDItem sc_tabulatorDDItem noPaddingSides noMaxHeight" dataitem="2">

                    <div class="one-action-actors">
<!--                        <div class="one-action-actors-header">Действующе лица:</div>-->

                        <ul>

                            <?php

                            // Подгружаем актеров

                            $actorsArray = json_decode($actor_list);
                            $actors_html = "";

                            if(count($actorsArray) > 0){
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
                            }



                            ?>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>


</div>

<?php
    include('custom_footer.php');
?>

</div>

<?php if($free_places > 0):?>
    <script type="text/javascript" src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/widget.js"></script>
<!--    <script type="text/javascript" src="http://mb-dev.mirbileta.ru/assets/widget/widget.js"></script>-->
<?php endif; ?>



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

</body>


<!--END-->

