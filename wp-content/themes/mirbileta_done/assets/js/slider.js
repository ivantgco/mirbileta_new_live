(function(){

    var slider = {
        wrapper: undefined,
        init: function(wrapper){
            slider.wrapper = wrapper;
//            slider.blur();
            slider.setHandlers();
        },
        blur: function(){
//            alert(123);

//            $('.slider-item').each(function(i,elem){
//                $(elem)
//            });
//
//            slider.wrapper.blurjs({
//                source: '.slider-item',
//                radius: 10,
//                overlay: 'rgba(0,0,0,0.3)'
//            });
        },
        setHandlers: function(){

        }
    };

    $(document).ready(function(){
        slider.init($('.slide-info'));
    });

}());
