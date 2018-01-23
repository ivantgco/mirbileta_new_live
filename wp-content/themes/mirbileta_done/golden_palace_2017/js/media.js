$(document).ready(function() {

	function fH () {
		var fHeight = $(window).height();
		$("body, html").css("min-height", fHeight + "px");
	};fH();

	$(".main-m-nav-btn").click(function(e) {
		e.preventDefault();
		$(this).stop().toggleClass("main-m-nav-btn-hidden");
		$(".main-m-nav").stop().toggleClass("main-m-nav-open");
		swiper_mH.lockSwipes();
	});

	$(".main-m-nav-close-btn").click(function(e) {
		e.preventDefault();
		$(".main-m-nav-btn").stop().removeClass("main-m-nav-btn-hidden");
		$(".main-m-nav").stop().removeClass("main-m-nav-open");
		swiper_mH.unlockSwipes();
	});

	var find_mouse=false;

	$(".main-m-nav-btn, .main-m-nav").hover(function(){ 
		find_mouse=true;
	}, function(){
		find_mouse=false;
	});

	$(document).click(function(e) {
		if(!find_mouse) {
			$(".main-m-nav-btn").stop().removeClass("main-m-nav-btn-hidden");
			$(".main-m-nav").stop().removeClass("main-m-nav-open");
			swiper_mH.unlockSwipes();
		};
	});

	var swiper_mH = new Swiper(".swiper-m-container-h", {
		spaceBetween: 0,
		slidesPerView: 1,
		nextButton: $(".shc-m-next-btn"),
		mousewheelControl: true,
		pagination: '.clone-m-nav-wrap',
		paginationModifierClass: "main-m-nav-",
		bulletClass: "main-m-nav-bullet",
		bulletActiveClass: "main-m-nav-active",
		paginationClickable: true,
		paginationBulletRender: function (swiper, index, className) {
			var textIns = [];
			var textInsA = [];
			$(".main-m-nav li").each(function(index) {
				textIns[index] = $(this).find("a").text();
				textInsA[index] = $(this).find("a").attr("href");
			});
			return '<li class="' + className + '"><a href="' + textInsA[index] + '">' + textIns[index] + '</a></li>';
		}
	});

	$(".main-m-nav-ul a, .clone-m-nav-wrap a").click(function(e) {
		e.preventDefault();
		$(".main-m-nav-btn").stop().removeClass("main-m-nav-btn-hidden");
		$(".main-m-nav").stop().removeClass("main-m-nav-open");
		swiper_mH.unlockSwipes();
	});

	var swiper_mV = new Swiper(".swiper-m-container-v", {
		direction: "vertical",
		spaceBetween: 0,
		slidesPerView: 1,
		nested: true,
		//mousewheelControl: false,
		nextButton: $(".st-m-next"),
		prevButton: $(".st-m-prev"),
		//loop: true
		//noSwipingClass: "swiper-slide"
		onSlideNextStart: function(swiper) {
			console.log(swiper)
			/*if ($(this).next == 0) {
				swiper_mH.slideNext();
			};*/
			if (swiper_mV.isEnd) {
				console.log("111");
			};
		}
	});

	var swiper_mVFourth = new Swiper(".sfourth-m-slider", {
		direction: "vertical",
		spaceBetween: 0,
		slidesPerView: 1,
		nested: true,
		//mousewheelControl: true,
		nextButton: $(".fourth-m-st-next"),
		prevButton: $(".fourth-m-st-prev"),
	});

	var sfSlider = new Swiper(".sf-m-slider", {
		centeredSlides: false,
		spaceBetween: 0,
		slidesPerView: 1.1,
		loop: true,
		nextButton: $(".sf-m-slider-next"),
		prevButton: $(".sf-m-slider-prev"),
		//slidesOffsetBefore: 30,
		//mousewheelControl: true,
		//noSwipingClass: ".first-section"
		breakpoints: {
			/*1300: {
			slidesPerView: 1.5,
			centeredSlides: false,
			},*/
		}
	});

	$(".main-m-nav-ul").remove();

	$(".ss-m-groupe-container").click(function(e) {
		e.preventDefault();
		$(".ss-m-groupe-container").removeClass("ss-m-groupe-container-open");
		$(this).addClass("ss-m-groupe-container-open");
	});

	$(window).resize(function() {
		fH();
	});

});

$(window).load(function() {

	var wW = document.createElement("script");
	wW.src = ("https://shop.mirbileta.ru/assets/widget/widget-mobile.js");
	document.body.appendChild(wW);

	/*var dD = device.desktop();

	if (dD == true) {
		var wW = document.createElement("script");
		wW.src = ("https://shop.mirbileta.ru/assets/widget/mb_widget.js");
		document.body.appendChild(wW);
	} else {
		var wW = document.createElement("script");
		wW.src = ("https://shop.mirbileta.ru/assets/widget/widget-mobile.js");
		document.body.appendChild(wW);
	};*/

	$(".loader").fadeOut(1000000).remove();
	$(".wrapper").delay(500).fadeOut("slow");
});