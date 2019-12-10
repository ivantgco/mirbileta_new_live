<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:10
 */


$href_h = request_url();
$arr_h = parse_url($href_h);
$query_h = $arr_h['query'];



?>

<div style="display: none"><?php echo $query_h; ?></div>

<script type="text/javascript">


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

    if(getCookie('mb_utm') == undefined){
        setCookie('mb_utm', '<?php echo $query_h; ?>', {path: '/'});
    }


</script>


<div class="container posRel">
    <div class="contest-fast-timer"></div>
</div>


<div class="contest-holder">
    <div class="contest-fast-fader"></div>

    <div class="contest-fast-close fa fa-times"></div>

    <div class="contest-fast-wrapper">
        <h1>Кто быстрее?!</h1>

        <h3>
            Вы за билетами? Поучаствуйте в конкурсе!<br/><br/>
            Оформите заказ на ЛЮБОЕ мероприятие быстрее всех и получите 2 билета на концерт<br/> <span class="ptbold">"Баста с симфоническим оркестром" в подарок!</span>
        </h3>

        <div class="contest-fast-open-rules">Простые правила</div>
        <div class="contest-fast-go">Go!</div>
        <div class="contest-fast-reject">Нет, спасибо</div>
    </div>

    <div class="contest-fast-rules">
        <div class="container posRel">
            <h1>Простые правила</h1>

            <b>Задача:</b>
            Максимально быстро оформить заказ на ЛЮБОЕ мероприятие и оплатить Электронные билеты на сайте www.mirbileta.ru в течение
            периода проведения Акции.<br/>
            Участник, потративший минимум времени, признается победителем.<br/><br/>
            <b>Сроки проведения:</b> с 10.03.2016 12:00 по 14.04.2016 15:59<br/><br/>
            <b>Приз победителю:</b> 2 билета на концерт "Баста с симфоническим оркестром" 18.04.2016<br/><br/>

            Полная информация об организаторе Акции, количестве призов, сроках, месте и порядке их получения доступна в
            <a href="/contest-fast-rules.pdf" target="_blank">Правилах проведения Акции.</a>



            <div class="contest-fast-reject">Нет, спасибо</div>

            <div class="contest-fast-go">Go!</div>

            <!--            <div class="contest-fast-runner"></div>-->

        </div>

    </div>
</div>

<div class="header site-header">
    <div id="filters_data"></div>
    <div class="container posRel">

        <a href="/">
            <div class="logo-wrapper">
                <div class="mb-logo-title">MIRBILETA.RU</div>
                <div class="mb-logo-subtitle">Электронные&nbsp;билеты</div>
                <!--                <img src="/wp-content/themes/mirbileta_new_life/assets/img/logo.png" />-->
            </div>
        </a>

        <div class="search-wrapper">
            <input type="text" class="main-input main-search" placeholder="ПОИСК"/>

            <div class="main-search-input-clear"></div>
            <div class="main-search-dd">
                <div class="main-search-dd-arrow"></div>
                <div class="ms-actions-wrapper mb-medium-actions"></div>
                <div class="ms-venues-wrapper-holder">
                    <div class="ms-subblock-header">Площадки:</div>
                    <div class="ms-venues-wrapper chromeScroll">

                    </div>
                </div>
                <div class="ms-actors-wrapper-holder">
                    <div class="ms-subblock-header">Актеры:</div>
                    <div class="ms-actors-wrapper chromeScroll">

                    </div>
                </div>
                <div class="ms-settings-wrapper">

                    <div class="mb-tf-header">
                        <div class="mb-tf-title">Цена билета:</div>
                    </div>
                    <div class="mb-tf-body">
                        <div class="mb-ms-rangeslider"></div>
                        <div class="mb-tf-rangeslider-inputs">
                            <input class="mb-tf-rs-input mb-tf-rs-from" disabled type="text" placeholder="" value=""/>
                            &mdash;
                            <input class="mb-tf-rs-input mb-tf-rs-to" disabled type="text" placeholder="" value=""/>
                        </div>
                    </div>

                    <div class="mb-tf-header">
                        <div class="mb-tf-title">Диапазон дат:</div>
                    </div>
                    <div class="mb-tf-body">
                        <div class="taCenter">
                            <input class="mb-tf-rs-input mb-tf-ms-from-date" type="text" placeholder=""/>
                            &mdash;
                            <input class="mb-tf-rs-input mb-tf-ms-to-date" type="text" placeholder=""/>
                        </div>
                    </div>

                    <div class="mb-border-btn main-search-clear"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Сбросить</div>
                    <div class="mb-border-btn main-search-close"><i class="fa fa-times"></i>Закрыть</div>

                </div>
            </div>
        </div>
        <div class="search-datarange-wrapper">
            <input type="text" class="main-input main-search-daterange" placeholder="ДАТА"/>

            <div class="main-search-daterange-icon"></div>
            <div class="main-search-daterange-clear"></div>
        </div>


        <div class="top-menu-wrapper">

            <?php
            $args = array(
                'menu' => 'top_header_menu', // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                'container' => 'ul', // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                'container_class' => '', // (string) class контейнера (div тега)
                'container_id' => '', // (string) id контейнера (div тега)
                'menu_class' => '', // (string) class самого меню (ul тега)
                'menu_id' => '', // (string) id самого меню (ul тега)
                'echo' => true, // (boolean) Выводить на экран или возвращать для обработки
                'fallback_cb' => 'wp_page_menu', // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                'before' => '', // (string) Текст перед <a> каждой ссылки
                'after' => '', // (string) Текст после </a> каждой ссылки
                'link_before' => '', // (string) Текст перед анкором (текстом) ссылки
                'link_after' => '', // (string) Текст после анкора (текста) ссылки
                'depth' => 0, // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                'walker' => '', // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
                'theme_location' => '' // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
            );

            wp_nav_menu($args)

            ?>
        </div>
        <div class="contacts-wrapper">
            <div class="contacts-phone">+7 (495) 005-<span>30</span>-23</div>
            <div class="contacts-email">info@mirbileta.ru</div>
        </div>

    </div>

</div>