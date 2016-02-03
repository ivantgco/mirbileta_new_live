<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:10
 */

?>

<div class="header site-header">
    <div id="filters_data"></div>
    <div class="container posRel">

        <a href="/"><div class="logo-wrapper">
                <div class="mb-logo-title">MIRBILETA.RU</div>
                <div class="mb-logo-subtitle">Электронные&nbsp;билеты</div>
<!--                <img src="/wp-content/themes/mirbileta_new_life/assets/img/logo.png" />-->
            </div></a>
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
                            <input class="mb-tf-rs-input mb-tf-rs-from" disabled type="text" placeholder="" value="300"/>
                            &mdash;
                            <input class="mb-tf-rs-input mb-tf-rs-to" disabled type="text" placeholder="" value="Дороже"/>
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
                    'menu'            => 'top_header_menu',              // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                                                                // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                    'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                    'container_class' => '',              // (string) class контейнера (div тега)
                    'container_id'    => '',              // (string) id контейнера (div тега)
                    'menu_class'      => '',              // (string) class самого меню (ul тега)
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

                wp_nav_menu($args)

                ?>
        </div>
        <div class="contacts-wrapper">
            <div class="contacts-phone">+7 (499) 391<span>-61</span>-97</div>
            <div class="contacts-email">info@mirbileta.ru</div>
        </div>

    </div>

</div>