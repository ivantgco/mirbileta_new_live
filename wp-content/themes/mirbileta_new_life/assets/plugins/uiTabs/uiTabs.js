var uiTabs = function(){
    for(var i=0; i< $('.sc_tabulatorParent').length; i++){
        var item = $('.sc_tabulatorParent').eq(i),
            itemWidth = item.width(),
            togglerCollection = item.find('.sc_tabulatorToggler'),
            togglersCount = togglerCollection.length;

        togglerCollection.each(function(idx, elem){
            $(elem).width(100 / togglersCount+'%');
        });

        item.css('display','block');
    }

    $(document).on('click', '.sc_tabulatorToggler', function () {
        var parent = $(this).parents('.sc_tabulatorParent').eq(0),
            togRow = parent.find('.sc_tabulatorToggleRow').eq(0),
            togglers = togRow.find('.sc_tabulatorToggler'),
            itemsCount = togglers.length,
            ddRow = parent.find('.sc_tabulatorDDRow').eq(0),
            number = $(this).attr('dataItem'),
            items = ddRow.children('.sc_tabulatorDDItem'),
            ddItem = ddRow.find('.sc_tabulatorDDItem[dataItem="' + number + '"]');

        if ($(this).hasClass('opened') || $(this).hasClass('disabled')) {
            return;
        }

        togRow.children('.sc_tabulatorToggler').removeClass('opened');

        items.removeClass('opened').hide(0);

        ddItem.fadeIn(100).addClass('opened');

        $(this).addClass('opened');

    });
};