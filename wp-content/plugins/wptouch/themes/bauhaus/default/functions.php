<?php


//$global_prot = 'http';
//$global_url = '192.168.1.190';

$global_prot = 'https';
$global_url = 'shop.mirbileta.ru';

$defaultPoster = 'https://shop.mirbileta.ru/assets/img/medium_default_poster.png';
$defaultSmall = 'https://shop.mirbileta.ru/assets/img/small_default_poster.png';




add_action( 'foundation_enqueue_scripts', 'bauhaus_enqueue_scripts' );


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

    $res = '';

    switch ($format){
        case 'short_date':
            $res = $dd . ' ' . $mths[$lang][intval($mm)-1];
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
        case 'time':
            $res = $hh . ':' . $mi;
            break;
        case 'week_and_time':
            $res = $weekDays[$lang][date('N', strtotime($yy.'-'.$mm.'-'.$dd.' '.$hh.':'.$mi.':00')) -1] .' '. $hh . ':' . $mi;
            break;
        case 'mounth_only':
            $res = $months[$lang][intval($str)-1];
            break;
        default:
            break;
    }
    return $res;
};


function mmb_get_mth($date_str)
{
    $space_idx = strpos($date_str, ' ');
    $mth_part = mb_substr($date_str, $space_idx + 1, 3, 'utf-8');

    return $mth_part;
}

function mmb_get_day($date_str)
{
    $space_idx = strpos($date_str, ' ');
    $date_part = mb_substr($date_str, 0, $space_idx, 'utf-8');


    return $date_part;
}

function to_short_mth($date_str)
{
    $space_idx = strpos($date_str, ' ');
    $date_part = mb_substr($date_str, 0, $space_idx, 'utf-8');
    $mth_part = mb_substr($date_str, $space_idx + 1, 3, 'utf-8');

    return $date_part . ' ' . $mth_part;
}

function bauhaus_enqueue_scripts() {
	wp_enqueue_script(
		'bauhaus-js',
		BAUHAUS_URL . '/default/bauhaus.js',
		array( 'jquery' ),
		BAUHAUS_THEME_VERSION,
		true
	);



    wp_enqueue_style('fontawesome',     get_stylesheet_directory_uri() . '/plugins/font-awesome-4.5.0/css/font-awesome.min.css');
    wp_enqueue_style('normalize',       get_stylesheet_directory_uri() . '/css/normalize.css');
    wp_enqueue_style('rangeslider',     get_stylesheet_directory_uri() . '/plugins/ion.rangeSlider-2.1.2/css/ion.rangeSlider.css');
    wp_enqueue_style('rangeslider_cus', get_stylesheet_directory_uri() . '/plugins/ion.rangeSlider-2.1.2/css/ion.rangeSlider.custom.css');
    wp_enqueue_style('datepicker',      get_stylesheet_directory_uri() . '/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

    wp_enqueue_script('jquery_my',      get_stylesheet_directory_uri() . '/plugins/jquery/jquery-1.12.0.min.js');
    wp_enqueue_script('email_marketing',      'https://inboxer.pro/assets/mirbileta/ssb.js');
    wp_enqueue_script('uri',            get_stylesheet_directory_uri() . '/plugins/uri/URI.js');
    wp_enqueue_script('moment',         get_stylesheet_directory_uri() . '/plugins/moment/moment.js');
    wp_enqueue_script('uitabs',         get_stylesheet_directory_uri() . '/plugins/uiTabs/uiTabs.js');
    wp_enqueue_script('mustache',       get_stylesheet_directory_uri() . '/plugins/mustache/mustache.js');
    wp_enqueue_script('rangeslider',    get_stylesheet_directory_uri() . '/plugins/ion.rangeSlider-2.1.2/js/ion-rangeSlider/ion.rangeSlider.min.js');
    wp_enqueue_script('datepicker',     get_stylesheet_directory_uri() . '/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
    wp_enqueue_script('datepicker_loc', get_stylesheet_directory_uri() . '/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js');
    wp_enqueue_script('swipe',          get_stylesheet_directory_uri() . '/plugins/touch/jquery.touchSwipe.min.js');
    wp_enqueue_script('core',           get_stylesheet_directory_uri() . '/js/core.js');
    wp_enqueue_script('mmb_script',     get_stylesheet_directory_uri() . '/js/mmb_script.js');
    wp_enqueue_script('gmaps',         'http://maps.googleapis.com/maps/api/js');
}

function bauhaus_should_show_thumbnail() {
	$settings = bauhaus_get_settings();

	switch( $settings->bauhaus_use_thumbnails ) {
		case 'none':
			return false;
		case 'index':
			return is_home();
		case 'index_single':
			return is_home() || is_single();
		case 'index_single_page':
			return is_home() || is_single() || is_page();
		case 'all':
			return is_home() || is_single() || is_page() || is_archive() || is_search();
		default:
			// in case we add one at some point
			return false;
	}
}

function bauhaus_should_show_taxonomy() {
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_taxonomy ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_date(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_date ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_author(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_author ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_search(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_search ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_comment_bubbles(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_comment_bubbles ) {
		return true;
	} else {
		return false;
	}
}