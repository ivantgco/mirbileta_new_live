<?php
/*
    Template Name: account
*/

    $sid = $_COOKIE["site_sid"];

    $url = $global_prot . "://" . $global_url . "/cgi-bin/b2c?request=<command>get</command><object>customer</object><url>".$global_salesite."</url><sid>".$sid."</sid>";

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

    <script>
        console.log("<?php echo $url; ?>");
    </script>

    <title><?php wp_title( '-', true, 'right' ); ?></title>

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <meta name="viewport" content="width=device-width">


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner"  data-filter="<?php echo $show_type_alias; ?>">

<?php
get_header();
include('main_menu.php');

?>


<div class="site-content account-page">

    <div class="site-container">

        <div class="site-sidebar">



            <?php include 'account_menu.php'; ?>


        </div>

        <div class="mb-site-content">


            <div class="account-header">

                <div class="ac-title"><?php echo get_the_title($page_id);?></div>

                <div class="ac-user">Juri Samoilov</div>
                <div class="ac-exit">Выйти</div>


<!--                --><?php //var_export($data); ?>

            </div>

            <div class="account-body">


                <div class="mirbileta-get-discount-inner"></div>

                <div class="ac-1-title">Отправь друзьям скидку <span class="ac-blue">2%</span> - получи до <span class="ac-blue-bold">11%</span> себе.</div>

                <div class="ac-gd-data-holder">
                    <div class="ac-gd-data-holder-inner">

                        <table class="ac-gd-data">

                            <tbody>

                                <tr>

                                    <td style="vertical-align: middle;">
                                        ВАШ <span class="osbold">КОД MIRBILETA</span>:
                                    </td>
                                    <td>
                                        <div class="mb-code ibl">Bja93Xi00aHS</div>
                                        <div class="ac-gd-distribute ibl">Разослать дурзьям</div>
                                        <div class="ac-gd-copy-code ibl">Скопировать код</div>
                                    </td>

                                </tr>

                                <tr>

                                    <td>
                                        ВАШ ТЕЛЕФОН:
                                    </td>
                                    <td>
                                        <div class="ac-gd-phone ibl">+7 (906) 063-88-66</div>
                                        <div class="ac-gd-info ibl">Внимание: Скидка привязана к Вашему номеру телефона.</div>
                                    </td>

                                </tr>

                                <tr>

                                    <td>
                                        ВАША СКИДКА:

                                        <div class="ac-gd-limit">
                                            Действительна<br/>
                                            до <span class="ac-gd-limit-bold">27.03.2017</span>
                                        </div>

                                        <div class="ac-gd-limit">
                                            Лимит билетов<br/>
                                            со скидкой: <span class="ac-gd-limit-bold">40</span>
                                        </div>

                                        <div class="ac-gd-limit">
                                            Ваш код использовали:<br/>
                                            <span class="ac-gd-limit-bold">4</span> Человека.
                                        </div>

                                    </td>
                                    <td>
                                        <div class="ac-gd-discount ibl">3%</div>
                                        <div class="ac-gd-how-to-increase ibl">Как увеличить?</div>
                                    </td>

                                </tr>

                            </tbody>

                        </table>





                    </div>
                    <div class="ac-gd-buttons-holder">

                        <div class="ac-gd-btn-distribute ibl">
                            <div class="ac-gd-distribute-icons">
                                <i class="ac-gd-icon fa fa-vk"></i>
                                <i class="ac-gd-icon fa fa-facebook"></i>
                                <i class="ac-gd-icon fa fa-odnoklassniki"></i>
                            </div>
                            Разослать скидку друзьям
                        </div>

                        <div class="ac-gd-ask-question sc-gd-ask-question ibl">Задать вопрос</div>

                    </div>
                </div>



                <div class="ac-gd-rules-holder">

                    <h3>Правила:</h3>
                    <p>
                        <span class="ptbold">1.</span> Скидка приминяется к ЛЮБОМУ<br/>
                        электронному билету купленому на сайте<br/>
                        http://mirbileta.ru, за исключением билетов<br/>
                        на мероприятия указанных в специальном<br/>
                        разделе <a href="/exclude_gd_actions/" target="_blank">исключения</a>.
                    </p>

                    <p>
                        <span class="ptbold">2.</span> Для увеличение скидки необходимо<br/>
                        раздать Ваш <span class="ptbold">«КОД MIRBILETA»</span> своим<br/>
                        друзьям, чтобы те использовали его при<br/>
                        оформлении заказов на сайте mirbileta.ru.<br/>
                        <br/>
                        Ваш код дает Вашим друзьям скидку <span class="ptbold">2%</span><br/>
                        на их заказы.
                    </p>

                    <p>
                        <span class="ptbold">3.</span> Ваша скидка растет по следующим<br/> правилам:
                    </p>

                    <table class="gd-table">
                        <thead>
                        <tr>
                            <th>
                                Кол-во человек<br/>
                                использовавших Ваш<br/>
                                «КОД MIRBILETA»
                            </th>
                            <th>
                                Ваша скидка
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>0 - 4</td>
                            <td>0%</td>
                        </tr>

                        <tr>
                            <td>5 - 9</td>
                            <td>3%</td>
                        </tr>

                        <tr>
                            <td>10 - 14</td>
                            <td>5%</td>
                        </tr>

                        <tr>
                            <td>15 - 19</td>
                            <td>7%</td>
                        </tr>

                        <tr>
                            <td>20 <</td>
                            <td>11%</td>
                        </tr>

                        </tbody>
                    </table>

                </div>


            </div>






        </div>

    </div>

</div>




<?php

get_footer();

?>


</body>
</html>
