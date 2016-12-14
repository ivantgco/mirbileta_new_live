(function(){


    $(document).ready(function(){

        $('.zm .buy-btn, .intro-zm-btn, .split-btn-item.zm, .zm-page .buy-btn').off('click').on('click', function(){

            if(document.location.href.indexOf('zatmir') > -1 || document.location.href.indexOf('multikidom') > -1){
                location.href = '#tickets';
            }else{
                bootbox.dialog({
                    title: 'Выберите дату и время',
                    message: '',
                    buttons: {

                    }
                });
            }

        });


        var imgidx = 1;

        var t = window.setInterval(function(){

            $('.intro-bg-zm').fadeOut(480);
            $('.intro-bg-zm[data-id="'+imgidx+'"]').fadeIn(480);

            if(imgidx == 6){
                imgidx = 1;
            }else{
                imgidx++;
            }


        }, 3500);

    });



}());
