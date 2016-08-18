<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 09.10.15
 * Time: 17:24
 */

//update_option('siteurl', 'http://mirbileta.ru');
//update_option('home', 'http://mirbileta.ru');

define( 'WP_DEBUG', true );

$global_prot = 'http';
$global_url = '95.165.147.252';

//$global_prot = 'https';
//$global_url = 'shop.mirbileta.ru';

$global_salesite = 'dev.mirbileta.ru';
//$global_salesite = 'mirbileta.ru';

$defaultPoster = 'https://shop.mirbileta.ru/assets/img/medium_default_poster.png';
$defaultSmall = 'https://shop.mirbileta.ru/assets/img/small_default_poster.png';




function request_url()
{
    $result = ''; // Пока результат пуст
    $default_port = 80; // Порт по-умолчанию

    // А не в защищенном-ли мы соединении?
    if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
        // В защищенном! Добавим протокол...
        $result .= 'https://';
        // ...и переназначим значение порта по-умолчанию
        $default_port = 443;
    } else {
        // Обычное соединение, обычный протокол
        $result .= 'http://';
    }
    // Имя сервера, напр. site.com или www.site.com
    $result .= $_SERVER['SERVER_NAME'];

    // А порт у нас по-умолчанию?
    if ($_SERVER['SERVER_PORT'] != $default_port) {
        // Если нет, то добавим порт в URL
        $result .= ':'.$_SERVER['SERVER_PORT'];
    }
    // Последняя часть запроса (путь и GET-параметры).
    $result .= $_SERVER['REQUEST_URI'];
    // Уфф, вроде получилось!
    return $result;
}

function addRoutes() {
    $urlKey = $_SERVER[REQUEST_URI];
    add_rewrite_rule('(kupit_bilet)?$', 'kupit_bilet/'.$urlKey.'zopa', 'top');
}
//index.php?pagename=$matches[1]

addRoutes();

function to_short_mth($date_str)
{
    $space_idx = strpos($date_str, ' ');
    $date_part = mb_substr($date_str, 0, $space_idx, 'utf-8');
    $mth_part = mb_substr($date_str, $space_idx + 1, 3, 'utf-8');

    return $date_part . ' ' . $mth_part;
}

function to_afisha_date($str, $format, $lang)
{
    $dd = substr($str, 0, 2);
    $mm = substr($str, 3, 2);
    $yy = substr($str, 6, 4);
    $hh = substr($str, 11, 2);
    $mi = substr($str, 14, 2);
    $si = substr($str, 17, 2);

    $mths = array(
        "rus"=> array(
            "янв","фев","мар","апр","май","июн","июл","авг","сен","окт","ноя","дек"
        ),
        "eng"=>array(
            "jan","feb","mar","apr","may","jun","jul","aug","sep","okt","nov","dec"
        )
    );

    $months = array(
        "rus"=> array(
            "Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"
        ),
        "eng"=>array(
            "January","Febuary","March","April","May","Juny","July","August","September","Oktober","November","December"
        )
    );

    $weekDays = array(
        "rus"=>array(
            "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "суббота", "Воскресенье"
        ),
        "eng"=>array(
            "mo", "tu", "we", "th", "fr", "sa", "su"
        )
    );

    $weekDays_short = array(
        "rus"=>array(
            "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"
        ),
        "eng"=>array(
            "mo", "tu", "we", "th", "fr", "sa", "su"
        )
    );



    $res = '';

    switch ($format){
        case 'short_date':
            $res = $dd . ' ' . $mths[$lang][intval($mm)-1];
            break;
        case 'year':
            $res = $yy;
            break;
        case 'short_date_with_year':
            $res = $dd . ' ' . $mths[$lang][intval($mm)-1] . ' ' . $yy;
            break;
        case 'full_date':
            $res = $dd . ' ' . $mths[$lang][intval($mm)-1] . ' ' . $yy;
            break;
        case 'weekday':
            $res = $weekDays[$lang][date('N', strtotime($yy.'-'.$mm.'-'.$dd.' '.$hh.":".$mi.":00")) -1];
            break;
        case 'weekday_short':
            $res = $weekDays_short[$lang][date('N', strtotime($yy.'-'.$mm.'-'.$dd.' '.$hh.":".$mi.":00")) -1];
            break;
        case 'time':
            $res = $hh . ':' . $mi;
            break;
        case 'week_and_time':
            $res = $weekDays[$lang][date('N', strtotime($yy.'-'.$mm.'-'.$dd.' '.$hh.':'.$mi.':00')) -1] .' '. $hh . ':' . $mi;
            break;
        case 'mounth_only':
            $res = $months[$lang][intval($str)-1];
            break;
        case 'is_holiday':
            $res = date('N', strtotime($yy.'-'.$mm.'-'.$dd.' '.$hh.":".$mi.":00"));
            break;
        default:
            break;
    }
    return $res;
};

function my_theme_load_resources() {


    wp_enqueue_style('bootstrap',       get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-3.3.6-dist/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome',     get_stylesheet_directory_uri() . '/assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css');
    wp_enqueue_style('normalize',       get_stylesheet_directory_uri() . '/assets/css/normalize.css');
    wp_enqueue_style('rangeslider',     get_stylesheet_directory_uri() . '/assets/plugins/ion.rangeSlider-2.1.2/css/ion.rangeSlider.css');
    wp_enqueue_style('rangeslider_cus', get_stylesheet_directory_uri() . '/assets/plugins/ion.rangeSlider-2.1.2/css/ion.rangeSlider.custom.css');
    wp_enqueue_style('datepicker',      get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
    wp_enqueue_style('toastr',          get_stylesheet_directory_uri() . '/assets/plugins/toastr/toastr.min.css');
    wp_enqueue_style('core',            get_stylesheet_directory_uri() . '/assets/css/core.css');
    wp_enqueue_style('style',           get_stylesheet_directory_uri() . '/assets/css/style.css');

    wp_enqueue_script('jquery_my',      get_stylesheet_directory_uri() . '/assets/plugins/jquery/jquery-1.12.0.min.js');
    wp_enqueue_script('uri',            get_stylesheet_directory_uri() . '/assets/plugins/uri/URI.js');
    wp_enqueue_script('uri_tpl',        get_stylesheet_directory_uri() . '/assets/plugins/uri/URITemplate.js');
    wp_enqueue_script('bootstrap',      get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-3.3.6-dist/js/bootstrap.min.js');
    wp_enqueue_script('toastr',         get_stylesheet_directory_uri() . '/assets/plugins/toastr/toastr.min.js');
    wp_enqueue_script('blur',           get_stylesheet_directory_uri() . '/assets/plugins/blur/blur.js');
    wp_enqueue_script('mb_checkbox',    get_stylesheet_directory_uri() . '/assets/plugins/mb-chekbox/mb-checkbox.js');
    wp_enqueue_script('uitabs',         get_stylesheet_directory_uri() . '/assets/plugins/uiTabs/uiTabs.js');
    wp_enqueue_script('moment',         get_stylesheet_directory_uri() . '/assets/plugins/moment/moment.js');
    wp_enqueue_script('mustache',       get_stylesheet_directory_uri() . '/assets/plugins/mustache/mustache.js');
    wp_enqueue_script('rangeslider',    get_stylesheet_directory_uri() . '/assets/plugins/ion.rangeSlider-2.1.2/js/ion-rangeSlider/ion.rangeSlider.min.js');
    wp_enqueue_script('datepicker',     get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
    wp_enqueue_script('datepicker_loc', get_stylesheet_directory_uri() . '/assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js');
    wp_enqueue_script('core',           get_stylesheet_directory_uri() . '/assets/js/core.js');
    wp_enqueue_script('script',         get_stylesheet_directory_uri() . '/assets/js/script.js');
    wp_enqueue_script('adv',            get_stylesheet_directory_uri() . '/assets/js/adv_generator.js');
    wp_enqueue_script('cookie',         get_stylesheet_directory_uri() . '/assets/plugins/jquery.cookie/jquery.cookie.js');

    wp_enqueue_script('gmaps',         'http://maps.googleapis.com/maps/api/js?sensor=false');

}

add_action('wp_enqueue_scripts', 'my_theme_load_resources');

function wp_head_meta_description() {
    global $post;
    if( is_single() ) {
        echo "<meta name=\"description\" value=\"" . esc_attr( get_post_meta( $post->ID, 'seo_description', true ) ) ."\" />\n\r";
    }
}

add_action("wp_head", "wp_head_meta_description", 1);


?>
