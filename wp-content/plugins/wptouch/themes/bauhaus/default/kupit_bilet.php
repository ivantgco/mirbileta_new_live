<?php

/*
        Template Name: kupit_bilet
    */


    $a_id = $_GET['action_id'];
    $frame = $_GET['frame'];



?>

<!--http://mirbileta.ru/kupit_bilet/?action_id=5115&frame=goTimKu836fwd00TlWWn-->

<head>
    <meta charset="UTF-8"/>

    <title>Купить билет через mirbileta.ru</title>

    <meta name="description" content="<?php echo $desc; ?>">

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">


    <style type="text/css">
        html,body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: arial, sans-serif;
        }
        .mbw-close{
            display: none!important;
        }
    </style>

</head>

<body>

<div class="modal-widget-holder">
    <div class="modal-widget-inner">


        <div id="multibooker-widget-wrapper"
             data-actions="<?php echo $a_id; ?>"
             data-mirbileta="true"
             data-frame="<?php echo $frame; ?>"
             data-host="https://shop.mirbileta.ru/"
             data-ip="shop.mirbileta.ru">

            <div class="mirbileta-widget-wrapper-wait-text"><i class="fa fa-cog fa-spin"></i>&nbsp;&nbsp;Подождите, загружается модуль продажи билетов...</div>

        </div>

    </div>
</div>

<script type="text/javascript" src="https://shop.mirbileta.ru/assets/widget/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://shop.mirbileta.ru/assets/widget/widget-mobile.js"></script>

</body>
