

$(document).on("ready", function() {

    var gurl = 'mirbileta.ru';


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

    var o = {
        command: 'new',
        object: 'review',
        params:{
            url: gurl
        }
    };


    socketQuery_b2c(o, function(r){
        console.log(r);
    });

});