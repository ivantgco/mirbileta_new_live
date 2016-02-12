
(function(){

    var defaultPoster = 'https://shop.mirbileta.ru/assets/img/medium_default_poster.png';
    var gurl = 'mirbileta.ru';
    var loadingHtml =       '<div class="ms-loading"><i class="fa fa-search"></i>&nbsp;&nbsp;Идет поиск&hellip;</div>';
    var emptyHtml =         '<div class="ms-loading">Поискали &ndash; не нашли, попробуйте другой запрос.</div>';
    var clearHtml =         '<div class="ms-loading">Введите поисковый запрос.</div>';
    var errorHtml =         '<div class="ms-loading">Простите, но кажется с поиском что-то не так&hellip;<br/>Звоните:&nbsp;&nbsp;&nbsp;+7 (906) 063-88-66</div>';
    var ven_empty = '<div class="ms-loading">Площадок не найдено.</div>';
    var act_empty = '<div class="ms-loading">Актеров не найдено.</div>';

    var act_m_tpl = '{{#actions}}<a href="/{{alias_link}}"><div class="mb-me-action" data-id="{{ACTION_ID}}">'+
        '<div class="mb-me-a-image" style="background-image: url(\'{{ACTION_POSTER_IMAGE}}\');"></div>'+
        '<div class="mb-me-a-title">{{ACTION_NAME}}<span class="mb-me-a-age">{{AGE_CATEGORY}}</span></div>'+
        '<div class="mb-me-a-venue">{{VENUE_NAME}}</div>'+
        '<div class="mb-me-a-price">{{price_range}}</div>'+
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



    var mmb = {
        initSearch: function(){
            var pageHolder =    $('#mmb-page-container');
            var toggler =       $('.mmb-search');
            var input =         $('#mmb-search-input');
            var dd =            $('.mmb-search-dd');

            var acts_wrapper =          $('.mmb-search-actions');
            var venues_wrapper =        $('.mmb-search-venues');
            var actors_wrapper =        $('.mmb-search-actors');

            toggler.off('click').on('click', function(){

                if(pageHolder.hasClass('search-opened')){

                    pageHolder.removeClass('search-opened');

                }else{

                    pageHolder.addClass('search-opened');
                    input.focus();
                }

            });

            input.off('input').on('input', function(){



                function runQuery(cb){
                    var o = {
                        command: 'site_search2',
                        params: {
                            url: gurl,
                            search_keyword: input.val()
                        }
                    };

                    socketQuery_site(o, function(res){
                        if(!JSON.parse(res)['results'][0].code || JSON.parse(res)['results'][0].code == 0){

                            var actions = jsonToObj(JSON.parse(res)['results'][0]['ACTION'][0]);
                            var venues = jsonToObj(JSON.parse(res)['results'][0]['VENUE'][0]);
                            var actors = jsonToObj(JSON.parse(res)['results'][0]['ACTOR'][0]);


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
                                cb();
                            }

                        }else{
                            acts_wrapper.html(errorHtml);
                        }
                    });
                }


                runQuery(function(){

                });

            });

        }
    };

    $(document).ready(function(){
        mmb.initSearch();

        uiTabs();
    });


}());

