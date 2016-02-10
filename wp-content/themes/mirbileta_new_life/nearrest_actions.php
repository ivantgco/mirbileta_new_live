<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:28
 */

    require('./vendor/fightbulc/moment/src/MomentLocale.php');
    require('./vendor/fightbulc/moment/src/Moment.php');

    $m = new \Moment\Moment(); // default is "now" UTC
    echo $m->format();

    $url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_actions</command><url>mirbileta.ru</url><form_date></form_date><to_date></form_date>";

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





?>

<div class="page-headline-wrapper">
    <div class="p-h-line"></div>
    <div class="p-h-title"><span>Ближайшие мероприятия:</span></div>
    <?php

    echo $today;
    ?>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="mb-block">
            <div class="mb-nrs-wrapper">
                <div class="mb-nrs-header">Сегодня:</div>
                <div class="mb-nrs-body" data-date="today">
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-3.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-4.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-1.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-block">
            <div class="mb-nrs-wrapper">
                <div class="mb-nrs-header">Завтра:</div>
                <div class="mb-nrs-body" data-date="tomorrow">
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-4.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-3.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-block">
            <div class="mb-nrs-wrapper">
                <div class="mb-nrs-header">На выходных:</div>
                <div class="mb-nrs-body" data-date="weekend">
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-1.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-2.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-5.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-block">
            <div class="mb-nrs-wrapper">
                <div class="mb-nrs-header">Следующая неделя:</div>
                <div class="mb-nrs-body" data-date="nextweek">
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-5.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-2.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                    <a href="">
                        <div class="mb-sm-action" data-id="">
                            <div class="mb-sm-a-image" style="background-image: url(/wp-content/themes/mirbileta_new_life/assets/img/act-3.jpg);"></div>
                            <div class="mb-sm-a-title">Спектакль «Снегурочка»</div>
                            <div class="mb-sm-a-venue">Государственный Кремлевский Дворец</div>
                            <div class="mb-sm-a-price">от 1600 руб.</div>
                            <div class="mb-sm-a-age">14+</div>
                            <div class="mb-sm-a-date">22 апреля, <span class="mb-a-time">19:00</span></div>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>