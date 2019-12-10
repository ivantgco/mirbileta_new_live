<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 19.08.16
 * Time: 21:16
 */

?>

<div class="main-menu-holder">


<div class="container main-menu-holder-wrap">

    <a href="/" class="main-menu-holder-wrap-title">
    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/header-logo.png">
    </a>

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
        'link_before'     => '',              // (string) Текст перед анкором (текстом) ссылки
        'link_after'      => '',              // (string) Текст после анкора (текста) ссылки
        'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
        'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
        'theme_location'  => ''               // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
    );

    wp_nav_menu($args)
    ?>

    <a href="tel:84950053023" class="main-menu-holder-wrap-phone">
        +7 (495) 005-30-23
    </a>

</div>


</div>