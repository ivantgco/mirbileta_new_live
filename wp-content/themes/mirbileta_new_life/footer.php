<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:30
 */
?>

<div class="site-footer">
    <div class="footer-line-1">
        <div class="container">

            <a href="/"><div class="logo-wrapper">
                    <div class="mb-logo-title">MIRBILETA.RU</div>
<!--                    <img src="/wp-content/themes/mirbileta_new_life/assets/img/logo_footer.png" />-->
                </div></a>

            <div class="contacts-wrapper">
                <div class="contacts-phone">+7 (495) 005-<span>30</span>-23</div>
                <div class="contacts-email">info@mirbileta.ru</div>
            </div>

        </div>
    </div>

    <div class="footer-line-2">
        <div class="container posRel">
            <div class="footer-menu-wrapper footer-menu-1">
                <div class="footer-menu-header">О НАС</div>

                <?php
                $args = array(
                    'menu'            => 'footer_menu_1',     // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                    // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                    'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                    'container_class' => '',     // (string) class контейнера (div тега)
                    'container_id'    => '',              // (string) id контейнера (div тега)
                    'menu_class'      => 'footer-menu-body',              // (string) class самого меню (ul тега)
                    'menu_id'         => '',              // (string) id самого меню (ul тега)
                    'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                    'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                    'before'          => '',              // (string) Текст перед <a> каждой ссылки
                    'after'           => '',              // (string) Текст после </a> каждой ссылки
                    'link_before'     => '',              // (string) Текст перед анкором (текстом) ссылки
                    'link_after'      => '',              // (string) Текст после анкора (текста) ссылки
                    'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                    'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
                    'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
                );

//                TICKET_SERVICE_FEE

                wp_nav_menu($args)
                ?>

            </div>
            <div class="footer-menu-wrapper">
                <div class="footer-menu-header">ИНФОРМАЦИЯ</div>

                <?php
                $args = array(
                    'menu'            => 'footer_menu_2',     // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                    // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                    'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                    'container_class' => '',     // (string) class контейнера (div тега)
                    'container_id'    => '',              // (string) id контейнера (div тега)
                    'menu_class'      => 'footer-menu-body',              // (string) class самого меню (ul тега)
                    'menu_id'         => '',              // (string) id самого меню (ul тега)
                    'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                    'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                    'before'          => '',              // (string) Текст перед <a> каждой ссылки
                    'after'           => '',              // (string) Текст после </a> каждой ссылки
                    'link_before'     => '',              // (string) Текст перед анкором (текстом) ссылки
                    'link_after'      => '',              // (string) Текст после анкора (текста) ссылки
                    'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                    'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
                    'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
                );

                //                TICKET_SERVICE_FEE

                wp_nav_menu($args)
                ?>

            </div>
            <div class="footer-menu-wrapper">
                <div class="footer-menu-header">ПАРТНЕРЫ</div>

                <div class="f-p-logo-row">
                    <a href="http://kremlinpalace.org" target="_blank"><div class="f-p-logo gkd-f"></div></a>
                    <a href="http://www.barvikhaconcerthall.ru/" target="_blank"><div class="f-p-logo barvikha-f"></div></a>
                    <a href="http://acquiropay.com/" target="_blank"><div class="f-p-logo acquiropay-f"></div></a>
                </div>

                <div class="f-p-logo-row">
                    <a href="http://bigcirc.ru/" target="_blank"><div class="f-p-logo vernadka-f"></div></a>
                    <a href="http://www.sovremennik.ru/" target="_blank"><div class="f-p-logo sovremennik-f"></div></a>
                </div>

                <div class="f-p-logo-row">
                    <a href="/multibooker" target="_blank"><div class="f-p-logo multibooker-f"></div></a>
                </div>

            </div>

            <div class="mb-copyright">
                mirbileta.ru все права защищены&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Powered by Multibooker
            </div>
        </div>
    </div>

    <div class="mb-go-to-top fa fa-arrow-up"></div>

</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter32940504 = new Ya.Metrika({
                    id:32940504,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/32940504" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- begin of Top100 code -->
<div style="display: none">
    <script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?4416842"></script>
    <noscript>
        <a href="http://top100.rambler.ru/navi/4416842/">
            <img src="http://counter.rambler.ru/top100.cnt?4416842" alt="Rambler's Top100" border="0" />
        </a>

    </noscript>
</div>

<?php wp_footer(); ?>

<!-- end of Top100 code -->