<div class="wptouch-mobile-switch">

	<?php do_action( 'wptouch_switch_top' ); ?>

	<?php if ( wptouch_use_mobile_switch_link() ) { ?>

        <a class="off tappable" role="button" href="<?php wptouch_the_mobile_switch_link(); ?>" rel="nofollow">Полная версия</a>

<!--		<div id="switch">-->
<!--			<div>-->
<!--				<span class="on active" role="button">--><?php //_e( 'mobile', 'wptouch-pro' ); ?><!--</span>-->
<!---->
<!--			</div>-->
<!--		</div>-->
	<?php } ?>

	<?php do_action( 'wptouch_switch_bottom' ); ?>

</div>