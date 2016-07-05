

$(document).on("ready", function() {

    var gurl = 'dev.mirbileta.ru';


	$(".fake_input_file").on('click', function(e){
	    e.preventDefault();
	    $(this).parent().find("input[type='file']:hidden").trigger('click');
	});


	$(".feedback_slider .range-slider input").ionRangeSlider({
		min: 0,
		max: 10,
		step:0.1,
		grid: true
		//values: [0, 3.5, 5, 7.5, 10],
	});

	$(".page-template-write_review .next-q").on('click', function(e){
		e.preventDefault();
		$(this).parents('form').hide();
		$(this).parents('form').next('form:hidden').show();
	});

    //get / new / modify / remove

    var rat = $('slider').val();


//    $('.btn').off('click').on('click', function(){

        var o = {
            command: 'new',
            object: 'review',
            params:{
                url: gurl
                //rating
                //review
                //files // как загрузить файл
            }
        };


//        a.review_id,
//        a.creation_date,
//        a.sale_site_customer_id,
//        a.sale_site_id,
//        a.action_id,
//        a.show_id,
//        a.actor_id,
//        a.hall_scheme_item_id,
//        a.rating,
//        a.review,
//        a.media_url

        socketQuery_b2c(o, function(r){


            // Если ответ от сервака - ОК
                // Приезжает следующая форма ( про место в зале )
                // Собираем данные - отправляем
                    // Если ок - повторить про сервис
                        // В Финале редирект в рут личного кабинета
            // Если НЕТ - выводим ошибку

            console.log(r);

        });


//    });


});