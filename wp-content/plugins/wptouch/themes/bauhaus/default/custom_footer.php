
<div class="mmb-footer">

    <div class="mmb-footer-1">
        <div class="pr50 flLeft">
            <div class="mmb-footer-logo">MIRBILETA.RU</div>
            <div class="mmb-footer-rights">все права защищены</div>
        </div>
        <div class="pr50 flLeft">
            <div class="mmb-footer-phone">+7 (499) <span>391</span>-61-97</div>
            <div class="mmb-footer-email">info@mirbileta.ru</div>
        </div>
    </div>
    <div class="mmb-footer-2">


        <div class="mmb-footer-full">
            <?php get_template_part( 'switch-link' ); ?>
<!--            Полная версия-->
        </div>
        <div class="mmb-footer-top"><i class="fa fa-chevron-up"></i></div>
    </div>






</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter35968625 = new Ya.Metrika({
                    id:35968625,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
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
<noscript><div><img src="https://mc.yandex.ru/watch/35968625" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<?php
//
//    $args = array(
//        'menu'            => 'mobile_inline_menu',     // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
//                                              // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
//        'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
//        'container_class' => 'mmb-inline-menu',     // (string) class контейнера (div тега)
//        'container_id'    => '',              // (string) id контейнера (div тега)
//        'menu_class'      => '',              // (string) class самого меню (ul тега)
//        'menu_id'         => '',              // (string) id самого меню (ul тега)
//        'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
//        'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
//        'before'          => '',              // (string) Текст перед <a> каждой ссылки
//        'after'           => '',              // (string) Текст после </a> каждой ссылки
//        'link_before'     => '<div class="mm-title">',              // (string) Текст перед анкором (текстом) ссылки
//        'link_after'      => '</div>',              // (string) Текст после анкора (текста) ссылки
//        'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
//        'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
//        'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
//    );
//
//    wp_nav_menu($args)
//
//?>
