    var lastScTop = 0;

    var Filters = function(){
        this.items = [];
        this.merged = [];
        this.currentFilter = undefined;
    };

    Filters.prototype.getItem = function(id){
        var _t = this;
        for(var i in _t.items){
            if(_t.items[i].id == id){
                return _t.items[i];
            }
        }
        return false;
    };

    Filters.prototype.getItemByNameValue = function(name, value){
        var _t = this;
        for(var i in _t.items){
            if(_t.items[i].name == name){
                for(var j in _t.items[i].value){
                    if(_t.items[i].value[j] == value){
                        return _t.items[i];
                    }
                }
            }
        }
        return false;
    };

    Filters.prototype.addItem = function(item){
        var _t = this;
        _t.items.push(item);
    };

    Filters.prototype.removeItem = function(name, pointId){
        var _t = this;

        if(!pointId){
            for(var i in _t.items){
                if(_t.items[i].name == name){
                    delete _t.items[i];
                }
            }
            clearEmpty(_t.items);
        }else{
            for(var i in _t.items){
                if(_t.items[i].name == name && _t.items[i].value[0] == pointId){
                    delete _t.items[i];
                }
            }
            clearEmpty(_t.items);
        }

        window.setTimeout(function(){
            _t.createWhereString();
        }, 300);
    };

    Filters.prototype.setToUrl = function(){
        var _t = this;

        var str = '';
        for(var i in _t.currentFilter){
            var f = _t.currentFilter[i];
            str += i + '=';
            for(var k in f){
                if(k == 0){
                    str += f[k];
                }else{
                    str += ','+f[k];
                }
            }
            str += '&';
        }
        str = str.split('');
        str.pop();
        str = str.join('');

        document.location.hash = str;
    };

    Filters.prototype.getFromUrl = function(){
        var _t = this;
        var urlStr = document.location.hash.substr(1);
        var resObj = {};
        if(urlStr.length > 0){
            var arr1 = urlStr.split('&');
            for(var i in arr1){
                var item = arr1[i];
                var arr2 = item.split('=');
                resObj[arr2[0]] = arr2[1];
            }

            return resObj;
        }else{
            return {};
        }

    };

    Filters.prototype.mergeSingleValueFilters = function(){
        var _t = this;
        _t.merged = [];
        var merged = [];

        for(var i in _t.items){
            var f = _t.items[i];
            var found = false;

            for(var k in merged){
                var m = merged[k];

                if(f.id == m.id){
//                    if(m.value.indexOf(f.value[0]) == -1){
                        m.value = f.value;
//                    }
                    found = true;
                }
            }

            if(!found){
                merged.push(f);
            }
        }

        _t.merged = merged;
    };

    Filters.prototype.createWhereString = function(){
        var _t = this;
        var result = {};

        for (var i in _t.items) {
            var fitem = _t.items[i];

            if(result[fitem.name]){
                if(fitem.type == 'date'){
                    result[fitem.name] = fitem.value;
                }else{
                    result[fitem.name] = result[fitem.name].concat(fitem.value);
                }
            }else{
                result[fitem.name] = fitem.value;
            }
        }

        _t.currentFilter = result;
        _t.setToUrl();
        _t.confirmFilters();
    };

    Filters.prototype.confirmFilters = function(){
        var _t = this;
        var urlFilters = _t.getFromUrl();
        $('body').scrollTop(lastScTop);
        mib.getActions(urlFilters, function(){
            mib.populateAfisha(mib.actions, a_wrap);
            $('body').scrollTop(lastScTop);
        });
    };

    Filters.prototype.populateFromUrl = function(){
        var _t = this;
        var urlFilters = _t.getFromUrl();
        var filtersLength = 0;

        for(var l in urlFilters){
            filtersLength++;
        }

        if(filtersLength == 0){
            filters.confirmFilters();
        }else{

            for(var i in urlFilters){
                var f = urlFilters[i];
                var fId = getGuid();
                var profile = widgets.getProfileByPk(i);
                var fVal = f.split(',');
                for(var j in fVal){
                    var finst = new Filter({
                        id: fId,
                        name: profile.filterName,
                        type: profile.filterType,
                        value: [fVal[j]]
                    });
                }
            }

            if(urlFilters.from_date && urlFilters.to_date){
                var nearMenuDatesObj = {
                    today: {
                        from: moment().format('DD.MM.YYYY'),
                        to: moment().format('DD.MM.YYYY')
                    },
                    tomorrow: {
                        from: moment().add(1, 'days').format('DD.MM.YYYY'),
                        to: moment().add(1, 'days').format('DD.MM.YYYY')
                    },
                    weekend: {
                        from: moment().weekday(6).format('DD.MM.YYYY'),
                        to: moment().weekday(7).format('DD.MM.YYYY')
                    },
                    nextweek: {
                        from: moment().add(1, 'week').weekday(1).format('DD.MM.YYYY'),
                        to: moment().add(1, 'week').weekday(7).format('DD.MM.YYYY')
                    }
                };



                for(var j = 0; j < $('.nearrest-menu-wrapper li').length; j++){
                    var nmi = $('.nearrest-menu-wrapper li').eq(j);
                    var nmiFrom = nmi.data('value1');
                    var nmiTo = nmi.data('value2');

                    if(urlFilters.from_date == nearMenuDatesObj[nmiFrom].from && urlFilters.to_date == nearMenuDatesObj[nmiTo].to){
                        nmi.addClass('active');
                    }
                }
            }



            for(var k in _t.items){
                var item = _t.items[k];
                var itemProf = widgets.getProfileByPk(item.name);
                var parentElem = $('.widget-wrapper-init-wrapper[data-widget="'+itemProf.widgetName+'"]');
                var itemIds = item.value[0].split(',');

                if(item.name == 'from_date' || item.name == 'to_date'){
                    var datepickerElem = $("#datepicker");
                    var datepickerInputElem = $("#datepicker-value");
                    datepickerElem.datepicker('update', itemIds[0]);
                    datepickerInputElem.val(itemIds[0]);
                    datepickerValue = itemIds[0];

                }else{
                    for(var v in itemIds){
                        var childElem = parentElem.find('.widget-list-item-wrapper[data-id="'+itemIds[v]+'"]');
                        childElem.addClass('selected');
                    }

                    for(var g = 0; g < $('.genre-menu-wrapper li').length; g++){
                        var gmi = $('.genre-menu-wrapper li').eq(g);
                        var gmiVal = gmi.data('value1');

                        if(itemIds[0] == gmiVal){
                            gmi.addClass('active');
                        }
                    }

                }
            }
        }


    };

    Filters.prototype.removeFiltersByName = function(name){
        var _t = this;
        for(var i in _t.items){
            var item = _t.items[i];
            if(item.name == name){
                delete _t.items[i];
            }
        }

        clearEmpty(_t.items);
    };

    Filters.prototype.clear = function(){
        var _t = this;
        _t.items = [];

        $('.widget-list-item-wrapper').removeClass('selected');
        $('.genre-menu-wrapper li').removeClass('active');
        $('.nearrest-menu-wrapper li').removeClass('active');
        $("#datepicker").datepicker('update', '');

        _t.createWhereString();
    };

    var filters = new Filters();

    var Filter = function(data){
        this.id =           data.id;
        this.name =         data.name;
        this.type =         data.type;
        this.value =        data.value;

        filters.addItem(this);
        window.setTimeout(function(){
            filters.createWhereString();
        }, 300);

        return this;
    };


    var Widgets = function(){
        this.items = [];
        this.config = {
            genre: {
                widgetName:     'genre',
                command:        'get_genre',
                object:         '',
                primaryKey:     'SHOW_GENRE_ID',
                nameField:      'SHOW_GENRE',
                countField:     'ACTIONS_COUNT',
                titleRu:        'Жанр',
                filterName:     'SHOW_GENRE_ID',
                filterType:     'text'
            },
            venue: {
                widgetName:     'venue',
                command:        'get_venue',
                object:         '',
                primaryKey:     'VENUE_ID',
                nameField:      'VENUE_NAME',
                countField:     'ACTIONS_COUNT',
                titleRu:        'Площадка',
                filterName:     'VENUE_ID',
                filterType:     'text'
            },
            from_date: {
                widgetName:     'from_date',
                command:        '',
                object:         '',
                primaryKey:     'from_date',
                nameField:      '',
                countField:     '',
                titleRu:        'Дата с',
                filterName:     'from_date',
                filterType:     'date'
            },
            to_date: {
                widgetName:     'to_date',
                command:        '',
                object:         '',
                primaryKey:     'to_date',
                nameField:      '',
                countField:     '',
                titleRu:        'Дата по',
                filterName:     'to_date',
                filterType:     'date'
            }
        };
        this.filters = [];
    };

    Widgets.prototype.addItem = function(item){
        var _t = this;
        _t.items.push(item);
    };

    Widgets.prototype.removeItem = function(id){
        var _t = this;
        for(var i in _t.items){
            var item = _t.items[i];
            if(item.id == id){
                _t.items.splice(i,1);
            }
        }
    };

    Widgets.prototype.getItem = function(id){
        var _t = this;
        for(var i in _t.items){
            var item = _t.items[i];
            if(item.id == id){
                return item;
            }
        }
    };

    Widgets.prototype.populateFilters = function(){
        var _t = this;

        var tpl = '{{#items}}<div class="afisha-filters-item" data-id="{{id}}" data-selected="{{selected}}">{{titleRu}}: {{titles}}<div class="afisha-filters-item-remove"></div></div>{{/items}}';

        var mO = {
            items: []
        };

        for(var i in _t.filters){
            var f = _t.filters[i];
            var clone = cloneObj(f);

            var tmpTitles = [];
            for(var ti in clone.titles){
                tmpTitles.push(clone.titles[ti]);
            }

            var tmpSelected = [];
            for(var se in clone.selected){
                tmpSelected.push(clone.selected[se]);
            }

            clone.titles = tmpTitles.join(', ');
            clone.selected = tmpSelected.join(',');


            mO.items.push(clone);
        }

        $('.afisha-filters-wrapper').html(Mustache.to_html(tpl, mO));

    };

    Widgets.prototype.getProfileByPk = function(pk){
        var _t = this;
        for(var i in _t.config){
            if(_t.config[i].primaryKey == pk){
                return _t.config[i];
            }
        }
    };

    var widgets = new Widgets();

    var Widget = function(data, cb){
        var newId = getGuid();
        this.id =           data.id || newId;
        this.name =         data.name;
        this.wrapper =      data.wrapper;
        this.data =         undefined;

        this.command =      widgets.config[data.name].command || 'get';
        this.object =       widgets.config[data.name].object;
        this.className =    data.className;

        this.primaryKey =   widgets.config[data.name].primaryKey;
        this.nameField =    widgets.config[data.name].nameField;
        this.countField =   widgets.config[data.name].countField;
        this.titleRu =      widgets.config[data.name].titleRu;

        var _t = this;

        _t.init(function(){
            widgets.addItem(_t);
            if(typeof cb == 'function'){
                cb(this);
            }
        });
    };

    Widget.prototype.init = function(cb){
        var _t = this;

        _t.getData(function(){
            _t.populate();
            _t.setHandlers();
            if(typeof cb == 'function'){
                cb();
            }
        });
    };

    Widget.prototype.getData = function(cb){
        var _t = this;
        var o = {
            command: _t.command,
            params: {
                url: 'mirbileta.ru'
            }
        };

        socketQuery_site(o, function(res){
            var jRes = jsonToObj(JSON.parse(res)['results'][0]);
            _t.data = jRes;
            return cb();
        });
    };

    Widget.prototype.populate = function(){
        var _t = this;

        var tpl = '<div class="widget-wrapper widget-genre-wrapper"><div class="widget-genre-list">' +
            '{{#items}}' +
            '<div class="widget-list-item-wrapper widget-genre-item-wrapper" data-id="{{'+_t.primaryKey+'}}">' +
            '<div class="widget-list-item-title">{{'+_t.nameField+'}}</div>' +
            '<div class="widget-list-item-count">{{'+_t.countField+'}}</div>' +
            '</div>' +
            '{{/items}}' +
            '</div></div>';

        var mO = {
            items: []
        };

        for(var i in _t.data){
            var item = _t.data[i];
            mO.items.push(item);
        }

        _t.wrapper.html(Mustache.to_html(tpl, mO));
    };

    Widget.prototype.setHandlers = function(){
        var _t = this;

        _t.wrapper.find('.widget-list-item-wrapper').off('click').on('click', function(){

            lastScTop = $('body').scrollTop();
            var exsistFilter = filters.getItemByNameValue(widgets.config[_t.name].filterName, $(this).data('id'));
            var fId = (exsistFilter)? exsistFilter.id : getGuid();

            if($(this).hasClass('selected')){
                $(this).removeClass('selected');

                filters.removeItem(widgets.config[_t.name].filterName, $(this).data('id'));

            }else{

                $(this).addClass('selected');

                var f = new Filter({
                    id: fId,
                    name: widgets.config[_t.name].filterName,
                    type: widgets.config[_t.name].filterType,
                    value: [$(this).data('id')]
                });
            }


        });
    };





    //------------------



    Widgets.prototype.addFilter = function(widget, id, pointId){
        var _t = this;
        var item = _t.getItem(id);
        var selected;

        for(var i in item.data){
            var it = item.data[i];
            if(it[_t.config[widget].primaryKey] == pointId){
                selected = it;
            }
        }

        var filter = {
            id: id,
            selected: [pointId],
            titles: [selected[_t.config[widget].nameField]],
            titleRu: item.titleRu
        };

        var found = false;

        for(var k in _t.filters){
            var f = _t.filters[k];
            if(f.id == filter.id){
                f.selected = f.selected.concat(filter.selected);
                f.titles = f.titles.concat(filter.titles);
                found = true;
            }
        }

        if(!found){
            _t.filters.push(filter);
        }

        _t.populateFilters();
    };

    Widgets.prototype.removeFilter = function(widget, id, pointId){
        var _t = this;

        for(var k in _t.filters){
            var f = _t.filters[k];
            if(f.id == id){
                for(var j in f.selected){
                    if(f.selected[j] == pointId){
                        f.selected.splice(j,1);
                        f.titles.splice(j,1);
                    }
                }
            }
        }

        _t.populateFilters();
    };



