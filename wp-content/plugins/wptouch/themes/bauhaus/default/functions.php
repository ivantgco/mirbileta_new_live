<?php

add_action( 'foundation_enqueue_scripts', 'bauhaus_enqueue_scripts' );

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