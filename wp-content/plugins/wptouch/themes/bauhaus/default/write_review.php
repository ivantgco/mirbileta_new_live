<?php
/*
    Template Name: write review
*/

    $login_key = $_GET['k'] || 'unlogged';

//    if($login_key == '')


?>





<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->


<head>

    <meta charset="UTF-8"/>

    <?php include 'seo.php'; ?>
<!--    <title>--><?php //wp_title('-', true, 'right'); ?><!--</title>-->

    <!--    <title>&nbsp;&nbsp;Мир Билета - Электронные билеты</title>-->

    <link href="/wp-content/themes/mirbileta_new_life/assets/img/favicon.png" rel="shortcut icon" type="image/i-icon">

    <?php include 'viewport.php';?>


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all'/>
	-->

	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i|Rambla:700&amp;subset=cyrillic" rel="stylesheet"> 

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> data-page="inner">


<div class="header_block">
	<a href="#"><h1>mirbileta.ru</h1></a>
	<a class="lk_link" href="#">
		<span><b>Скидки</b> на&nbsp;билеты здесь</span>
	</a>
</div>
<div class="forms-container">
<form>
	<h2>
		Ну, как Вам спектакль?<br>
		Поделитесь впечатлениями!
	</h2>
	<div class="feedback_slider">
		<div class="inner">
			<h3>Укажите рейтинг:</h3>
			<div class="range-slider">
				<input value="0">
			</div>
			<!--<div class="smile v0"></div>-->
		</div>
	</div>
	<div class="inner">
		<textarea class="feedback_text" placeholder="Напишите отзыв здесь"></textarea>
		<a href="#" class="fake_input_file">
			<span class="icon addfile"><i class="fa fa fa-paperclip" aria-hidden="true"></i> Есть фото или видео - поделись!</span>
		</a>
		<input type="file">
		<input type="submit" value="Отправить" />
		<!--<a href="#" class="next-q">
			Далее
		</a>-->
	</div>
</form>

<form class="hidden">
	<h2>
		Ну а еще что?<br>
		Поделитесь впечатлениями!
	</h2>
	<div class="feedback_slider">
		<div class="inner">
			<h3>Укажите рейтинг:</h3>
			<div class="range-slider">
				<input value="0">
			</div>
			<!--<div class="smile v0"></div>-->
		</div>
	</div>
	<div class="inner">
		<textarea class="feedback_text" placeholder="Напишите отзыв здесь"></textarea>
		<a href="#" class="fake_input_file">
			<span class="icon addfile"><i class="fa fa fa-paperclip" aria-hidden="true"></i> Есть фото или видео - поделись!</span>
		</a>
		<input type="file">
		<input type="submit" value="Отправить" />
	</div>
</form>
</div>
<script type='text/javascript' src='/wp-content/plugins/wptouch/themes/bauhaus/default/js/jquery-ui.min.js'></script>
<script type='text/javascript' src='/wp-content/plugins/wptouch/themes/bauhaus/default/js/jquery.ui.touch-punch.js'></script>
<script type='text/javascript' src='/wp-content/plugins/wptouch/themes/bauhaus/default/js/write_review.js'></script>
</body>


<!--END-->