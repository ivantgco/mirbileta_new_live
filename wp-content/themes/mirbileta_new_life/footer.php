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
                <div class="contacts-phone">+7 (499) 391<span>-61</span>-97</div>
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

<!--                <ul class="footer-menu-body">-->
<!--                    <li><a href="">Контакты</a></li>-->
<!--                    <li><a href="">О Компании</a></li>-->
<!--                    <li><a href="">Публичаня оферта</a></li>-->
<!--                    <li><a href="">Логотипы</a></li>-->
<!--                    <li><a href="">Multibooker</a></li>-->
<!--                </ul>-->
            </div>
            <div class="footer-menu-wrapper">
                <div class="footer-menu-header">БИЗНЕС</div>
                <ul class="footer-menu-body">
                    <li><a href="">Хотите расширить объем продаж?</a></li>
                    <li><a href="">Хотите сэкономить на агентских отношениях?</a></li>
                    <li><a href="">Хотите организовать собственный билетный бизнес?</a></li>
                    <li><a href="">Вам нужен виджет онлайн продажи на сайт?</a></li>
                    <li><a href="">Вам нужна современная и гибкая билетная система?</a></li>
                    <li><a href="">Схемы залов</a></li>
                </ul>
            </div>
            <div class="footer-menu-wrapper">
                <div class="footer-menu-header">ИНФОРМАЦИЯ</div>
                <ul class="footer-menu-body">
                    <li><a href="">Как купить билет?</a></li>
                    <li><a href="">Перенос. Отмена. Замена.</a></li>
                    <li><a href="">Возврат билетов</a></li>
                    <li><a href="">Способы оплаты</a></li>
                    <li><a href="">Как работает электронный билет?</a></li>
                    <li><a href="">Билет не пришел на почту? Восстановление.</a></li>
                </ul>
            </div>

            <div class="mb-copyright">
                mirbileta.ru все права защищены&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Powered by Multibooker
            </div>
        </div>
    </div>

</div>