(function(){

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "100000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    var defaultPoster = 'https://shop.mirbileta.ru/assets/img/medium_default_poster.png';

    var today = new Date().toLocaleDateString();

    var loadingHtml =       '<div class="ms-loading"><i class="fa fa-search"></i>&nbsp;&nbsp;Идет поиск&hellip;</div>';
    var emptyHtml =         '<div class="ms-loading">Поискали &ndash; не нашли, попробуйте другой запрос.</div>';
    var clearHtml =         '<div class="ms-loading">Введите поисковый запрос.</div>';
    var errorHtml =         '<div class="ms-loading">Простите, но кажется с поиском что-то не так&hellip;<br/>Звоните:&nbsp;&nbsp;&nbsp;+7 (906) 063-88-66</div>';

    var gip = 'shop.mirbileta.ru';
    var gprot = 'https';
    var gurl = 'mirbileta.ru';

    var inQuery = false;
    var lastInputTime = undefined;

    var getNoun = function(number, one, two, five) {
        number = Math.abs(number);
        number %= 100;
        if (number >= 5 && number <= 20) {
            return five;
        }
        number %= 10;
        if (number == 1) {
            return one;
        }
        if (number >= 2 && number <= 4) {
            return two;
        }
        return five;
    };

    var filters = {};

    function generateDatesList(str){

    }

    function getGuid(){
        return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxxx".replace(/[xy]/g, function (c) {
            var r, v;
            r = Math.random() * 16 | 0;
            v = (c === "x" ? r : r & 0x3 | 0x8);
            return v.toString(16);
        }).toUpperCase();
    }

    function generateUrl(page){

        var url_str = '';
        var indexer = 0;

        for(var i in filters){
            var f = filters[i];
            if(indexer == 0){
                if(f.toString().length > 0){
                    url_str += i + '=' + f ;
                }

            }else{
                if(f.toString().length > 0){
                    url_str += '&' + i + '=' + f ;
                }
            }
            indexer++;
        }

        if(page){
            document.location.href = '/' + page +'?'+ url_str;
        }else{
            document.location.search = url_str;
        }


    }

    function parseUrl(){

        var url = new URI(document.location.href);

        filters = url.search(true);

        if($('body').attr('data-filter')){
            filters.show_type_alias = $('body').attr('data-filter');
        }

        if($('body').attr('data-venue')){
            filters.venue_id = $('body').attr('data-venue');
        }

        if($('body').attr('data-actor')){
            filters.actor_id = $('body').attr('data-actor');
        }


        console.log(filters);

    }

    function getCookie(c_name){
        var i,x,y,ARRcookies=document.cookie.split(";");

        for (i=0;i<ARRcookies.length;i++)
        {
            x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
            y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
            x=x.replace(/^\s+|\s+$/g,"");
            if (x==c_name)
            {
                return unescape(y);
            }
        }
    }

    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }

    var Filter = function(params){
        this.data =     {};
        this.id =       params.id || getGuid();
        this.wrapper =  params.wrapper;
        this.name =     params.wrapper.attr('data-filter');


        this.filters_data = {
            venue_id: {
                type: 'lov',
                getData: 'get_venue',
                name_ru: 'Площадки:',
                ret_id: 'VENUE_ID',
                ret_name: 'VENUE_NAME'
            },
            show_genre_id: {
                type: 'lov',
                getData: 'get_genre',
                name_ru: 'Жанры:',
                ret_id: 'SHOW_GENRE_ID',
                ret_name: 'SHOW_GENRE_NAME'
            },
            actor_id: {
                type: 'lov',
                getData: 'get_actor',
                name_ru: 'Исполнители:',
                ret_id: 'ACTOR_ID',
                ret_name: 'ACTOR_NAME'
            },
            author_id: {
                type: 'lov',
                getData: 'get_author',
                name_ru: 'Авторы:',
                ret_id: 'AUTHOR_ID',
                ret_name: 'AUTHOR_NAME'
            },
            action_tag_id: {
                type: 'lov',
                getData: 'get_action_tag',
                name_ru: 'Теги:',
                ret_id: 'ACTION_TAG_ID',
                ret_name: 'ACTION_TAG'
            },
            price: {
                type: 'range_slider',
                getData: '',
                name_ru: 'Цена билета:',
                ret_id: '',
                ret_name: ''
            },
            daterange: {
                type: 'daterange',
                getData: '',
                name_ru: 'Диапазон дат:',
                ret_id: '',
                ret_name: ''
            },
            search: {
                type: 'search',
                getData: '',
                name_ru: 'Поиск:',
                ret_id: '',
                ret_name: ''
            }
        };

        this.name_ru =  this.filters_data[this.name].name_ru;
        this.type =     this.filters_data[this.name].type;

        this.init();
    };

    Filter.prototype.init = function(){
        var _t = this;
        var type = _t.type;



        if(type == 'lov'){
            _t.getData(function(){
                _t.populate();
                _t.setHandlers();
            });
        }else if(type == 'range_slider'){
            _t.populate();
            _t.setHandlers();
        }else if(type == 'daterange'){
            _t.populate();
            _t.setHandlers();
        }else if(type == 'search'){
            _t.populate();
            _t.setHandlers();
        }


    };

    Filter.prototype.getData = function(cb){
        var _t = this;

        var o = {
            command: _t.filters_data[_t.name].getData,
            params: {
                url: gurl
            }
        };

        socketQuery_site(o, function(res){
            var jRes = jsonToObj(JSON.parse(res)['results'][0]);
            _t.data = jRes;

            console.log(jRes);

            if(typeof cb == 'function'){
                cb();
            }
        });
    };

    Filter.prototype.populate = function(){
        var _t = this;
        var tpl = '';
        var mO = {};

        if(_t.type == 'lov'){

            tpl =  '<div class="mb-tf-header">'+
                '<div class="mb-tf-title">{{name_ru}}</div>'+
                '<div class="mb-tf-search-wrapper"><input class="mb-tf-search" type="text" placeholder="Поиск" /></div>'+
                '</div>'+
                '<div class="mb-tf-body">'+
                '{{#data}}'+
                '<div class="mb-tf-entrie" data-filter="{{filter}}">'+
                '<div class="mb-ch-wrapper" data-checked="false" data-id="{{ID}}">'+
                '<div class="mb-ch"></div><span class="mb-ch-label">{{NAME}}</span>'+
                '</div>'+
                '</div>'+
                '{{/data}}'+
                '</div>';

            var data = [];

            for(var i in _t.data){

                data.push({
                    filter: _t.name
                });

                for(var j in _t.data[i]){
                    data[i][j] = _t.data[i][j];
                    data[i]['ID'] = _t.data[i][_t.filters_data[_t.name]['ret_id']];
                    data[i]['NAME'] = _t.data[i][_t.filters_data[_t.name]['ret_name']];
                }
            }

            mO = {
                name_ru: _t.name_ru,
                data: data
            };

            _t.wrapper.html(Mustache.to_html(tpl, mO));

        }else if(_t.type == 'range_slider'){

            var inputshtml = '';

            if(!_t.wrapper.attr('data-inputs') || _t.wrapper.attr('data-inputs') != 'false'){
                inputshtml = '<div class="mb-tf-rangeslider-inputs">' +
                    '<input class="mb-tf-rs-input mb-tf-rs-from" disabled type="text" placeholder="" value="1000"/>' +
                    '&mdash;' +
                    '<input class="mb-tf-rs-input mb-tf-rs-to" disabled type="text" placeholder="" value="10000"/>' +
                    '</div>' ;
            }else{
                inputshtml = '';
            }


            tpl =  '<div class="mb-tf-header">'+
                '<div class="mb-tf-title">{{name_ru}}</div>'+
                '</div>'+
                '<div class="mb-tf-body">'+
                '<div class="mb-tf-rangeslider"></div>' + inputshtml +
                '</div>';

            mO = {
                name_ru: _t.name_ru
            };


            _t.wrapper.html(Mustache.to_html(tpl, mO));

        }else if(_t.type == 'daterange'){

            tpl =   '<div class="mb-tf-header">'+
                '<div class="mb-tf-title">{{name_ru}}</div>'+
                '</div>'+
                '<div class="mb-tf-body">'+
                '<div class="taCenter">'+
                '<input class="mb-tf-rs-input mb-tf-fil-from-date" type="text" placeholder="Дата с"/>'+
                //'&mdash;'+
                '<input class="mb-tf-rs-input mb-tf-fil-to-date" type="text" placeholder="Дата по"/>'+
                '</div>'+
                '</div>';



            mO = {
                name_ru: _t.name_ru
            };

            _t.wrapper.html(Mustache.to_html(tpl, mO));

        }else if(_t.type == 'search'){

            tpl =   '<div class="mb-tf-header">'+
                '<div class="mb-tf-title">{{name_ru}}</div>'+
                '</div>'+
                '<div class="mb-tf-body">'+
                '<input class="mb-tf-rs-input mb-search-byname" type="text" placeholder="Поиск по названию"/>'+
                '</div>';

            mO = {
                name_ru: _t.name_ru
            };

            _t.wrapper.html(Mustache.to_html(tpl, mO));

        }


    };

    Filter.prototype.setHandlers = function(){
        var _t = this;

        function getCheckboxState(type, id){

        }

        if(_t.type == 'lov'){

            _t.wrapper.find('.mb-ch-wrapper').each(function(i,elem){


                var state = (filters[_t.name])? filters[_t.name].split(',').indexOf($(elem).attr('data-id')) != -1 : false;


                console.log(state);

                $(elem).attr('data-checked', state);

                $(elem).mb_checkbox();

                $(elem).off('change').on('change', function(e, data){

                    _t.wrapper.trigger('filterChange', [{instance: _t, key: 'checkbox', val1: data, id: $(elem).attr('data-id')}]);

                });
            });

            _t.wrapper.find('.mb-tf-search').off('input').on('input', function(){
                var val = $(this).val();
                var entries = _t.wrapper.find('.mb-ch-wrapper');
                _t.wrapper.find('.mb-tf-no-entries').remove();

                var count_show = 0;

                for(var i = 0; i < entries.length; i++ ){
                    var e = entries.eq(i);
                    var name = e.find('.mb-ch-label');
                    if(name.text().toLowerCase().indexOf(val.toLowerCase()) > -1){
                        e.show(0);
                        count_show++;
                    }else{
                        e.hide(0);
                    }
                }

                if(count_show == 0){
                    _t.wrapper.find('.mb-tf-body').prepend('<div class="mb-tf-no-entries">Нет результатов</div>');
                }


            });

        }else if(_t.type == 'range_slider'){

//            var from_inp = _t.wrapper.find('.mb-tf-rs-from');
//            var to_inp = _t.wrapper.find('.mb-tf-rs-to');
            var rs_range = [300, 1500, 3000, 5000, '<'];

            _t.wrapper.find('.mb-tf-rangeslider').ionRangeSlider({
                type: "single",
                grid: true,
                from: (filters['min_price'] && filters['min_price'].length > 0)? rs_range.indexOf(+filters['min_price']) : 0,//1,
                to: (filters['max_price'] && filters['max_price'].length > 0)? rs_range.indexOf(+filters['max_price']) : 6,
                values: rs_range,
                onChange: function (data) {

//                    from_inp.val(data.from_value);
//                    to_inp.val(data.to_value);

                    _t.wrapper.trigger('filterChange', [{instance: _t, key: 'price_range', val1: data.from_value, val2: data.to_value}]);
                }
            });

        }else if(_t.type == 'daterange'){

            var dp1 = _t.wrapper.find('.mb-tf-fil-from-date');
            var dp2 = _t.wrapper.find('.mb-tf-fil-to-date');



            dp1.datepicker({
                language: 'ru',
                autoclose: true,
                startDate: today,
                todayBtn: 'linked'
            }).off('changeDate').on('changeDate', function(e){
                var datePicked = e.format('dd.mm.yyyy');

                _t.wrapper.trigger('filterChange', [{instance: _t, key: 'from_date', val1: datePicked}]);

            });

            if(filters['from_date'] && filters['from_date'].length > 0){
                dp1.datepicker('update', filters['from_date']);
            }



            dp2.datepicker({
                language: 'ru',
                autoclose: true,
                startDate: today,
                todayBtn: 'linked'
            }).off('changeDate').on('changeDate', function(e){
                var datePicked = e.format('dd.mm.yyyy');

                _t.wrapper.trigger('filterChange', [{instance: _t, key: 'to_date', val1: datePicked}]);
            });

            if(filters['to_date'] && filters['to_date'].length > 0){
                dp2.datepicker('update', filters['to_date']);
            }




            dp1.off('input').on('input', function(){
                if(dp1.val().length != 10){
                    _t.wrapper.trigger('filterChange', [{instance: _t, key: 'from_date', val1: ''}]);
                }
            });

            dp2.off('input').on('input', function(){
                if(dp2.val().length != 10){
                    _t.wrapper.trigger('filterChange', [{instance: _t, key: 'to_date', val1: ''}]);
                }
            });

        }else if(_t.type == 'search'){

            var sinput = _t.wrapper.find('.mb-search-byname');

            sinput.off('input').on('input', function(){
                var val = $(this).val();

                if(val.length > 1){

                    _t.wrapper.trigger('filterChange', [{instance: _t, key: 'search_keyword', val1: val}]);

                }else{

                    _t.wrapper.trigger('filterChange', [{instance: _t, key: 'search_keyword', val1: val}]);
                }

            });

            sinput.val((filters['search_keyword'] && filters['search_keyword'].length > 0)? filters['search_keyword'] : '' );

        }


        $('.mb-tf-block').off('filterChange').on('filterChange', function(e, data){ //.dark-filters-wrapper

            if(data.key == 'price_range'){

                //filters['min_price'] = (data.val1 == '300')? '' :  data.val1;
                filters['max_price'] = (data.val1 == '<')? '' :  data.val1;

            }else if(data.key == 'checkbox'){

                var type =  data.instance.name;
                var id =    data.id;
                var state = data.val1;

                var typeArray = (filters[type])? filters[type].split(',') : [];

                if(!state){

                    typeArray.splice(typeArray.indexOf(id),1);

                    filters[type] = typeArray.join(',');
                }else{

                    typeArray.push(id);

                    filters[type] = typeArray.join(',');
                }

            }else{
                filters[data.key] = data.val1;
            }


            var o = {
                command: 'get_afisha',
                url: gurl,
                params: {
                    count_only: "TRUE"
                }
            };

            for(var i in filters){
                var f = filters[i];
                o.params[i] = f;
            }

            $('.filter-count-actions, .sc-filter-count-actions').html('<i class="fa fa-spinner fa-spin"></i>');

            socketQuery_site(o, function(res){
                var jRes = JSON.parse(res)['results'][0];

                if(!jRes.code){
                    $('.submit-filters, .sc-submit-filters').removeClass('disabled');

                    if(jRes.count == 0){
                        $('.submit-filters, .sc-submit-filters').addClass('disabled');
                        $('.filter-count-actions, .sc-filter-count-actions').html('(' + jRes.count + ')');

                    }else{
                        $('.filter-count-actions, .sc-filter-count-actions').html('(' + jRes.count + ')');

                    }

                }else{

                    toastr['error']('Кажется произошла системаня ошибка, скоро все исправим.', 'Ой');

                }

            });


        });

        $('.submit-filters').off('click').on('click', function(){

            if($(this).hasClass('disabled')){return;}

            generateUrl();
        });

        $('.extend-search-confirm').off('click').on('click', function(){

            if($(this).hasClass('disabled')){return;}

            generateUrl('extend_search');
        });

        $('.clear-filters, .sc-clear-filters').off('click').on('click', function(){

            filters = {};
            if($('body').attr('data-filter')){
                filters.show_type_alias = $('body').attr('data-filter');
            }
            generateUrl();
        });



    };

    Filter.prototype.return_value = function(){

    };



    var fs = {
        initComponents: function(){

            var sliders = $('.mb-rangeslider');

            var gmapAnim = false;

            sliders.each(function(i, elem){
                $(elem).ionRangeSlider({
                    type: "double",
                    grid: true,
                    from: 0,
                    to: 6,
                    values: [300, 1000, 2000, 3000, 5000, 10000, '<'],
                    onChange: function (data) {
                        var from_inp = $(elem).next().find('.mb-tf-rs-from');
                        var to_inp = $(elem).next().find('.mb-tf-rs-to');
                        from_inp.val(data.from_value);
                        to_inp.val(data.to_value);

                        $(elem).trigger('change_filter', [{data: data}]);
                    }
                });
            });

            $('.dark-filters-clear').off('mouseenter').on('mouseenter', function(){
                $(this).find('i.fa').addClass('fa-spin');

                $('.dark-filters-clear-hint').animate({
                    width: 140 + 'px'
                },200, function(){

                });
            });

            $('.dark-filters-clear').off('mouseleave').on('mouseleave', function(){

                $(this).find('i.fa').removeClass('fa-spin');

                $('.dark-filters-clear-hint').animate({
                    width: 0 + 'px'
                },200, function(){

                });
            });

            $('.dark-filters-show').off('mouseenter').on('mouseenter', function(){

                $('.dark-filters-show-hint').animate({
                    width: 140 + 'px'
                },200, function(){

                });
            });

            $('.dark-filters-show').off('mouseleave').on('mouseleave', function(){

                $('.dark-filters-show-hint').animate({
                    width: 0 + 'px'
                },200, function(){

                });
            });

            $('.one-action-address').off('click').on('click', function(){
                var map_container = $('.one-action-gmap');

                if(gmapAnim){return;}
                gmapAnim = true;

                if(map_container.hasClass('opened')){
                    map_container.animate({
                        height: 0 + 'px',
                        marginTop: 0 + 'px',
                        opacity: 0
                    }, 250, function(){
                        map_container.removeClass('opened');
                        gmapAnim = false;
                    });

                }else{
                    map_container.animate({
                        height: 280 + 'px',
                        marginTop: 30 + 'px',
                        opacity: 1
                    }, 250, function(){
                        map_container.addClass('opened');
                        gmapAnim = false;
                    });
                }

            });

            $('.one-action-buy-link').off('click').on('click', function(){
                $('html, body').animate({
                    scrollTop: ($('.one-action-widget-header').offset().top - 20) + 'px'
                }, 250, function(){

                });
            });

            $('#load_next').off('click').on('click', function(){
                var btn = $(this);
                var page = btn.attr('data-page');
                var acts_wrapper = $('.actions-wrapper');


                function loadNext(page, cb){

                    btn.html('<i class="fa fa-spinner fa-spin"></i>');

                    var o = {
                        command: 'get_afisha',
                        params: {
                            url: gurl,
                            page_no:  page,
                            rows_max_num: 15
                        }
                    };

                    for(var i in filters){
                        var f = filters[i];
                        o.params[i] = f;
                    }


                    console.log('OBJ', o);

                    socketQuery_site(o, function(res){



                        if(!JSON.parse(res)['results'][0].code || JSON.parse(res)['results'][0].code == 0){

                            var actions = jsonToObj(JSON.parse(res)['results'][0]);

//                            var act_m_tpl ='{{#actions}}<div class="mb-block mb-action" data-id="{{ACTION_ID}}">'+
//                                '<a href="/{{alias_link}}"><div class="mb-a-image" style="background-image: url(\'{{ACTION_POSTER_IMAGE}}\');"></div></a>'+
//                                '<a href="/{{alias_link}}"><div class="mb-a-title">{{ACTION_NAME}}<span class="mb-a-age">{{AGE_CATEGORY}}</span></div></a>'+
//                                '<div class="mb-a-date">{{ACTION_DATE_STR}}, <span class="mb-a-time">{{ACTION_TIME_STR}}</span></div>'+
//                                '<a class="venue-link" href="/{{VENUE_URL_ALIAS}}"><div class="mb-a-venue">{{VENUE_NAME}}</div></a>'+
//                                '<div class="mb-a-buy-holder">'+
//                                '<a href="/{{alias_link}}"><div class="mb-buy mb-buy32 soft">Купить билет</div></a>'+
//                                '</div>'+
//                                '</div>{{/actions}}';

                            var act_m_tpl = '{{#actions}}<div class="mb-block mb-action" data-id="{{ACTION_ID}}"><a href="/{{alias_link}}/">'+
                                            '<div class="mb-action-image-holder"><img src="{{ACTION_POSTER_IMAGE}}"></div>'+
                                            '<div class="mb-a-title">{{ACTION_NAME}}<span class="mb-a-age">{{AGE_CATEGORY}}</span></div>'+
                                            '<div class="mb-a-date">{{ACTION_DATE_STR}}, <span class="mb-a-time">{{ACTION_TIME_STR}}</span></div>'+
                                            '<div class="mb-a-venue">{{VENUE_NAME}}</div>'+
                                            '<div class="mb-a-prices-and-buy"><div class="ma-a-prices">от&nbsp;{{MIN_PRICE}}&nbsp;<i class="fa fa-ruble"></i></div><div class="ma-a-buy">Купить билет</div></div>'+
                                            '</a></div>{{/actions}}';



                            var a_data = {actions: []};

                            for(var i in actions){
                                actions[i]['ACTION_POSTER_IMAGE'] = (actions[i]['ACTION_POSTER_IMAGE'] == '')? defaultPoster : actions[i]['ACTION_POSTER_IMAGE'];
                                actions[i]['is_show'] = actions[i]['SHOW_ID'] != '';
                                actions[i]['alias_link'] = (actions[i]['SHOW_URL_ALIAS'] != '')? actions[i]['SHOW_URL_ALIAS'] : actions[i]['ACTION_URL_ALIAS'];
                                actions[i]['price_range'] = (actions[i]['MIN_PRICE'] && actions[i]['MAX_PRICE'])? (actions[i]['MIN_PRICE'] == actions[i]['MAX_PRICE'])? 'по ' + actions[i]['MIN_PRICE'] + ' руб.' : actions[i]['MIN_PRICE'] + ' - ' + actions[i]['MAX_PRICE'] + ' руб.' : '';

                                a_data.actions.push(actions[i]);
                            }

                            if(a_data.actions.length == 0){
                                btn.attr('data-page', page);
                                btn.remove();

                            }else{

                                acts_wrapper.append(Mustache.to_html(act_m_tpl, a_data));

                                if(a_data.actions.length < 15){
                                    btn.remove();
                                }
                            }


                            if(cb && typeof cb == 'function'){
                                btn.attr('data-page', page);
                                btn.html('Загрузить еще');
                                cb();
                            }

                        }else{
                            btn.attr('data-page', page);
                            acts_wrapper.append(errorHtml);
                            if(cb && typeof cb == 'function'){
                                cb();
                            }
                        }

                    });

                }



                if(!page){
                    loadNext(2, function(){

                    });
                }else{
                    loadNext(+page + 1, function(){

                    });
                }

            });

            $('.mb-go-to-top').off('click').on('click', function(){
                $('html, body').animate({
                    scrollTop: 0
                }, 350, function(){

                });
            });

            $('.mb-venue-to-actions').off('click').on('click', function(){

                $('html, body').animate({
                    scrollTop: 904
                }, 250, function(){

                });

            });

            $(document).on('emit_use_widget', function(){

                if(!getCookie('mb_use_widget')){

                    yaCounter32940504.reachGoal('USE_WIDGET');

                    setCookie('mb_use_widget', true);

                }


            });

            $('.run-mobile-version').off('click').on('click', function(){

                $.removeCookie('wptouch-pro-view');
                document.location.reload();

            });

            $('.sidebar-calendar').datepicker({
                language: "ru",
                startDate: "today",
                todayHighlight: true
            }).off('changeDate').on('changeDate', function(e){
                var datePicked = e.format('dd.mm.yyyy');

                document.location.href = '/afisha/?from_date='+datePicked;

            });

            $('.sidebar-tags-toggler').off('click').on('click', function(){
                var list = $('.sidebar-tags-list');

                if(list.hasClass('opened')){
                    list.removeClass('opened');
                    $(this).html('Показать больше тегов');
                }else{
                    list.addClass('opened');
                    $(this).html('Скрыть список тегов');
                }

            });

            $('.mb-subscr-button-toggler').off('click').on('click', function(){

                var p = $(this).parents('.mb-subscr-button-wrapper').eq(0);
//                var dd = p.find('.mb-subscr-button-dd').eq(0);

                if(p.hasClass('opened')){
                    p.removeClass('opened');
                }else{
                    p.addClass('opened');
                }

            });

            $('.sidebar-filter-item-title').off('click').on('click', function(){
                var p = $(this).parents('.sidebar-filter-item-wrapper').eq(0);
                var dd = p.find('.sidebar-filter-item-dd').eq(0);
                var filter = p.attr('data-filter');

                if(p.hasClass('opened')){
                    p.removeClass('opened');
                }else{
                    if(p.hasClass('loaded')){
                        p.addClass('opened');
                    }else{
                        var fid = getGuid();
                        var f = new Filter({
                            id: fid,
                            wrapper:dd
                        });

                        p.addClass('loaded');
                        p.addClass('opened');

                    }
                }


            });

            $('.ig-list-item').off('click').on('click', function(){

                var type = $(this).data('type');
                var url = $(this).data('url');
                var tpl;

                if(type == 'video'){
                    tpl = '<iframe width="575" height="400" src="'+url+'" frameborder="0" allowfullscreen></iframe>';
                    $('.ig-main-wrapper').html(tpl);

                }else{
                    $('.ig-main-wrapper').html('');
                    $('.ig-main-wrapper').attr('style', 'background-image: url('+url+')' );
                }



                console.log('item');
            });

            $('.action-buy-button').off('click').on('click', function(){

                if($(this).hasClass('sc-run-widget')){return false;}

                $('.modal-widget-holder').show(0);

                $.getScript($('#mbw-script-loader').attr('data-src'), function(){

                });

            });

            $('.sc-run-widget').off('click').on('click', function(e){

                $('.modal-widget-holder').remove();
                $('#mbw-script-loader').attr('src', '');


                var a_id = $(this).data('id');
                var frame = $(this).data('frame');

                var tpl =   '<div class="modal-widget-holder">' +
                                '<div class="modal-widget-inner">' +
                                '<div id="multibooker-widget-wrapper"' +
                                'data-actions="{{action_id}}"' +
                                'data-mirbileta="true"' +
                                'data-frame="{{frame}}"' +
                                'data-host="{{global_prot}}://{{global_ip}}/"' +
                                'data-ip="{{ip}}">' +
                                '<div class="mirbileta-widget-wrapper-wait-text"><i class="fa fa-cog fa-spin"></i>&nbsp;&nbsp;Подождите, загружается модуль продажи билетов...</div>' +
                                '</div>' +
                                '</div>' +
                            '</div>' ;

//                tpl += '<script type="text/javascript" id="mbw-script-loader" data-src="{{global_prot}}://{{global_ip}}/assets/widget/mb_widget.js" src=""></script>';

                var mO = {
                    action_id: a_id,
                    frame: frame,
                    global_prot: gprot,
                    global_ip: gip,
                    ip:gip
                };

                $('body').append(Mustache.to_html(tpl, mO));

                $('.modal-widget-holder').show(0);

                $.getScript($('#mbw-script-loader').attr('data-src'), function(){

                });

                if($(this).hasClass('a-date-item-buy')){
                    e.stopPropagation();
                    return false;
                }

            });

            $('.pa-reg-confirm').off('click').on('click', function(){

                var email = $('#pa-reg-email').val();
                var pass = $('#pa-reg-pass').val();

                var o = {
                    command: 'register_new_customer',
                    params: {
                        url: gurl,
                        email: email,
                        password: pass
                    }
                };

                fs.loader(true, 'Секундочку, cоздаём Ваш личный кабинет...');

                socketQuery_b2c(o, function(res){

                    var jRes = JSON.parse(res)['results'][0];

                    if(!jRes.code){

                        var o2 = {
                            command: 'login',
                            params: {
                                url: gurl,
                                email: email,
                                password: pass
                            }
                        };

                        socketQuery_b2c(o2, function(res){
                            var jRes = JSON.parse(res)['results'][0];
                            var sid = jRes.sid;

                            setCookie('site_sid', sid);

                            document.location.href = '/account/';

                        });

                    }else{

                        toastr['error'](jRes.toastr.message);
                        fs.loader(false, 'Секундочку, cоздаём Ваш личный кабинет...');

                    }




                    console.log(jRes);

                });

            });

            $('.pa-login-confirm').off('click').on('click', function(){

                var email = $('#pa-log-email').val();
                var pass = $('#pa-log-pass').val();

//                asdas555@mail.ru
//                123

                var o = {
                    command: 'login',
                    params: {
                        url: gurl,
                        email: email,
                        password: pass
                    }
                };

                socketQuery_b2c(o, function(res){
                    var jRes = JSON.parse(res)['results'][0];

                    var sid = jRes.sid;

                    setCookie('site_sid', sid);

                });

            });

            $('.pa-enter').off('click').on('click', function(){
                $('.pa-modal-holder').show(0);
            });

            $('.pa-account').off('click').on('click', function(){

                document.location.href = '/account/';

            });

            $('.pa-modal-close').off('click').on('click', function(){
                $('.pa-modal-holder').hide(0);
            });

            $('.pa-order-tickets').off('click').on('click', function(){
                var _t = this;
                var p = $(_t).parents('.pa-order-holder');
                var list = p.find('.pa-order-tickets-list');
                var id = $(_t).data('id');
                var loaded = p.data('loaded');

                if(p.hasClass('opened')){

                    p.removeClass('opened');

                    $(_t).html('Билеты');

                }else{

                    if(!loaded){

                        var o = {
                            command: 'get',
                            object: 'order_ticket',
                            params: {
                                url: gurl,
                                order_id: id
                            }
                        };

                        $(_t).html('<i class="fa fa-spin fa-cog"></i>');

                        socketQuery_b2c(o, function(res){

                            var jRes = jsonToObj(JSON.parse(res)['results'][0]);

                            console.log(jRes);

                            var tpl = '{{#tickets}}<div class="pa-order-ticket-item" data-id="{{ORDER_TICKET_ID}}">' +
                                '<div class="pa-ticket-line-place">{{LINE_TITLE}} {{LINE}}{{#isSit}},{{/isSit}} {{PLACE_TITLE}} {{PLACE}}</div>' +
                                '<div class="pa-ticket-area-group">{{AREA_GROUP}}</div>' +
                                '<div class="pa-ticket-price">{{PRICE}} руб.</div>' +
                                '<div class="pa-ticket-print button" data-id="{{ORDER_TICKET_ID}}"><i class="fa fa-print"></i>&nbsp;&nbsp;Распечатать</div>' +
                                '<div class="pa-ticket-download button"  data-id="{{ORDER_TICKET_ID}}"><i class="fa fa-download"></i>&nbsp;&nbsp;Скачать</div>' +
                                '<div class="pa-ticket-send button"  data-id="{{ORDER_TICKET_ID}}"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Отправить</div>' +
                                '</div>{{/tickets}}';

                            var mO = {
                                tickets: []
                            };

                            for(var i in jRes){
                                var t = jRes[i];

                                if(t.PLACE_TYPE == 'SEAT_PLACE'){

                                    t.isSit = true;

                                    mO.tickets[i] = t;

                                }else if(t.PLACE_TYPE == 'WO_PLACE'){

                                    t.isSit = false;
                                    t.LINE_TITLE = t.ACTION_SCHEME_TICKET_ZONE;
                                    t.LINE = '';
                                    t.PLACE_TITLE = '';
                                    t.PLACE = '';


                                    mO.tickets[i] = t;

                                }else{

                                }

                            }


                            list.html(Mustache.to_html(tpl,mO));


                            p.data('loaded', true);
                            p.addClass('opened');
                            $(_t).html('Свернуть');



                            $('.pa-ticket-download').off('click').on('click', function(){
                                var id = $(this).data('id');

                                var o = {
                                    command: 'operation',
                                    object: 'get_web_pdf_ticket',
                                    params: {
                                        order_ticket_id: id
                                    }
                                };

                                socketQuery_b2c(o, function(res){

                                    res = JSON.parse(res)['results'][0];

                                    if (+res.code) {
                                        alert('Что-то не сработало, звоните пожалуйста - поможем! +7 (906) 063-88-66');
                                    }


                                    var filename = res.filename;
                                    var id = 'need_be_removed'+id;

                                    $("body").prepend('<a style="display:none;" id="'+ id +'" href="'+ host +'/' + filename +'" download></a>');

                                    var btn = $('#'+id);

                                    btn.on("click",function (e) {
                                        $(this).remove();
                                    });

                                    btn[0].click();

                                });
                            });

                            $('.pa-ticket-print').off('click').on('click', function(){
                                var id = $(this).data('id');

                                var o = {
                                    command: 'operation',
                                    object: 'get_web_pdf_ticket',
                                    params: {
                                        order_ticket_id: id
                                    }
                                };

                                socketQuery_b2c(o, function(res){

                                    res = JSON.parse(res)['results'][0];

                                    if (+res.code) {
                                        alert('Что-то не сработало, звоните пожалуйста - поможем! +7 (906) 063-88-66');
                                    }


                                    var filename = res.filename;
                                    var id = 'need_be_removed'+id;


                                    function openPrintWindow(url, name, specs) {
                                        var printWindow = window.open(url, name, specs);
                                        var printAndClose = function () {
                                            if (printWindow.document.readyState == 'complete') {
                                                clearInterval(sched);
                                                printWindow.print();
                                                printWindow.close();
                                            }
                                        };
                                        var sched = setInterval(printAndClose, 200);
                                    }

                                    openPrintWindow(host +'/' + filename, 'name', 'width=700,height=400,_blank');


//                                    $("body").prepend('<iframe id="'+ id +'" name="'+ id +'" style="width: 0px; height:0px; overflow:hidden;" src="'+ host +'/' + filename +'"></ireame>');
//
//                                    var f = window.frames[id];
//                                    f.focus();
//                                    f.print();



//                                    f.close();


//                                    btn.on("click",function (e) {
//                                        $(this).remove();
//                                    });

//                                    btn[0].click();

                                });


                            });

                            $('.pa-ticket-send').off('click').on('click', function(){
                                var id = $(this).data('id');


                            });

                        });


                    }else{
                        p.addClass('opened');
                        $(_t).html('Свернуть');
                    }

                }


            });

            $('.gd-header-go-down').off('click').on('click', function(){

                var scTop = $('.gd-body-holder').offset().top;

                $('body').animate({
                    scrollTop: scTop-40 + 'px'
                }, 220, function(){

                });

            });

            $('.sc-gd-fast-code').off('click').on('click', function(){

                bootbox.dialog({
                    title: 'Получить "Код MIRBILETA"',
                    className: 'gd-fast-modal',
                    message:    '<div class="gd-phone-holder">' +
                                '<input type="text" class="gd-phone" placeholder="Ваш Телефон"/>' +
                                '<input type="text" disabled class="gd-phone-code" placeholder="Код из СМС"/>' +
                                '<div class="gd-recieve-code">Выслать код</div>' +
                                '</div>',
                    buttons: {
                        success: {
                            label: 'Отправить',
                            className: 'hidden',
                            callback: function(){

                            }
                        }
                    }
                });


                $('.gd-recieve-code').off('click').on('click', function(){

                    var phone =         $('.gd-phone').eq(0);
                    var phone_code =    $('.gd-phone-code').eq(0);

                    var o = {
                        command: 'confirm_phone',
                        params: {
                            url: gurl,
                            phone: phone.val()
                        }
                    };

                    if(phone.val().length > 0){
                        socketQuery_b2c(o, function(res){

                            var correct_code = 123456;
                            console.log(res);


                            $('.gd-fast-modal').addClass('code-sent');

                            $('.gd-recieve-code').html('Подтвердить');

                            phone.attr('disabled' , 'disabled');

                            phone_code.removeAttr('disabled');
                            phone_code.addClass('unblocked');

                            phone_code.off('input').on('input', function(){

                                if(phone_code.val() == correct_code){


                                    fs.loader(true, 'Секундочку, переносим Вас в личный кабинет!');

                                    document.location.href = '/account/?utm_source=gd_page_by_phone';

                                }else{

                                    if(phone_code.val().length == 6){

                                        toastr['error']('Неверный код, проверьте еще раз.');

                                    }

                                }

                            });

                        });

                    }else{

                        toastr['error']('Введите Ваш номер телефона');

                    }


                });


            });

            $('.sc-gd-ask-question').off('click').on('click', function(){

                bootbox.dialog({
                    title: 'Задать вопрос',
                    message:   '<div class="form-group"><label>Представьтесь, пожалуйста</label><input type="text" class="form-control fb-name"/></div>' +
                            '<div class="form-group"><label>Ваш Email</label><input type="text" class="form-control fb-email"/></div>'+
                            '<div class="form-group"><label>Вопрос</label><textarea class="form-control fb-ask" ></textarea></div>',
                    buttons: {
                        success: {
                            label: 'Отправить',
                            callback: function(){

                            }
                        }

                    }
                });

            });

            $('.advanced-search-holder').off('click').on('click', function(){

                var ext_holder = $('.ext-search-holder');
                var self = this;

                if(ext_holder.hasClass('opened')){

                    $(self).removeClass('opened');
                    $(self).html('Расширенный поиск');
                    ext_holder.removeClass('opened');

                }else{
                    $(self).addClass('opened');
                    $(self).html('Свернуть');
                    ext_holder.addClass('opened');

                }

            });

            $('.mb-show-map').off('click').on('click', function(){

                var map_holder = $('.one-action-gmap');
                var self = this;


                if($(self).hasClass('opened')){
                    $(self).html('Как добраться?');
                }else{
                    $(self).html('Скрыть карту');
                }

                $(self).toggleClass('opened');
                map_holder.toggleClass('opened');


            });

            $(document).off('mbw_close').on('mbw_close', function(){
                $('#multibooker-widget-wrapper').html('');
                $('.modal-widget-holder').hide(0);
            });

            $('.mirbileta-get-discount').pulsate({
                color: '#ccff00', // set the color of the pulse
                reach: 20,                              // how far the pulse goes in px
                speed: 1000,                            // how long one pulse takes in ms
                pause: 1000,                               // how long the pause between pulses is in ms
                glow: true,                             // if the glow should be shown too
                repeat: true,                           // will repeat forever if true, if given a number will repeat for that many times
                onHover: false                          // if true only pulsate if user hovers over the element
            });

            $('.mb-center-search').off('input').on('input', function(){

                var v = $(this).val();
                var l = v.length;
                var more = 3 - l;
                var venue_id = $(this).data('venue');
                var acts_wrapper = $('.actions-wrapper');


                if(l > 2){

                    $('.mb-center-search-hint').html('<i class="fa fa-search"></i>&nbsp;&nbsp;Ищем...');

                    var o = {
                        command: 'get_afisha',
                        params: {
                            url: gurl,
                            venue_id: venue_id,
                            search_keyword: v
                        }
                    };

                    socketQuery_site(o, function(res){

                        if(!JSON.parse(res)['results'][0].code || JSON.parse(res)['results'][0].code == 0){

                            $('.mb-center-search-hint').html('Нашли =)');

                            var actions = jsonToObj(JSON.parse(res)['results'][0]);

                            var act_m_tpl = '{{#actions}}<div class="mb-block mb-action" data-id="{{ACTION_ID}}"><a href="/{{alias_link}}/">'+
                                '<div class="mb-action-image-holder"><img src="{{ACTION_POSTER_IMAGE}}"></div>'+
                                '<div class="mb-a-title">{{ACTION_NAME}}<span class="mb-a-age">{{AGE_CATEGORY}}</span></div>'+
                                '<div class="mb-a-date">{{ACTION_DATE_STR}}, <span class="mb-a-time">{{ACTION_TIME_STR}}</span></div>'+
                                '<div class="mb-a-venue">{{VENUE_NAME}}</div>'+
                                '<div class="mb-a-prices-and-buy"><div class="ma-a-prices">от&nbsp;{{MIN_PRICE}}&nbsp;<i class="fa fa-ruble"></i></div><div class="ma-a-buy">Купить билет</div></div>'+
                                '</a></div>{{/actions}}';



                            var a_data = {actions: []};

                            for(var i in actions){
                                actions[i]['ACTION_POSTER_IMAGE'] = (actions[i]['ACTION_POSTER_IMAGE'] == '')? defaultPoster : actions[i]['ACTION_POSTER_IMAGE'];
                                actions[i]['is_show'] = actions[i]['SHOW_ID'] != '';
                                actions[i]['alias_link'] = (actions[i]['SHOW_URL_ALIAS'] != '')? actions[i]['SHOW_URL_ALIAS'] : actions[i]['ACTION_URL_ALIAS'];
                                actions[i]['price_range'] = (actions[i]['MIN_PRICE'] && actions[i]['MAX_PRICE'])? (actions[i]['MIN_PRICE'] == actions[i]['MAX_PRICE'])? 'по ' + actions[i]['MIN_PRICE'] + ' руб.' : actions[i]['MIN_PRICE'] + ' - ' + actions[i]['MAX_PRICE'] + ' руб.' : '';

                                a_data.actions.push(actions[i]);
                            }

                            if(a_data.actions.length == 0){

                                $('.mb-center-search-hint').html('Не нашли =(');

                                acts_wrapper.html('<div class="nothing-to-show">Ничего не нашлось, попробуйте дргой запрос или посмотрите в <a href="/afisha/">афише.</a></div>');

                            }else{

                                acts_wrapper.html(Mustache.to_html(act_m_tpl, a_data));

                                if(a_data.actions.length <= 15){

                                }

                            }


                        }else{

                            $('.mb-center-search-hint').html('Простите, кажется поиск сломался. +7 (906) 063-88-66');

                        }

                    });



                }else{

                    $('.mb-center-search-hint').html('Введите еще '+ more +' '+ getNoun(more, "симовол", "симовола", "симоволов") + ' и начнем поиск.');



                }

                if(l == 0){
                    $('.mb-center-search-hint').html('Введите 3 символа и начнем поиск');



                        var o = {
                            command: 'get_afisha',
                            params: {
                                url: gurl,
                                venue_id: venue_id,
                                page_no: 1,
                                rows_max_num:15
                            }
                        };

                        socketQuery_site(o, function(res){

                            if(!JSON.parse(res)['results'][0].code || JSON.parse(res)['results'][0].code == 0){

                                var actions = jsonToObj(JSON.parse(res)['results'][0]);

                                var act_m_tpl = '{{#actions}}<div class="mb-block mb-action" data-id="{{ACTION_ID}}"><a href="/{{alias_link}}/">'+
                                    '<div class="mb-action-image-holder"><img src="{{ACTION_POSTER_IMAGE}}"></div>'+
                                    '<div class="mb-a-title">{{ACTION_NAME}}<span class="mb-a-age">{{AGE_CATEGORY}}</span></div>'+
                                    '<div class="mb-a-date">{{ACTION_DATE_STR}}, <span class="mb-a-time">{{ACTION_TIME_STR}}</span></div>'+
                                    '<div class="mb-a-venue">{{VENUE_NAME}}</div>'+
                                    '<div class="mb-a-prices-and-buy"><div class="ma-a-prices">от&nbsp;{{MIN_PRICE}}&nbsp;<i class="fa fa-ruble"></i></div><div class="ma-a-buy">Купить билет</div></div>'+
                                    '</a></div>{{/actions}}';



                                var a_data = {actions: []};

                                for(var i in actions){
                                    actions[i]['ACTION_POSTER_IMAGE'] = (actions[i]['ACTION_POSTER_IMAGE'] == '')? defaultPoster : actions[i]['ACTION_POSTER_IMAGE'];
                                    actions[i]['is_show'] = actions[i]['SHOW_ID'] != '';
                                    actions[i]['alias_link'] = (actions[i]['SHOW_URL_ALIAS'] != '')? actions[i]['SHOW_URL_ALIAS'] : actions[i]['ACTION_URL_ALIAS'];
                                    actions[i]['price_range'] = (actions[i]['MIN_PRICE'] && actions[i]['MAX_PRICE'])? (actions[i]['MIN_PRICE'] == actions[i]['MAX_PRICE'])? 'по ' + actions[i]['MIN_PRICE'] + ' руб.' : actions[i]['MIN_PRICE'] + ' - ' + actions[i]['MAX_PRICE'] + ' руб.' : '';

                                    a_data.actions.push(actions[i]);
                                }

                                if(a_data.actions.length == 0){

                                    acts_wrapper.html('<div class="nothing-to-show">Ничего не нашлось, попробуйте дргой запрос или посмотрите в <a href="/afisha/">афише.</a></div>');

                                }else{

                                    acts_wrapper.html(Mustache.to_html(act_m_tpl, a_data));

                                }


                            }else{

                                $('.mb-center-search-hint').html('Простите, кажется поиск сломался. +7 (906) 063-88-66');

                            }

                        });


                }

            });



            uiTabs();

        },
        initExtendFilters: function(){

            var blocks = $('.mb-tf-block');

            blocks.each(function(i,elem){
                var f = new Filter({
                    wrapper: $(elem)
                });

            });
        },
        initSearch: function(){



//            var loadingHtml =       '<div class="ms-loading"><i class="fa fa-search"></i>&nbsp;&nbsp;Идет поиск&hellip;</div>';
//            var emptyHtml =         '<div class="ms-loading">Поискали &ndash; не нашли, попробуйте другой запрос.</div>';
//            var clearHtml =         '<div class="ms-loading">Введите поисковый запрос.</div>';
//            var errorHtml =         '<div class="ms-loading">Простите, но кажется с поиском что-то не так&hellip;<br/>Звоните:&nbsp;&nbsp;&nbsp;+7 (906) 063-88-66</div>';

            var ven_empty = '<div class="ms-loading">Площадок не найдено.</div>';
            var act_empty = '<div class="ms-loading">Актеров не найдено.</div>';

            var search =            $('.main-search');
            var search_clear =      $('.main-search-input-clear');
            var search_dd =         $('.main-search-dd');
            var acts_wrapper =      $('.ms-actions-wrapper');
            var venues_wrapper =      $('.ms-venues-wrapper');
            var actors_wrapper =      $('.ms-actors-wrapper');
            var main_datepicker =   $('.main-search-daterange');
            var s_from_date =       $('.mb-tf-ms-from-date');
            var s_to_date =         $('.mb-tf-ms-to-date');
            var s_min_price =      $('.main-search-dd .mb-tf-rs-from');
            var s_max_price =        $('.main-search-dd .mb-tf-rs-to');
            var ms_slider =         $('.mb-ms-rangeslider');

            var ms_clear =          $('.main-search-clear');
            var ms_close =          $('.main-search-close');

            ms_clear.off('click').on('click', function(){
                search.val('');
                main_datepicker.datepicker('update', '');
                s_from_date.datepicker('update', '');
                s_to_date.datepicker('update', '');
                s_min_price.val('');
                s_max_price.val('');

                runQuery(function(){
                    acts_wrapper.html(clearHtml);
                });


            });

            ms_close.off('click').on('click', function(){
                search_dd.hide(0);
            });


            function runQuery(cb){

                var search_keyword = search.val();
                var from_date =     s_from_date.val();
                var to_date =       s_to_date.val();
                var min_price =    s_min_price.val();
                var max_price =      s_max_price.val();

                acts_wrapper.html(loadingHtml);
                venues_wrapper.html(loadingHtml);
                actors_wrapper.html(loadingHtml);

                var o = {
                    command: 'site_search2',
                    params: {
                        url: gurl
                    }
                };

                o.params.search_keyword = search_keyword;
                o.params.from_date = from_date;
                o.params.to_date = to_date;
                o.params.min_price = (isNaN(+min_price))? '' : min_price;
                o.params.max_price = (isNaN(+max_price))? '' : max_price;

                socketQuery_site(o, function(res){

                    if(!JSON.parse(res)['results'][0].code || JSON.parse(res)['results'][0].code == 0){

                        var actions = jsonToObj(JSON.parse(res)['results'][0]['ACTION'][0]);
                        var venues = jsonToObj(JSON.parse(res)['results'][0]['VENUE'][0]);
                        var actors = jsonToObj(JSON.parse(res)['results'][0]['ACTOR'][0]);

                        console.log('actions', actions);

                        var act_m_tpl = '{{#actions}}<a href="/{{alias_link}}"><div class="mb-me-action" data-id="{{ACTION_ID}}">'+
                            '<div class="mb-me-a-image" style="background-image: url(\'{{ACTION_POSTER_IMAGE}}\');"></div>'+
                            '<div class="mb-me-a-title">{{ACTION_NAME}}</div>'+
                            '<div class="mb-me-a-venue">{{VENUE_NAME}}</div>'+
                            '<div class="mb-me-a-price">{{price_range}}</div>'+
                            '<div class="mb-me-a-age">{{AGE_CATEGORY}}</div>'+
                            '<div class="mb-me-a-date">{{#is_show}}с {{/is_show}}{{ACTION_DATE_STR}}, <span class="mb-a-time">{{ACTION_TIME_STR}}</span></div>'+
                            '</div></a>{{/actions}}';

                        var ven_tpl = '{{#venues}}<a href="/{{VENUE_URL_ALIAS}}"><div class="mb-sub-entry" data-id="{{OBJ_ID}}">' +
                            '<div class="mb-sub-entry-image" style="background-image: url(\'{{VENUE_URL_IMAGE_MEDIUM}}\');"></div>'+
                            '<div class="mb-sub-entry-title">{{VENUE_NAME}}</div>'+
                            '</div></a> {{/venues}}';

                        var actor_tpl = '{{#actors}}<a href="/{{ACTOR_URL_ALIAS}}"><div class="mb-sub-entry" data-id="{{OBJ_ID}}">' +
                            '<div class="mb-sub-entry-image" style="background-image: url(\'{{URL_IMAGE_MEDIUM}}\');"></div>'+
                            '<div class="mb-sub-entry-title">{{ACTOR_NAME}}</div>'+
                            '</div></a> {{/actors}}';


                        var a_data = {actions: []};
                        var v_data = {venues: []};
                        var actors_data = {actors: []};


                        for(var i in actions){
                            actions[i]['ACTION_POSTER_IMAGE'] = (actions[i]['ACTION_POSTER_IMAGE'] == '')? defaultPoster : actions[i]['ACTION_POSTER_IMAGE'];
                            actions[i]['is_show'] = actions[i]['SHOW_ID'] != '';
                            actions[i]['alias_link'] = (actions[i]['SHOW_ID'] != '')? actions[i]['SHOW_URL_ALIAS'] : actions[i]['ACTION_URL_ALIAS'];
                            actions[i]['price_range'] = (actions[i]['MIN_PRICE'] && actions[i]['MAX_PRICE'])? (actions[i]['MIN_PRICE'] == actions[i]['MAX_PRICE'])? 'по ' + actions[i]['MIN_PRICE'] + ' руб.' : actions[i]['MIN_PRICE'] + ' - ' + actions[i]['MAX_PRICE'] + ' руб.' : '';

                            a_data.actions.push(actions[i]);
                        }

                        for(var k in venues){
                            v_data.venues.push(venues[k]);
                        }

                        for(var j in actors){
                            actors_data.actors.push(actors[j]);
                        }


                        if(a_data.actions.length == 0){
                            acts_wrapper.html(emptyHtml);
                        }else{
                            acts_wrapper.html(Mustache.to_html(act_m_tpl, a_data));
                        }

                        if(v_data.venues.length == 0){
                            venues_wrapper.html(ven_empty);
                        }else{
                            venues_wrapper.html(Mustache.to_html(ven_tpl, v_data));
                        }

                        if(actors_data.actors.length == 0){
                            actors_wrapper.html(act_empty);
                        }else{
                            actors_wrapper.html(Mustache.to_html(actor_tpl, actors_data));
                        }

                        if(cb && typeof cb == 'function'){
                            inQuery = false;
                            cb();
                        }

                    }else{
                        acts_wrapper.html(errorHtml);
                        inQuery = false;
                    }
                });





            }


            $('.main-search-daterange-clear').off('click').on('click', function(){
                main_datepicker.val('');
            });

            search_clear.off('click').on('click', function(){
                search.val('');
                search.trigger('input');
            });


            s_from_date.datepicker({
                language: 'ru',
                autoclose: true,
                startDate: today,
                todayBtn: 'linked'
            }).off('changeDate').on('changeDate', function(e){
                var datePicked = e.format('dd.mm.yyyy');

                main_datepicker.datepicker('update', datePicked);

                runQuery(function(){});
            });

            s_to_date.datepicker({
                language: 'ru',
                autoclose: true,
                startDate: today,
                todayBtn: 'linked'
            }).off('changeDate').on('changeDate', function(e){
                var datePicked = e.format('dd.mm.yyyy');


                runQuery(function(){});
            });

            main_datepicker.datepicker({
                language: 'ru',
                autoclose: true,
                startDate: today,
                todayBtn: 'linked'
            }).off('changeDate').on('changeDate', function(e){
                var datePicked = e.format('dd.mm.yyyy');
                search_dd.show(0);
                s_from_date.datepicker('update', datePicked);

//                if(s_to_date.val().length == 0){
//                    s_to_date.datepicker('update', datePicked);
//                }


                runQuery(function(){});

            });

            search.off('focus').on('focus', function(){
                if($(this).val().length > 1  &&  search_dd.css('display') == 'none'){
                    search_dd.show(0);
                }
            });


            var t1 = window.setTimeout(function(){}, 200);

            search.off('input').on('input', function(){

                var val = $(this).val();

                if(val.length > 1){

                    search_dd.show(0);

                    if(typeof t1 == 'number'){

                        clearTimeout(t1);

                        t1 = window.setTimeout(function(){
                            console.log(search.val());

                            runQuery(function(){

                            });

                        }, 300);

                    }

                }else if(val.length == 0){
                    search_dd.hide(0);
                }
            });

            ms_slider.ionRangeSlider({
                type: "double",
                grid: true,
                from: 0,
                to: 7,
                values: [0, 300, 1000, 2000, 3000, 5000, 10000, '<'],
                onChange: function (data) {
                    var from_inp = ms_slider.next().find('.mb-tf-rs-from');
                    var to_inp = ms_slider.next().find('.mb-tf-rs-to');
                    from_inp.val(data.from_value);
                    to_inp.val(data.to_value);


                    runQuery(function(){});
                }
            });
        },
        initDateActions: function(){
//            var blocks = $('.mb-nrs-body');
//
//            blocks.each(function(i,elem){
//                var dateType = $(elem).attr('data-date');
//
//                var o = {
//                    command: 'get_actions',
//                    params: {
//                        url: gurl
//                    }
//                };
//
//                switch (dateType){
//                    case 'today':
//                        o.params.from_date = '';
//                        o.params.to_date = '';
//                        break;
//                    case 'tomorrow':
//                        o.params.from_date = '';
//                        o.params.to_date = '';
//                        break;
//                    case 'weekend':
//                        o.params.from_date = '';
//                        o.params.to_date = '';
//                        break;
//                    case 'nextweek':
//                        o.params.from_date = '';
//                        o.params.to_date = '';
//                        break;
//                    default :
//                        console.warn('init nrs block without date type');
//                        return false;
//                        break;
//                }

//            });
        },
        initSlider: function(){
            var vagons = $('.slider-item-vagon');
            var train = $('.slider-train');
            var interval = 6500;
            var rev_opened = false;
            var dots = $('.slider-dot');

            var blur_idx = 0;

            var toSet;
            var cur_slide;
            var tmo;

            function runSlide(toSet, cur_slide){
                train.animate({
                    marginLeft: - toSet + '%'
                }, 500, function(){
                    train.attr('data-move', toSet);

                    $('.slider-dot').removeClass('active');
                    $('.slider-dot[data-slide="'+cur_slide+'"').addClass('active');
                });
            }

            function runSlider(){

                tmo = window.setInterval(function(){

                    if(rev_opened){
                        return;
                    }

                    toSet = (Math.abs(+(train.attr('data-max'))) == Math.abs(+(train.attr('data-move'))) + 100)? 0 :  Math.abs(+(train.attr('data-move'))) + 100;
                    cur_slide = toSet / 100;

                    runSlide(toSet, cur_slide);



                }, interval);

            }

            runSlider();


            vagons.each(function(i, elem){
                var vag = $(elem);
                var rev_dd = vag.find('.slide-reviews-expanded');
                var rev_prev = vag.find('.sa-reviews-wrapper').find('li');
                var rev_close = vag.find('.sl-reviews-exp-close');

                rev_prev.off('click').on('click', function(){
                    if(!rev_dd.hasClass('opened')){
                        rev_dd.addClass('opened');
                        rev_opened = true;
                    }
                });

                rev_close.off('click').on('click', function(){
                    rev_dd.removeClass('opened');
                    rev_opened = false;
                });

            });

            dots.each(function(i,elem){
                var dot = $(elem);

                dot.off('click').on('click', function(){

                    if(dot.hasClass('active')){
                        return;
                    }

                    clearInterval(tmo);
                    var idx = dot.attr('data-slide');


                    var innerToSet = (idx * 100);

                    runSlide(innerToSet, idx);
//                    train.attr('data-move', (idx * 100) - 100);
                    runSlider();

                });
            });
        },
        initScroll: function(){
            $(document).on('scroll', function(e){
                var start = 100;
                var sctop = $(document).scrollTop();

                if(sctop >= start){
                    $('body').addClass('scrolled');
                }else{
                    $('body').removeClass('scrolled');
                }

            });
        },
        initInPageSearch: function(){
            var sInp = $('.mb-inpage-search');
            var entries = $('.mb-inpage-search-entry');

            sInp.off('input').on('input', function(){
                var val = $(this).val();

                entries.show(0);

                if(val.length > 1){
                    entries.each(function(i,elem){
                        var ent = $(elem);
                        var title = ent.find('.mb-inpage-search-entry-keyword').text().toLowerCase();
                        if(title.indexOf(val.toLowerCase()) == -1){
                            ent.hide(0);
                        }else{
                            ent.show(0);
                        }
                    });

                }else{

                }
            });
        },
        initContest: function(){
            return false;
            var contestHolder = $('.contest-holder');
            var timerHolder = $('.contest-fast-timer');
            // FAST CONTEST
            (function(){

                var s = '';
                function runTimer(startTime, timeAgo){

                    var delta = moment() - startTime;
                    var totalDelta = timeAgo + delta;
                    var s2 = moment(totalDelta).format('mm:ss:SS');
                    if (s!== s2){
                        s = s2;
                        timerHolder.html('<span class="contest-fast-timer-time">' + s + '</span>');
                    }
                }

                $('.contest-fast-open-rules').off('click').on('click', function(){

                    $('html, body').animate({
                        scrollTop: $('.contest-fast-rules').offset().top + 'px'
                    }, 350, function(){

                    });

                });

                $('.contest-fast-close').off('click').on('click', function(){

                    localStorage.setItem('mb-fast-reject', 'REJECT');
                    contestHolder.hide(0);
                });

                $('.contest-fast-reject').off('click').on('click', function(){

                    localStorage.setItem('mb-fast-reject', 'REJECT');
                    contestHolder.hide(0);
                });

                $('.contest-fast-go').off('click').on('click', function(){
                    var self = this;
                    contestHolder.hide(0);

                    if(localStorage){

                        if(localStorage.getItem('mb-fast-contest') == null){

                            var starto = {
                                command: 'start_create_order'
                            };

                            socketQuery_b2e(starto, function(res){

                                var jRes = JSON.parse(res);

                                if(jRes.results[0].code == 0){

                                    var session_id = jRes.results[0].session_id;


                                    var o = {
                                        start: new Date(),
                                        sid: session_id,
                                        device: navigator.userAgent
                                    };

                                    localStorage.setItem('mb-fast-contest', JSON.stringify(o));

                                    if($(self).parents('.contest-fast-timer-rate').length > 0){
                                        document.location.href = '/';
                                        return;
                                    }



                                    contestData = o;

                                    var startTime = moment();
                                    var timeAgo = startTime - moment(contestData.start);
                                    setInterval(function(){
                                        runTimer(startTime ,timeAgo);
                                    },1);

                                    if($(self).parents('.contest-page-footer').length > 0){
                                        document.location.href = '/';
                                    }

                                    $('html, body').animate({
                                        scrollTop: 0
                                    }, 250);
                                }else{
                                    toastr['error']('Ошибка сервера');
                                }

                            });

                        }else{

                        }
                    }
                });

                if(!!localStorage){

                    var contestData = localStorage.getItem('mb-fast-contest');

                    if(localStorage.getItem('mb-fast-contest') != null){

                        $('.contest-page-footer .contest-fast-go').hide(0);

                        contestData = JSON.parse(contestData);

                        var startTime = moment();
                        var timeAgo = startTime - moment(contestData.start);
                        setInterval(function(){
                            runTimer(startTime ,timeAgo);
                        },1);

                        $('.contest-fast-full-rules').show(0);

                    }else{

                        if(localStorage.getItem('mb-fast-reject') != null || localStorage.getItem('mb-fast-contest-finished') != null){

                            if(localStorage.getItem('mb-fast-reject') != null && localStorage.getItem('mb-fast-reject') == 'REJECT'){
                                $('.contest-page-footer .contest-fast-go').show(0);
                                return;
                            }

                            if(localStorage.getItem('mb-fast-contest-finished') != null && localStorage.getItem('mb-fast-contest-finished') == 'TRUE'){

                                if(document.location.href.indexOf('success') == -1){
                                    contestHolder.find('.contest-fast-wrapper h3').html('Попробуете еще раз?').show(0);
                                    $('.contest-page-footer .contest-fast-go').show(0);
                                }
                            }
                        }

                        if(document.location.href.indexOf('success') == -1 && document.location.href.indexOf('contest-fast') == -1){
                            contestHolder.show(0);
                        }

                        $('.contest-page-footer .contest-fast-go').show(0);
                    }
                }

                var resultsTable = $('table.contest-fast-results');
                var trs = resultsTable.find('tbody tr');

                $('.find-contest-result-input').off('input').on('input', function(){

                    trs.show(0);

                    var val = $(this).val();

                    trs.each(function(i, elem){
                        var tr = $(elem);

                        if(tr.attr('data-order').indexOf(val) == -1){
                            tr.hide(100);
                        }

                    });

                });

                $('.contest-fast-full-rules').off('click').on('click', function(){

                    if(!!localStorage){
                        localStorage.removeItem('mb-fast-reject');
                        localStorage.removeItem('mb-fast-contest');
                        localStorage.removeItem('mb-fast-contest-finished');
                        localStorage.removeItem('mb-fast-contest-finished-result');

                        document.location.href = '/';
                    }

                });

            }());

        },
        initReviews: function(){

            var rating_changed = false;

            $('.wr-review-rating').ionRangeSlider({
                type: "single",
                grid: true,
                min: 0,
                max: 10,
                from:5,
                step:0.1,
                onChange: function (data) {
                    rating_changed = true;
                    $('.wr-review-rating-value').html(data.from.toFixed(1));
                }
            });


            $('.wr-confirm').off('click').on('click', function(){

                var text = $('.wr-review-text').val();
                var o;

                if(text.length > 0){

                    o = {
                        command: 'add_action_review',
                        object: 'asd',
                        params:{
                            text: text
                        }
                    };

                    if(rating_changed){
                        o.params.rating = parseFloat($('.wr-review-rating-value').html());
                    }
                    
                    console.log(o);
                    
                    socketQuery_b2e(o, function(r){

                    });

                }else{

                    if(rating_changed){

                        o = {
                            command: 'add_action_review',
                            object: 'asd',
                            params:{
                                text: text,
                                rating: parseFloat($('.wr-review-rating-value').html())
                            }
                        };

                        console.log(o);

                        socketQuery_b2e(o, function(r){

                        });

                    }else{

                        $('.wr-error-holder').html('Вы ничего не написали, какой в этом смысл?');

                        window.setTimeout(function(){

                            $('.wr-error-holder').html('');

                        }, 6000);
                    }
                }
            });
        },
        loader: function(state, text){

            var fader = $('.mbw-loader-holder');
            var textHolder = $('.mbw-loader-text');

            if(state){
                textHolder.html(text);
                fader.show(0);
            }else{
                fader.hide(0);
            }

        }

    };

    $(document).ready(function(){

        parseUrl();

        fs.initComponents();
        fs.initExtendFilters();
        fs.initSearch();
        fs.initSlider();
        fs.initScroll();
        fs.initInPageSearch();
        fs.initContest();
        fs.initReviews();

    });


//    function setRow(num){
//        var m = MB.User.mapEditor_map;
//        var s = m.selection;
//
//        var o = {
//            command: 'operation',
//            object: 'modify_hall_scheme_item',
//            params: {
//
//            }
//        };
//
//
//        var ids = [];
//        var lines = [];
//
//        for(var i in s){
////            var sq = m.squares[s[i]];
//            ids.push(s[i]);
//            lines.push(num);
//        }
//
//        o.params.hall_scheme_item_id = ids.join('|!|');
//        o.params.line = lines.join('|!|');
//
//
//        console.log(o);
//
//        socketQuery(o, function(res){
//            console.log(res);
//        });
//    }
//
//    setRow(4);



}());
