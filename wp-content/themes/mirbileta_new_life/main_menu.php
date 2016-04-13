<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:23
 */
?>

<div class="main-menu-wrapper">
    <div class="container">

        <?php
        $args = array(
            'menu'            => 'main_menu',     // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                                                  // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
            'container'       => 'ul',            // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
            'container_class' => 'main-menu',     // (string) class контейнера (div тега)
            'container_id'    => '',              // (string) id контейнера (div тега)
            'menu_class'      => '',              // (string) class самого меню (ul тега)
            'menu_id'         => '',              // (string) id самого меню (ul тега)
            'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
            'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
            'before'          => '',              // (string) Текст перед <a> каждой ссылки
            'after'           => '',              // (string) Текст после </a> каждой ссылки
            'link_before'     => '<div class="mm-icon" data-icon="performance"></div><div class="mm-title">',              // (string) Текст перед анкором (текстом) ссылки
            'link_after'      => '</div>',              // (string) Текст после анкора (текста) ссылки
            'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
            'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
            'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
        );

        wp_nav_menu($args)
        ?>


<!--        <a href="/contest-fast"><div class="contest-fast-launcher inner-page-launcher"><span class="contest-fast-launcher-sub">Конкурс</span><br/>"Кто быстрее?!"</div></a>-->

    </div>
</div>