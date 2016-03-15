
// Модуль для генерации объявлений яндекс директ.


//{{ACTION_NAME_CUTTED_WITH_DATE}} купить билет
//
//{{ACTION_NAME_CUTTED}} купить билет
//
//{{ACTION_NAME_CUTTED}} билеты
//
//{{ACTION_NAME_CUTTED}} электронные билеты
//
//{{ACTION_NAME_CUTTED}} площадка
//
//концерт {{ACTION_NAME_CUTTED_WITH_DATE}} площадка билет
//
//{{ACTION_NAME_CUTTED}} площадка купить билет
//
//{{ACTION_NAME_CUTTED}} 2016
//
//концерт / спектакль / шоу {{ACTION_NAME_CUTTED}}
//
//
//концерт басты 21 апреля в кремле билеты
//
//концерт басты 21 апреля в кремле билеты



var directGenerator = {
    replaceFrom: ['Большой Московский Цирк','Государственный Кремлевский Дворец','Современник'],
    replaceTo: ['','Кремль','Современник'],
    templates: [
    '{{SHORT_NAME}} купить билет',
    '{{SHORT_NAME}} купить онлайн',
    '{{SHORT_NAME}} билеты',
    '{{SHORT_NAME}} билеты онлайн',
    '{{SHORT_NAME}} электронные билеты',
    '{{SHORT_NAME}} {{VENUE_NAME}}',
    '{{SHOW_TYPE}} {{SHORT_NAME}} {{VENUE_NAME}} купить билет',
    '{{SHOW_TYPE}} {{SHORT_NAME}} купить билет',
    '{{SHOW_TYPE}} {{SHORT_NAME}} билеты',
    '{{SHOW_TYPE}} {{SHORT_NAME}} 2016',
    '{{SHORT_NAME}} 2016',
    '{{SHOW_TYPE}} {{SHORT_NAME}}'
    ],
    actions: [],
    getActions: function(cb){

        var o = {
            command: 'get',
            object: 'actions_for_sale',
            params: {

            }
        };
        socketQuery_site(o, function(res){

            directGenerator.actions = socketParse(res);

            cb();
        });

    },
    generate: function(){

        var res = '';

        for(var i in directGenerator.actions){

            var act = directGenerator.actions[i];
            console.log(act);
            for(var k in directGenerator.templates){

                var tpl = directGenerator.templates[k];

                var mo = cloneObj(act);

                mo.VENUE_NAME = directGenerator.replaceTo[directGenerator.replaceFrom.indexOf(mo.VENUE_NAME)];

                res += Mustache.to_html(tpl, mo) + '\n';

            }

        }

//            console.log(res);

    }

};

directGenerator.getActions(function(){
    directGenerator.generate();
});





