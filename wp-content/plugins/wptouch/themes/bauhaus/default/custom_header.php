<?php
include 'contest-fast-header.php';
?>


<div class="mmb-header">
    <div class="mmb-menu">
        <i class="fa fa-bars"></i>
        <i class="fa fa-times"></i>
    </div>
    <a href="/" class="mmb-logo">MIRBILETA.RU</a><!---->
    <div class="mmb-search">
        <i class="fa fa-search"></i>
        <i class="fa fa-times"></i>
    </div>
</div>
<div class="mmb-search-dd">
    <div class="mmb-search-holder">
        <input type="text" id="mmb-search-input" placeholder="Поиск"/>
        <div class="mmb-search-icon fa fa-search"></div>
        <div class="mmb-search-confirm fa fa-check"></div>
        <div class="mmb-search-info">Поиск по мероприятиям, площадкам и актерам.</div>
    </div>


    <div class="mmb-search-results">

        <div class="tabsParent mmb-tabsParent sc_tabulatorParent">
            <div class="tabsTogglersRow sc_tabulatorToggleRow wid100pr flLeft">

                <div class="tabToggle sc_tabulatorToggler opened flLeft" dataitem="0" title="">
                    <span class="">Мероприятия</span>
                </div>

                <div class="tabToggle sc_tabulatorToggler flLeft" dataitem="1" title="">
                    <span class="">Площадки</span>
                </div>

                <div class="tabToggle sc_tabulatorToggler flLeft" dataitem="2" title="">
                    <span class="">Люди</span>
                </div>

            </div>
            <div class="ddRow notZindexed sc_tabulatorDDRow wid100pr flLeft">

                <div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight opened" dataitem="0">
                    <div class="mmb-search-actions mmb-search-lockscroll"></div>
                </div>

                <div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight" dataitem="1">
                    <div class="mmb-search-venues mmb-search-lockscroll"></div>
                </div>

                <div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight" dataitem="2">
                    <div class="mmb-search-actors mmb-search-lockscroll"></div>
                </div>

            </div>

        </div>

    </div>
    <div class="mmb-search-dd-fader">Скрыть поиск</div>
</div>

<div class="mmb-side-menu">

    <div class="mmb-side-menu-wrapper">

        <div class="mmb-sm-menu mmb-sm-menu-1">
            <?php

            $args = array(
                'menu'            => 'main_mobile_menu',     // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                'container_class' => 'mmb-side-menu',     // (string) class контейнера (div тега)
                'container_id'    => '',              // (string) id контейнера (div тега)
                'menu_class'      => '',              // (string) class самого меню (ul тега)
                'menu_id'         => '',              // (string) id самого меню (ul тега)
                'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                'before'          => '',              // (string) Текст перед <a> каждой ссылки
                'after'           => '',              // (string) Текст после </a> каждой ссылки
                'link_before'     => '<div class="mm-title">',              // (string) Текст перед анкором (текстом) ссылки
                'link_after'      => '</div>',              // (string) Текст после анкора (текста) ссылки
                'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
                'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
            );

            wp_nav_menu($args)

            ?>
        </div>
        <div class="mmb-sm-menu mmb-sm-menu-2">
            <?php

            $args = array(
                'menu'            => 'main_mobile_menu_2',     // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                'container_class' => 'mmb-side-menu',     // (string) class контейнера (div тега)
                'container_id'    => '',              // (string) id контейнера (div тега)
                'menu_class'      => '',              // (string) class самого меню (ul тега)
                'menu_id'         => '',              // (string) id самого меню (ul тега)
                'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                'before'          => '',              // (string) Текст перед <a> каждой ссылки
                'after'           => '',              // (string) Текст после </a> каждой ссылки
                'link_before'     => '<div class="mm-title">',              // (string) Текст перед анкором (текстом) ссылки
                'link_after'      => '</div>',              // (string) Текст после анкора (текста) ссылки
                'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
                'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
            );

            wp_nav_menu($args)

            ?>
        </div>


    </div>

    <div class="mmb-menu-dd-fader">Скрыть меню</div>

</div>
