$(document).ready(function() {

	var swiperH = new Swiper(".swiper-container-h", {
		spaceBetween: 0,
		slidesPerView: 1,
		//loop: true
		nextButton: $(".sch-next"),
		prevButton: $(".sch-prev"),
		mousewheelControl: true,
        noSwiping: true,
		noSwipingClass: "fourth-section",
		pagination: '.clone-nav-wrap',
		paginationModifierClass: "main-nav-",
		bulletClass: "main-nav-bullet",
		bulletActiveClass: "main-nav-active",
		paginationClickable: true,
		paginationBulletRender: function (swiper, index, className) {
			var textIns = [];
			var textInsA = [];
			$(".main-nav li").each(function(index) {
				textIns[index] = $(this).find("a").text();
				textInsA[index] = $(this).find("a").attr("href");
			});
			return '<li class="' + className + '"><a href="' + textInsA[index] + '">' + textIns[index] + '</a></li>';
		}
	});


    $('#multibooker-widget-wrapper').on('mouseenter', function(){
        console.log('IN');
        swiperH.disableMousewheelControl();
    });
    $('#multibooker-widget-wrapper').on('mouseleave', function(){
        console.log('OUT');
        swiperH.enableMousewheelControl();
    });

//    $("#multibooker-widget-wrapper").mousedown(function() {
//        swiperVFourth.lockSwipes();
//        swiperH.lockSwipes();
//    });
//
//    $("#multibooker-widget-wrapper").mouseup(function() {
//        swiperVFourth.unlockSwipes();
//        swiperH.unlockSwipes();
//    });

	var swiperV = new Swiper(".swiper-container-v", {
		direction: "vertical",
		spaceBetween: 0,
		slidesPerView: 1,
		//mousewheelControl: true,
		nextButton: $(".st-next"),
		prevButton: $(".st-prev")
		//loop: true
		//noSwipingClass: "swiper-slide"
	});

	var sfSlider = new Swiper(".sf-slider", {
		centeredSlides: true,
		spaceBetween: 0,
		slidesPerView: 2,
		//width: 1600,
		loop: true,
		nextButton: $(".sf-slider-next"),
		prevButton: $(".sf-slider-prev"),
		//slidesOffsetBefore: 30,
		//mousewheelControl: true,
		//noSwipingClass: ".first-section"
		breakpoints: {
			// when window width is <= 320px
			1300: {
			slidesPerView: 1.5,
			centeredSlides: false
			}
		}
	});

	var swiperVFourth = new Swiper(".sfourth-slider", {
		direction: "vertical",
		spaceBetween: 0,
		slidesPerView: 1,
		//mousewheelControl: true,
		nextButton: $(".fourth-st-next"),
		prevButton: $(".fourth-st-prev"),
		//loop: true
        noSwiping: true,
		noSwipingClass: "sfourth-second-slide"
		//noSwipingClass: "sfourth-first-slide"
		/*onSlideChangeEnd: function(swiper) {
			if ($(".sfourth-second-slide.swiper-slide-active").length > 0) {
				gP();
			} else {
				console.log("000");
			};
		}*/
	});


    $('.contacts-confirm-btn').on('click', function(e){

        e.preventDefault();

        var o = {
            command: 'Send_Email_to_Support',
            params: {
                title: 'Golden Palace',
                message: $('#f-name').val() + ' ' + $('#f-phone').val() + $('#f-email').val() + ' ' + new Date()
            }
        };

        socketQuery_site(o, function(res){
            console.log(res);
        });



    });


	$(".main-nav-ul").remove();

	$(".main-nav-btn").click(function(e) {
		e.preventDefault();
		$(".main-nav ul").stop().slideToggle(400);
	});

	/*function mVp () {
		var mvp = document.getElementById('mvp');
		var windowWidth = $(window).width();
		if (windowWidth <= 1024) {
			console.log("true");
			mvp.setAttribute('content','width=1024');
		};
		if (windowWidth > 1024) {
			console.log("true");
			mvp.setAttribute('content','width=1920');
		};
	};

	$(window).resize(function() {
		mVp();
	});*/

	$(".show-more-btn").click(function(e) {
		e.preventDefault();
		swiperH.slideNext(true, 400);
	});

	$(".chooses-table-btn").click(function(e) {
		swiperH.slideTo(3, 800, true);
	});
	
	$(".sc-menu-btn").click(function(e) {
		e.preventDefault();
		swiperH.slideNext(true, 400);
	});

	$(".more-known-info-btn").click(function(e) {
		e.preventDefault();
		swiperVFourth.slideTo(2, 800, true);
	});

	$(".buy-tickets-btn").click(function(e) {
		e.preventDefault();
		swiperVFourth.slideTo(1, 400, true);
	});

	$(".to-begin-btn").click(function(e) {
		swiperH.slideTo(0, 1000, true);
	});

	$(".sfourth-fs-purchase-btn").click(function(e) {
		e.preventDefault();
		swiperVFourth.slideNext(true, 400);
	});

	setTimeout(function() {
		$(".sfourth-second-slide").addClass("sfourth-second-slide-no-active");
	}, 1000);

	/*function erT () {
		var fF = $(".sfourth-first-slide").height();
		$(".sfourth-first-slide").css("height", fF - 190 + "px");
		console.log(fF);
	};erT();*/

	$(document).click(function(e) {
		if ($(".sfourth-second-slide").hasClass("swiper-slide-active")) {
			console.log("111");
		} else if (!$(".sfourth-second-slide").hasClass("swiper-slide-active")) {
			console.log("000");
		};
	});

});

$(window).load(function() { 

	var dD = device.desktop();

	if (dD == true) {
		var wW = document.createElement("script");
		wW.src = ("https://shop.mirbileta.ru/assets/widget/mb_widget.js");
		document.body.appendChild(wW);
	} else {
		var wW = document.createElement("script");
		wW.src = ("https://shop.mirbileta.ru/assets/widget/widget-mobile.js");
		document.body.appendChild(wW);
	};
	/*var mvp = document.getElementById('mvp');
	var windowWidth = $(window).width();
	if (windowWidth <= 1024) {
		console.log("true");
		mvp.setAttribute('content','width=1024');
	};*/

	/*var mvp = document.getElementById('mvp');
	var windowWidth = $(window).width();
	if (windowWidth <= 1024) {
		console.log("true");
		mvp.setAttribute('content','width=1024');
	};
	if (windowWidth > 1024) {
		console.log("true");
		mvp.setAttribute('content','width=1920');
	};*/

	$(".loader").fadeOut(1000000).remove();
	$(".wrapper").delay(500).fadeOut("slow");
});