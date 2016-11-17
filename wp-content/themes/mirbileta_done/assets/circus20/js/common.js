$(document).ready(function() {

    $(".select-places-form label input").click(function(e) {
        e.preventDefault();
    });

    function winHFirst() {
        var windowHeight = $(window).height();
        $(".main-header").css("height", windowHeight + "px");
    };winHFirst();

    function videoBgSize () {
        var video = $(".bg-video");
        var videoW = video.width();
        var videoH = video.height();
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        if (videoW < windowWidth) {
            video.css("width", windowWidth + "px");
            video.css("height", "auto");
        } else if (videoH < windowHeight) {
            video.css("width", "auto");
            video.css("height", windowHeight);
        } else if (videoH < windowHeight && windeoW < windowWidth) {
            video.css("width", windowWidth);
            video.css("height", windowHeight);
        };
    };videoBgSize();

    $(".main-header-more-btn").click(function(e) {
        e.preventDefault();
        var id = $(".first-section");
        var top = $(id).offset().top;
        $("body, html").stop().animate({scrollTop: top}, 600);
    });

    var mM;
    var dataId;
    var sumDay;
    var fullDay;
    var curTime;
    var qQ = new Date ();
    var wW = qQ.getMonth()+1;
    var dD = qQ.getDate();
    var curT = qQ.getHours();
    console.log(dD, curT);
    if (wW == 1) {
        mM = "Января";
    } else if (wW == 2) {
        mM = "Февраля";
    } else if (wW == 3) {
        mM = "Марта";
    } else if (wW == 4) {
        mM = "Апреля";
    } else if (wW == 5) {
        mM = "Майя";
    } else if (wW == 6) {
        mM = "Июня";
    } else if (wW == 7) {
        mM = "Июля";
    } else if (wW ==8) {
        mM = "Августа";
    } else if (wW == 9) {
        mM = "Сентября";
    } else if (wW == 10) {
        mM = "Октября";
    } else if (wW == 11) {
        mM = "Ноября";
        if (dD <= 9) {
            sumDay = 9;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4003;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD >= 9 && dD < 11) {
            sumDay = 11;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4003;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 11 && dD <= 12) {
            sumDay = 12;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 3984;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 3997;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 12 && dD <= 13) {
            sumDay = 13;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 3985;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 3998;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 13 && dD <= 16) {
            sumDay = 16;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4005;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 16 && dD <= 18) {
            sumDay = 18;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4006;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 18 && dD <= 19) {
            sumDay = 19;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 3986;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 3999;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 19 && dD <= 20) {
            sumDay = 20;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 3987;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 4000;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 20 && dD <= 23) {
            sumDay = 23;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4007;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 23 && dD <= 25) {
            sumDay = 25;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4008;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 25 && dD <= 26) {
            sumDay = 26;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 3988;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 4001;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 26 && dD <= 27) {
            sumDay = 27;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 3989;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 4002;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 27 && dD <= 30) {
            sumDay = 30;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4009;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        };
    } else if (wW == 12) {
        mM = "Декабря";
        if (dD < 2) {
            sumDay = 2;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4010;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 2 && dD <= 3) {
            sumDay = 3;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 4013;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 4017;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 3 && dD <= 4) {
            sumDay = 4;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 4014;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 4018;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 4 && dD <= 7) {
            sumDay = 7;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4011;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 7 && dD <= 9) {
            sumDay = 9;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 19 !=0 && fullDay < 19) {
                dataId = 4012;
                curTime = "19:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 9 && dD <= 10) {
            sumDay = 10;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 4015;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 4019;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        } else if (dD > 10 && dD <= 11) {
            sumDay = 11;
            fullDay = (sumDay - dD) * 24 - curT;
            if (fullDay + 13 !=0 && fullDay < 13) {
                dataId = 4016;
                curTime = "13:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            } else if (fullDay + 17 !=0 && fullDay < 17) {
                dataId = 4020;
                curTime = "17:00";
                $(".multibooker-buy-button").attr("data-id", dataId);
                $(".new-date-ins").text(sumDay + " " + mM + ",");
                $(".date-time").text(curTime);
            };
        };
    };

    $(".mult-calendar-button").click(function(e) {
        e.preventDefault();
        $(".popup-calendar-wrapper").addClass("popup-calendar-wrapper-active");
        $("body, html").addClass("body-lock");
    });

    function calChooseDate () {
        var d1 = 4003;
        var d2 = 4004;
        var d3 = 3984;
        var d4 = 3997;
        var d5 = 3985;
        var d6 = 3998;
        var d7 = 4005;
        var d8 = 4006;
        var d9 = 3986;
        var d10 = 3999;
        var d11 = 3987;
        var d12 = 4000;
        var d13 = 4007;
        var d14 = 4008;
        var d15 = 3988;
        var d16 = 4001;
        var d17 = 3989;
        var d18 = 4002;
        var d19 = 4009;
        /**/
        var d20 = 4010;
        var d21 = 4013;
        var d22 = 4017;
        var d23 = 4014;
        var d24 = 4018;
        var d25 = 4011;
        var d26 = 4012;
        var d27 = 4015;
        var d28 = 4019;
        var d29 = 4016;
        var d30 = 4020;
        /**/
        var dDate;
        var dTime;
        var dMonth;
        /**/
        $(".cal-choose-date-btn").each(function(l) {
            var gG = $(this).attr("data-ins-id");
            $(this).attr("data-id", gG);
        });
        $(".cal-choose-date-btn").click(function(e) {
            e.preventDefault();
            var dI = $(this).attr("data-ins-id");
            console.log(dI);
            if (dI == d1) {
                dDate = 9;
                dTime = "19:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d2) {
                dDate = 11;
                dTime = "19:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d3) {
                dDate = 12;
                dTime = "13:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            }
            else if (dI == d4) {
                dDate = 12;
                dTime = "17:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d5) {
                dDate = 13;
                dTime = "13:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d6) {
                dDate = 13;
                dTime = "17:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d7) {
                dDate = 16;
                dTime = "119:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d8) {
                dDate = 18;
                dTime = "19:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d9) {
                dDate = 19;
                dTime = "13:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d10) {
                dDate = 19;
                dTime = "17:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d11) {
                dDate = 20;
                dTime = "13:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d12) {
                dDate = 20;
                dTime = "17:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d13) {
                dDate = 23;
                dTime = "19:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d14) {
                dDate = 25;
                dTime = "19:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d15) {
                dDate = 26;
                dTime = "13:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d16) {
                dDate = 26;
                dTime = "17:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d17) {
                dDate = 27;
                dTime = "13:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d18) {
                dDate = 27;
                dTime = "17:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d19) {
                dDate = 30;
                dTime = "19:00";
                dMonth = "Ноября";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d20) {
                dDate = 2;
                dTime = "19:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d21) {
                dDate = 3;
                dTime = "13:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d22) {
                dDate = 3;
                dTime = "17:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d23) {
                dDate = 4;
                dTime = "13:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d24) {
                dDate = 4;
                dTime = "17:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d25) {
                dDate = 7;
                dTime = "19:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d26) {
                dDate = 9;
                dTime = "19:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d27) {
                dDate = 10;
                dTime = "13:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d28) {
                dDate = 10;
                dTime = "17:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d29) {
                dDate = 11;
                dTime = "13:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            } else if (dI == d30) {
                dDate = 11;
                dTime = "17:00";
                dMonth = "Декабря";
                $(".new-date-ins").text(dDate + " " + dMonth + ",");
                $(".date-time").text(dTime);
                $(".multibooker-buy-button").attr("data-id", dI);
            };
            $(".popup-calendar-wrapper").removeClass("popup-calendar-wrapper-active");
            $("body, html").removeClass("body-lock");
            var id = $(".sixth-section");
            var top = $(id).offset().top;
            $("body, html").stop().animate({scrollTop: top}, 600);
            //$(".select-places-confirm-btn").click();
        });
    };calChooseDate();

    $(".s-s-next-btn").click(function(e) {
        e.preventDefault();
        var id = $(".third-section");
        var top = $(id).offset().top;
        $("body, html").stop().animate({scrollTop: top}, 600);
    });

    $(".select-places-btn").click(function(e) {
        e.preventDefault();
        var id = $(".sixth-section");
        var top = $(id).offset().top;
        $("body, html").stop().animate({scrollTop: top}, 600);
    });

    $(".mf-up-btn").click(function(e) {
        e.preventDefault();
        $("body, html").stop().animate({scrollTop: 0}, 800);
    });

    $('.select-date').on("change", function() {
        var date = $(this).val();
        $(".new-date-ins").text(date);
    });

    $(".fs-container-more-btn").click(function(e) {
        e.preventDefault();
        $(".fs-cont-wrapper-more").stop().fadeIn(400);
        $(".fs-container-bottom-a").stop().fadeOut(400);
        $(".fs-cr-a-container").addClass("fs-cont-wrapper-more-open");
    });

    $(".select-date-container").click(function(e) {
        e.preventDefault();
        $(".popup-calendar-wrapper").addClass("popup-calendar-wrapper-active");
        $("body, html").addClass("body-lock");
    });

    $(".calendar-close-btn").click(function(e) {
        e.preventDefault();
        $(".popup-calendar-wrapper").removeClass("popup-calendar-wrapper-active");
        $("body, html").removeClass("body-lock");
    });

    $(".popup-calendar-wrapper").click(function(e) {
        e.preventDefault();
        if ($(this).is(e.target)) {
            $(".popup-calendar-wrapper").removeClass("popup-calendar-wrapper-active");
            $("body, html").removeClass("body-lock");
        } else {
            return;
        };
    });

    $(".recall-btn").click(function(e) {
        e.preventDefault();
        $(".recall-popup-wrapper").addClass("recall-popup-wrapper-active");
        $("body, html").addClass("body-lock");
    });

    $(".recall-close-btn").click(function(e) {
        e.preventDefault();
        $(".recall-popup-wrapper").removeClass("recall-popup-wrapper-active");
        $("body, html").removeClass("body-lock");
    });

    $(".recall-popup-wrapper").click(function(e) {
        e.preventDefault();
        if ($(this).is(e.target)) {
            $(".recall-popup-wrapper").removeClass("recall-popup-wrapper-active");
            $("body, html").removeClass("body-lock");
        } else {
            return;
        };
    });

    $(".faq-popup-wrapper").each(function(i) {
        $(this).addClass("faq-popup-wrapper-find-" + i);
    });
    $(".faq-container li a").each(function(j) {
        $(this).addClass("faq-container-click-" + j);
        $(".faq-container-click-" + j).click(function(e) {
            e.preventDefault();
            $(".faq-popup-wrapper-find-" + j).stop().fadeIn(400).addClass("faq-popup-active");
            $("body, html").addClass("body-lock");
            setTimeout(function() {
                fHeight();
            }, 401);
        });
    });

    $(".faq-popup-close-btn").click(function(e) {
        e.preventDefault();
        $(".faq-popup-wrapper").removeClass("faq-popup-active");
        $(".faq-popup-wrapper").stop().fadeOut(400);
        $("body, html").removeClass("body-lock");
        $(".faq-popup-wrapper").removeClass("faq-popup-adaptive");
    });

    $(".faq-popup-wrapper").click(function(e) {
        e.preventDefault();
        if ($(this).is(e.target)) {
            $(".faq-popup-wrapper").removeClass("faq-popup-active");
            $(".faq-popup-wrapper").stop().fadeOut(400);
            $("body, html").removeClass("body-lock");
            $(".faq-popup-wrapper").removeClass("faq-popup-adaptive");
        } else {
            return;
        };
    });

    $('.recall-confirm-btn').off('click').on('click', function(){

        var name = $('#rc-name').val();
        var phone = $('#rc-phone').val();

        var o = {
            command: 'Send_Email_to_Support',
            params: {
                title: name,
                message: phone
            }
        };

        socketQuery_site(o, function(res){
            console.log(res);
        });


    });

    function fHeight () {
        var windowHeight = $(window).height();
        $(".faq-popup-wrapper").each(function(z) {
            var fHeight = $(document).find(this).find(".faq-popup-container").outerHeight();
            console.log(fHeight);
            if (windowHeight < fHeight) {
                $(this).addClass("faq-popup-adaptive");
            } else {
                $(this).removeClass("faq-popup-adaptive");
            };
        })
    };fHeight();

    $(window).resize();
    $(window).resize(function() {
        winHFirst();
        videoBgSize();
    });

});

$(window).load(function() {
    $(".loader").fadeOut(1000000).remove();
    $(".w-left").removeClass("w-active");
    $(".w-right").removeClass("w-active");
    $(".wrapper").delay(500).fadeOut("slow");
    function videoBgSize () {
        var video = $(".bg-video");
        var videoW = video.width();
        var videoH = video.height();
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        if (videoW < windowWidth) {
            video.css("width", windowWidth + "px");
            video.css("height", "auto");
        } else if (videoH < windowHeight) {
            video.css("width", "auto");
            video.css("height", windowHeight);
        } else if (videoH < windowHeight && windeoW < windowWidth) {
            video.css("width", windowWidth);
            video.css("height", windowHeight);
        };
    };videoBgSize();
});