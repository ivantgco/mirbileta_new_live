(function(){

    $.fn.mb_checkbox = function(){
        var $e = this;

        if($e.attr('data-checked') == undefined){
            $e.attr('data-checked', 'false');
        }

        $e.mb_checked = ($e.attr('data-checked') == undefined)? false : ($e.attr('data-checked') == 'false')? false : true ;


        $e.off('click').on('click', function(){

            if($e.mb_checked){
                $e.mb_checked = false;
                $e.attr('data-checked', 'false');
            }else{
                $e.mb_checked = true;
                $e.attr('data-checked', 'true');
            }

            $e.trigger('change', [$e.mb_checked]);

        });
    };

}());
