<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( ' | ', true, 'right' ); ?></title>
		<?php wptouch_head(); ?>
		<?php
			if ( !is_single() && !is_archive() && !is_page() && !is_search() ) {
				wptouch_canonical_link();
			}

			if ( isset( $_REQUEST[ 'wptouch_preview_theme' ] ) || isset( $_REQUEST[ 'wptouch_switch' ] ) )  {
				echo '<meta name="robots" content="noindex" />';
			}
		?>
	</head>

	<body <?php body_class( wptouch_get_body_classes() ); ?>>
    <div id="mmb-page-container">
<!--        <div class="mmb-coming-soon">-->
<!--            <div class="mmb-cs-logo">MIRBILETA.R2U</div>-->
<!--            <div class="mmb-cs-text">Мобильная версия в разработке, релиз на днях!</div>-->
<!--            <div class="mmb-cs-text">+7 (906) 063-<span>88</span>-66</div>-->
<!--        </div>-->

        <?php

        include('custom_header.php');

        ?>
    </div>

<!--		--><?php //do_action( 'wptouch_preview' ); ?>
<!---->
<!--		--><?php //do_action( 'wptouch_body_top' ); ?>
<!---->
<!--		--><?php //get_template_part( 'header-bottom' ); ?>
<!---->
<!--		--><?php //do_action( 'wptouch_body_top_second' ); ?>
