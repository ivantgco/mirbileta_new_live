<?php


//$global_prot = 'http';
//$global_url = '192.168.1.190';

$global_prot = 'https';
$global_url = 'shop.mirbileta.ru';

$defaultPoster = 'https://shop.mirbileta.ru/assets/img/medium_default_poster.png';
$defaultSmall = 'https://shop.mirbileta.ru/assets/img/small_default_poster.png';


add_action( 'foundation_enqueue_scripts', 'bauhaus_enqueue_scripts' );


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

    wp_enqueue_script('jquery_my',      get_stylesheet_directory_uri() . '/plugins/jquery/jquery-1.12.0.min.js');
    wp_enqueue_script('uitabs',         get_stylesheet_directory_uri() . '/plugins/uiTabs/uiTabs.js');
    wp_enqueue_script('mustache',         get_stylesheet_directory_uri() . '/plugins/mustache/mustache.js');
    wp_enqueue_script('core',           get_stylesheet_directory_uri() . '/js/core.js');
    wp_enqueue_script('mmb_script',     get_stylesheet_directory_uri() . '/js/mmb_script.js');
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