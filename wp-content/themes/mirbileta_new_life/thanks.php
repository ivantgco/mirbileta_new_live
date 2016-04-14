<?php
/*
    Template Name: thanks
*/


    $order_id =         $_POST['cf'];   // номер нашего заказа
    $ext_order_id =     $_POST['cf2'];  // внешний номер заказа
    $frame =            $_POST['cf3'];  // Фрейм
    $payment_id =       $_POST['paymentcode'];  // id платежа
    $email = $_POST['email'];

    $isRealOrder = ($order_id || $ext_order_id)? 'real' : 'fake';

//host + 'cgi-bin/b2e?request=' + query
//<query><command>get_external_order_id</command><order_id>'+orderId+'</order_id><cf3>'+frame+'</cf3><payment_id>'+payment_id+'</payment_id></query>

//в ответ полчу время (TOTAL_TIME) в милисекундах;


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

    <meta name="viewport" content="width=device-width">


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>

    <?php wp_head(); ?>



</head>

<body <?php body_class(); ?> data-page="inner" >

<?php
get_header();
include('main_menu.php');

?>

<div class="site-content thanks-page">

    <div class="container posRel">

        <div class="thx-content">

            <div class="thx-thx">Спасибо!</div>
            <div class="thx-order">
                Ваш заказ № <span class="order_id"><?php echo $order_id; ?></span> успешно оплачен, билеты<br>
                отправлены вам на почту. <span class="thx-email">(<?php echo $email;?>)</span>
            </div>
            <div class="thx-contacts">
                По всем вопросам обращайтесь:<br>
                <br>
                +7 (499) 391-61-97<br>
                info@mirbileta.ru
            </div>

<!--            <div class="contest-fast-result-holder">-->
<!--                <div class="contest-fast-congrats">-->
<!--                    Поздравляем!-->
<!--                </div>-->
<!--                <div class="contest-fast-result-wrapper">-->
<!--                    <div class="contest-fast-result-text">Ваш результат:</div>-->
<!--                    <div class="contest-fast-result"></div>-->
<!--                </div>-->
<!---->
<!--                <div class="contest-fast-timer-rate"><div class="contest-fast-go">Улучшить результат!</div></div>-->
<!--                <div class="contest-fast-timer-img"></div>-->
<!--                <a target="_blank" href="/contest-fast"><div class="contest-fast-watch-results">-->
<!--                    Смотреть все результаты-->
<!--                </div></a>-->
<!---->
<!--            </div>-->

        </div>
        <div class="thx-footer">
            <div class="thx-footer-text">
                Приятного просмотра!
            </div>
        </div>

    </div>
</div>

<?php if(strlen($order_id) > 0): ?>

    <input type="hidden" id="ORDER_ID" value="<?php echo $order_id; ?>"/>
    <input type="hidden" id="FRAME" value="<?php echo $frame; ?>"/>
    <input type="hidden" id="PAYMENT_ID" value="<?php echo $payment_id; ?>"/>

<script type="text/javascript">
    $(document).ready(function(){

            if(!!localStorage){

                var isFinished = localStorage.getItem('mb-fast-contest-finished');
                var contestData = localStorage.getItem('mb-fast-contest');

                if(contestData != null){

                    socketQuery_b2e({

                        command:   'get_external_order_id',
                        order_id:   $('#ORDER_ID').val(),
                        cf3:        $('#FRAME').val(),
                        payment_id: $('#PAYMENT_ID').val()

                    }, function(res){

                        var jRes = JSON.parse(res).results[0];
                        if(jRes.code == 0){

                            var totalDelta = jRes['TOTAL_TIME'];

                            var s2 = moment(totalDelta).format('mm:ss:SS');

                            $('.contest-fast-result-holder').show(0);

                            var timeCase;
                            var text;
                            var image;

                            if(totalDelta <= 80000){
                                timeCase = 'veryfast';
                            }else if(totalDelta > 80000 && totalDelta <= 120000){
                                timeCase = 'fast';
                            }else if(totalDelta > 120000 && totalDelta <= 180000){
                                timeCase = 'good';
                            }else if(totalDelta > 180000 && totalDelta <= 300000){
                                timeCase = 'slow';
                            }else if(totalDelta > 300000 && totalDelta <= 600000){
                                timeCase = 'veryslow';
                            }else{
                                timeCase = 'veryslow';
                            }


                            switch (timeCase){
                                case 'veryfast':
                                    text = 'Ого, вот это скорость!';
                                    image = 'veryfast';
                                    break;

                                case 'fast':
                                    text = 'Отлично!';
                                    image = 'fast';
                                    break;

                                case 'good':
                                    text = 'Хорошо!';
                                    image = 'good';
                                    break;

                                case 'slow':
                                    text = 'Неспешно...';
                                    image = 'slow';
                                    break;

                                case 'veryslow':
                                    text = 'Это было медленно =)';
                                    image = 'veryslow';
                                    break;

                                default :
                                    text = 'Это было медленно =)';
                                    image = 'veryslow';
                                    break;
                            }

                            $('.contest-fast-timer-img').addClass(image);
                            $('.contest-fast-timer-rate').html(text);
                            $('.contest-fast-result').html(s2);


                            localStorage.removeItem('mb-fast-contest');
                            localStorage.setItem('mb-fast-contest-finished', 'TRUE');
                            localStorage.setItem('mb-fast-contest-finished-result', totalDelta);

                        }else{
                            $('.contest-fast-result-holder').hide(0);

//                            toastr['error']('Ошибка сервера');
                        }
                        console.log("RES", res);

                    });

                }else if(isFinished != null && isFinished == 'TRUE'){


                    var totalDelta = +localStorage.getItem('mb-fast-contest-finished-result');

                    var s2 = moment(totalDelta).format('mm:ss:SS');

                    $('.contest-fast-result-holder').show(0);

                    var timeCase;
                    var text;
                    var image;

                    if(totalDelta <= 80000){
                        timeCase = 'veryfast';
                    }else if(totalDelta > 80000 && totalDelta <= 120000){
                        timeCase = 'fast';
                    }else if(totalDelta > 120000 && totalDelta <= 180000){
                        timeCase = 'good';
                    }else if(totalDelta > 180000 && totalDelta <= 300000){
                        timeCase = 'slow';
                    }else if(totalDelta > 300000 && totalDelta <= 600000){
                        timeCase = 'veryslow';
                    }else{
                        timeCase = 'veryslow';
                    }


                    switch (timeCase){
                        case 'veryfast':
                            text = 'Ого, вот это скорость!';
                            image = 'veryfast';
                            break;

                        case 'fast':
                            text = 'Отлично!';
                            image = 'fast';
                            break;

                        case 'good':
                            text = 'Хорошо!';
                            image = 'good';
                            break;

                        case 'slow':
                            text = 'Неспешно...';
                            image = 'slow';
                            break;

                        case 'veryslow':
                            text = 'Это было медленно =)';
                            image = 'veryslow';
                            break;

                        default :
                            text = 'Это было медленно =)';
                            image = 'veryslow';
                            break;
                    }

                    $('.contest-fast-timer-img').remove();
                    $('.contest-fast-timer-rate').find('.contest-fast-go').show(0);
                    $('.contest-fast-result').html(s2);

                }else{
                    $('.contest-fast-result-holder').hide(0);
                }

                if(localStorage.getItem('mb-fast-reject') != null){
                    if(localStorage.getItem('mb-fast-reject') == 'REJECT'){
                        $('.contest-fast-result-holder').hide(0);
                    }
                }
            }



            $('.contest-fast-timer').remove();

    });
</script>

<?php endif ?>

<?php

get_footer();

?>


<script type="text/javascript">
    window.onload = function() {


        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        function setCookie(name, value, options) {
            options = options || {};

            var expires = options.expires;

            if (typeof expires == "number" && expires) {
                var d = new Date();
                d.setTime(d.getTime() + expires * 1000);
                expires = options.expires = d;
            }
            if (expires && expires.toUTCString) {
                options.expires = expires.toUTCString();
            }

            value = encodeURIComponent(value);

            var updatedCookie = name + "=" + value;

            for (var propName in options) {
                updatedCookie += "; " + propName;
                var propValue = options[propName];
                if (propValue !== true) {
                    updatedCookie += "=" + propValue;
                }
            }

            document.cookie = updatedCookie;
        }

        var isRealOrder = ('<?php echo $isRealOrder;?>' == 'real');

        if(!getCookie('mb_reach_success') && isRealOrder){

            yaCounter32940504.reachGoal('SUCCESS');

            setCookie('mb_reach_success', true);
        }
    }

</script>

</body>
