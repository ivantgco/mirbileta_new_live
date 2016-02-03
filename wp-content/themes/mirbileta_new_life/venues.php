<?php
/*
    Template Name: venues
*/

        $url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_venue</command><url>mirbileta.ru</url>";

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

            $jData = json_decode($data);

        $columns = json_decode($resp)->results["0"]->data_columns;
        $data = json_decode($resp)->results["0"]->data;

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

    <meta charset="UTF-8" />

    <title><?php wp_title( '-', true, 'right' ); ?></title>

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width">


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner">

<?php
    get_header();
    include('main_menu.php');

?>

<div class="site-content">
    <div class="container">

        <div class="mb-inpage-search-wrapper">
            <input type="text" class="mb-inpage-search" placeholder="Поиск по площадкам"/>
        </div>

        <div class="mb-inpage-search-results">
        <?php


        $actionsHtml = "";

        foreach ($data as $key => $value){

            $id =               $value[array_search("VENUE_ID", $columns)];
            $name =             $value[array_search("VENUE_NAME", $columns)];
            $image =            $value[array_search("VENUE_URL_IMAGE_MEDIUM", $columns)];
            $actions_count =    $value[array_search("ACTIONS_COUNT", $columns)];
            $site_url =         $value[array_search("VENUE_SITE_URL", $columns)];
            $desc =             $value[array_search("VENUE_DESCRIPTION", $columns)];

            $actionsHtml .= '<div class="mb-big-tpl-item mb-block mb-inpage-search-entry">'
                            .'<div class="mb-btpl-image" style="background-image: url('.$image.')"></div>'
                            .'<div class="mb-btpl-info">'
                                .'<div class="mb-btpl-title mb-inpage-search-entry-keyword"><a href="/venue/?venue_id='.$id.'">'.$name.'</a></div>'
                                .'<div class="mb-btpl-desc">'.$desc.'</div>'
                                .'<a class="mb-btpl-link" href="/venue/?venue_id='.$id.'">Читать далее</a>'
                            .'</div>'
                            .'<a href="/venue/?venue_id='.$id.'"><div class="mb-btpl-button mb-buy mb-buy32 soft">Мероприятия '.$actions_count.'</div></a>'
                            .'<a href="'.$site_url.'" class="mb-btpl-url " target="_blank">Сайт площадки</a>'
                            .'</div>';
        }

        if(strlen($actionsHtml) == 0){
            echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
        }else{
            echo $actionsHtml;
        }
        ?>
        </div>

    </div>
</div>

<?php

    get_footer();

?>


</body>
