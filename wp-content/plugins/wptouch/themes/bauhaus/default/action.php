<?php
/*
    Template Name: single_action
*/

//$action_alias = $_GET['alias'];

    $href = request_url();
    $arr = parse_url($href);
    $action_alias = preg_replace('/^\//','',$arr['path']);
    $action_alias = preg_replace('/(^\w+)\/.*/','$1',$action_alias);

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
    $frame =        $data[array_search("FRAME", $columns)];

    $widget_act_id = $act_id;
    $widget_frame = $frame;

    $alias =        $data[array_search("ACTION_URL_ALIAS", $columns)];
    $act_name =     $data[array_search("ACTION_NAME", $columns)];
    $g_act_name =     $data[array_search("ACTION_NAME", $columns)];
    $thumb =        (strlen($data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) > 0) ? (strpos("http", $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)]) == -1) ?      $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_THUMBNAIL_IMAGE", $columns)] : $defaultPoster;
    $poster =       (strlen($data[array_search("ACTION_POSTER_IMAGE", $columns)])> 0) ? (strpos("http", $data[array_search("ACTION_POSTER_IMAGE", $columns)]) == -1) ?                          $global_prot . '://'. $global_url . '/upload/' . $data[array_search("ACTION_POSTER_IMAGE", $columns)] : $data[array_search("ACTION_POSTER_IMAGE", $columns)]: $defaultPoster;

    $act_date_time = $data[array_search("ACTION_DATE_TIME", $columns)];

    $act_date =     mmb_get_day($data[array_search("ACTION_DATE_STR", $columns)]);
    $act_mth =      mmb_get_mth($data[array_search("ACTION_DATE_STR", $columns)]);
    $act_time =     $data[array_search("ACTION_TIME_STR", $columns)];



    $hall =         $data[array_search("HALL_NAME", $columns)];
    $genre =        $data[array_search("SHOW_GENRE", $columns)];
    $venue =        $data[array_search("VENUE_NAME", $columns)];
    $address =      $data[array_search("HALL_ADDR", $columns)];
    $g_address =    $data[array_search("HALL_GOOGLE_ADDRESS", $columns)];
    $free_places =  $data[array_search("FREE_PLACE_COUNT", $columns)];
    $minprice =     $data[array_search("MIN_PRICE", $columns)];
    $maxprice =     $data[array_search("MAX_PRICE", $columns)];
    $day_of_week =  $data[array_search("ACTION_DAY_OF_WEEK", $columns)];
    $duration =     $data[array_search("DURATION_HOUR_MIN", $columns)];
    $is_wo =        $data[array_search("ACTION_TYPE", $columns)] == 'ACTION_WO_PLACES';
    $sbag =         $data[array_search("SPLIT_BY_AREA_GROUP", $columns)] == 'TRUE';
    $tag_list =     $data[array_search("ACTION_TAG_LIST", $columns)];
    $actor_list =   $data[array_search("ACTION_ACTOR_LIST", $columns)];

    $isInfo = strlen($description) > 0;
    $description = $data[array_search("DESCRIPTION", $columns)];

    $ageCat = strlen($data[array_search("AGE_CATEGORY", $columns)]) ? $data[array_search("AGE_CATEGORY", $columns)] : '0+';


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
    <?php include 'seo.php'; ?>

<!--    <title>--><?php //wp_title('-', true, 'right'); ?><!--</title>-->

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

<!--    <h1>ВНИМАНИЕ, мы все сломали, скоро починим! извините =)</h1>-->

    <div class="mmb-oa-info">
        <div class="mmb-oa-date-wrapper">
            <div class="mmb-oa-date"><?php echo $act_date;?></div>
            <div class="mmb-oa-mth"><?php echo $act_mth;?></div>
            <div class="mmb-oa-time"><?php echo $act_time;?></div>
        </div>
        <div class="mmb-oa-title-wrapper">

            <?php

                if($act_id == 3382){
                    echo '<div class="mmb-oa-title">ВНИМАНИЕ! Замена: <span style="text-decoration: line-through;">'. $act_name .'</span> Три товарища</div> <a href="http://sovremennik.ru/news/sezon_2015_2016/may_2016/4_maya_2016_goda_viesto_spektaklya_anarkhiya_sostoitsya_spektakl_tri_tovarishcha/" target="_blank" style="color: red;">Подробнее</a>';
                }else{

                    echo '<div class="mmb-oa-title">'. $act_name .'</div>';

                }



            ?>


<!--            <div class="mmb-oa-title">--><?php //echo $act_name;?><!--</div>-->
            <div class="mmb-oa-venue"><?php echo $hall;?></div>
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

                <div class="tabToggle sc_tabulatorToggler mmb-buy-ticket-tab" dataitem="2" title="" data-id="<?php echo $widget_act_id;?>" data-frame="<?php echo $widget_frame;?>">
                    <span class="">Купить билет</span>
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


                <div class="tabulatorDDItem sc_tabulatorDDItem sc_widget_tab noPaddingSides noMaxHeight" dataitem="2">



                </div>

            </div>

        </div>

    </div>

<!--    <div class="one-action-widget-wrapper mmb-widget-holder">-->
<!--        <div class="one-action-widget-wrapper-inner">-->
<!---->
<!---->
<!---->
<!--            <div id="multibooker-widget-wrapper"-->
<!--                 data-action_id="--><?php //echo $act_id ?><!--"-->
<!--                 data-frame="--><?php //echo $frame ?><!--"-->
<!--                 data-host=--><?php //echo $global_prot ."://". $global_url.'/'; ?>
<!--                 data-ip="--><?php //echo $global_url; ?><!--">-->
<!--            </div>-->
<!---->
<!--            <div class="one-action-widget-underwrapper zi20 posRel"></div>-->
<!---->
<!--        </div>-->
<!--    </div>-->


</div>

<?php
    include('custom_footer.php');
?>

</div>

<?php //if($free_places > 0):?>
    <script type="text/javascript" id="mbw-script-loader" data-src="<?php echo $global_prot .'://'. $global_url?>/assets/widget/widget-mobile.js" src=""></script>
<!--    <script type="text/javascript" src="http://mb-dev.mirbileta.ru/assets/widget/widget.js"></script>-->
<?php //endif; ?>



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

