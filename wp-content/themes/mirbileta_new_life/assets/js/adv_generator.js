
// Модуль для генерации объявлений яндекс директ.




var directGenerator = {
    bonuses: ['Покупка за 2 минуты!', 'Электронный билет!','Внимание, Проходит конкурс!','Поучаствуйте в конкурсе!','Возможность выйграть билеты!','Моментальная покупка!','Удобно купить!','Номинальная цена.','Хорошие места!','Лучшие места!'],
    restrictions: ['Билеты кончаются!', 'Конкурс до 14 апреля!'],
    solutions: ['{{DATE_AND_VENUE}}. Билеты от {{MIN_PRICE}} руб.','{{DATE_AND_VENUE}}.','Билеты от {{MIN_PRICE}} руб.'],
    cta: ['Кликайте!','Заходите!','Оцените сервис!'],

    replaceFrom: ['Большой Московский Цирк','Государственный Кремлевский Дворец','Современник','КОНЦЕРТ','Концерт-съемка','ШОУ','СПЕКТАКЛЬ'],
    replaceTo: ['Большой Московский Цирк','Кремль','Современник','концерт','концерт','шоу','спектакль'],

    concertTemplates: [
        '{{SHORT_NAME}} Купить билет',
        '{{SHORT_NAME}} Купить онлайн',
        '{{SHORT_NAME}} Заказ билетов',
        '{{SHORT_NAME}} Билеты онлайн',
        '{{SHORT_NAME}} Электронные билеты',
        '{{SHORT_NAME}} {{VENUE_NAME}}',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}}. {{VENUE_NAME}}',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} Купить билет',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} Билеты',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} 2016',
        '{{SHORT_NAME}} 2016',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}}'
    ],
//«
//»

    performanceTemplates: [
        '«{{SHORT_NAME}}» Купить билет',
        '«{{SHORT_NAME}}» Купить онлайн',
        '«{{SHORT_NAME}}» Купить за 2 мин!',
        '«{{SHORT_NAME}}» Билеты онлайн',
        '«{{SHORT_NAME}}» Электронные билеты',
        '«{{SHORT_NAME}}» {{VENUE_NAME}}',
        '{{SHOW_TYPE_NAME}} «{{SHORT_NAME}}» {{VENUE_NAME}}',
        '{{SHOW_TYPE_NAME}} «{{SHORT_NAME}}» Купить билет',
        '{{SHOW_TYPE_NAME}} «{{SHORT_NAME}}» Билеты',
        '{{SHOW_TYPE_NAME}} «{{SHORT_NAME}}»'
    ],
    concertKeywords: [
        '{{SHORT_NAME}} Купить билет',
        '{{SHORT_NAME}} Купить онлайн',
        '{{SHORT_NAME}} Заказ билетов',
        '{{SHORT_NAME}} Билеты онлайн',
        '{{SHORT_NAME}} Электронные билеты',
        '{{SHORT_NAME}} {{VENUE_NAME}}',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} {{VENUE_NAME}}',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} Купить билет',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} Билеты',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} 2016',
        '{{SHORT_NAME}} 2016',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}}'
    ],
    performanceKeywords: [
        '{{SHORT_NAME}} Купить билет',
        '{{SHORT_NAME}} Купить онлайн',
        '{{SHORT_NAME}} Билеты',
        '{{SHORT_NAME}} Билеты онлайн',
        '{{SHORT_NAME}} Электронные билеты',
        '{{SHORT_NAME}} {{VENUE_NAME}}',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} {{VENUE_NAME}}',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} Купить билет',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}} Билеты',
        '{{SHOW_TYPE_NAME}} {{SHORT_NAME}}'
    ],
    actions: [],
    getActions: function(cb){

        var o = {
            command: 'get_actions',
            url:'mirbileta.ru'
        };

        socketQuery_site(o, function(res){

//            jsonToObj(JSON.parse(res)['results'][0]);

            directGenerator.actions = jsonToObj(JSON.parse(res)['results'][0]);

            cb();
        });

    },
    generate: function(){

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function toFirstUpper(text){
            var fLetter = text.substr(0,1);
            var other = text.substr(1);
            return fLetter.toUpperCase() + other;
        }

        var keywords = [];
        var titles = [];
        var texts = [];

        var fullObj = [];

        for(var i in directGenerator.actions){

            var act = directGenerator.actions[i];

//            console.log(act);

            act.SHOW_TYPE_NAME =     directGenerator.replaceTo[directGenerator.replaceFrom.indexOf(act.SHOW_TYPE_NAME)];

            var tplTitleArray;
            var tplKeywordArray;

            if(act.SHOW_TYPE_NAME == 'спектакль'){

                tplTitleArray = directGenerator.performanceTemplates;
                tplKeywordArray = directGenerator.performanceKeywords;

            }else if(act.SHOW_TYPE_NAME == 'концерт'){

                tplTitleArray = directGenerator.concertTemplates;
                tplKeywordArray = directGenerator.concertKeywords;

            }else{

                tplTitleArray = directGenerator.concertTemplates;
                tplKeywordArray = directGenerator.concertKeywords;

            }


            for(var k in tplTitleArray){

                var titleTpl = tplTitleArray[k];
                var keywordTpl = tplKeywordArray[k];

                var mo = cloneObj(act);

                mo.VENUE_NAME =         directGenerator.replaceTo[directGenerator.replaceFrom.indexOf(mo.VENUE_NAME)];
                mo.DATE_AND_VENUE =     mo['ACTION_DATE_STR'] + ', ' + mo.VENUE_NAME;

                keywords.push(Mustache.to_html(keywordTpl, mo));
                titles.push(toFirstUpper(Mustache.to_html(titleTpl, mo)));

                var text = [];

                text.push(Mustache.to_html(directGenerator.solutions[getRandomInt(0,directGenerator.solutions.length -1)], mo));
                text.push(directGenerator.bonuses[getRandomInt(0,directGenerator.bonuses.length -1)]);
                text.push(directGenerator.restrictions[getRandomInt(0,directGenerator.restrictions.length -1)]);
                text.push(directGenerator.cta[getRandomInt(0,directGenerator.cta.length -1)]);


                texts.push(text.join(' '));

                fullObj.push({
                    keyword: Mustache.to_html(keywordTpl, mo),
                    title: toFirstUpper(Mustache.to_html(titleTpl, mo)),
                    text: text.join(' ')
                });

            }


        }

        directGenerator.fullData = fullObj;

//        console.log(texts);
//            console.log(keywords);
//            console.log(keywords.length);
//        document.write(res.join(','));






    },
    render: function(){
        var tpl = '{{#ads}}<div class="ad-wrapper">' +
            '<div class="ad-keywords">{{keyword}}</div>' +
            '<div class="ad-title"><b>{{title}}</b></div>' +
            '<div class="ad-block">' +
                '<div class="ad-adv">реклама</div>' +
                '<div class="ad-site">mirbileta.ru</div>' +
            '</div>' +
            '<div class="ad-text">{{text}}</div>' +
            '<div class="ad-contacts">Контактная информация: +7 (499) 391-61-97 пн-пт 10:00-20:00<br> м. Пролетарская Москва 18+</div>' +
            '</div>{{/ads}}';
        if(document.location.href.indexOf('adv') > -1){
            $('body').html(Mustache.to_html(tpl, {ads: directGenerator.fullData}));
        }


    }


};

directGenerator.getActions(function(){
    return false;
    directGenerator.generate();
    directGenerator.render();
});





