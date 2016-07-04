var widgetWrapper = $("#multibooker-widget-wrapper");
var doc_root = widgetWrapper.data('host');
var host = 'https://shop.mirbileta.ru/';//'192.168.1.90';//'https://shop.mirbileta.ru/'


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

var applyDictionary = function (res) {
    var r = res.results[0];
    if (r.extra_data && r.extra_data.DICTIONARIES) {
        var dics = r.extra_data.DICTIONARIES,
            columns = {},
            indexes = {},
            data = r.data,
            t;
        for (var i in dics) {
            t = r.data_columns.indexOf(i);
            if (~t) {
                indexes[i] = t;
                columns[i] = [];
                for (var j in dics[i]) {
                    for (var k in dics[i][j]) {
                        columns[i].push(k);
                        r.data_columns.push(k);
                    }
                    break;
                }
            }
        }
        var x;
        for (i in columns) {
            for (j in columns[i])
                for (k in data) {
                    x = dics[i][data[k][indexes[i]]];
                    if (x !== undefined)
                        data[k].push(
                            x[columns[i][j]]
                        ); //да простит меня Господь
                }
        }
    }
    return res;
};

var makeQuery = function (options, callback) {
    var xml = "<query>";
    //if (options && typeof options === "object" && options.object && options.command) {
    if (options && typeof options === "object" && options.command) {
        if (options.hasOwnProperty("params")) {
            for (var key in options.params) {
                xml += "<" + key + ">" + options.params[key] + "</" + key + ">";
            }
            //delete options.params;
        }
        for (var key in options) {
            if (key == "params") continue;
            xml += "<" + key + ">" + options[key] + "</" + key + ">";
        }
        xml += "</query>";
    }
    return xml;
};


var jsonToObj = function (obj) {
    var obj_true = {};
    var objIndex = {};
    if (obj['DATA'] != undefined) {
        for (i in obj['DATA']) {
            for (var index in obj['NAMES']) {
                if (obj_true[i] == undefined) {
                    obj_true[i] = {};
                }
                obj_true[i][obj['NAMES'][index]] = obj['DATA'][i][index];
            }
        }
    }
    else if (obj['data'] != undefined) {
        for (i in obj['data']) {
            if (obj['names'] != undefined) {
                for (var index in obj['names']) {
                    if (obj_true[i] == undefined) {
                        obj_true[i] = {};
                    }
                    obj_true[i][obj['names'][index]] = obj['data'][i][index];
                }
            } else if (obj['data_columns'] != undefined) {
                for (var index in obj['data_columns']) {
                    if (obj_true[i] == undefined) {
                        obj_true[i] = {};
                    }
                    obj_true[i][obj['data_columns'][index]] = obj['data'][i][index];
                }
            }

        }
    }

    return obj_true;
};

var cloneObj = function (obj) {
    if (obj == null || typeof(obj) != 'object') {
        return obj;
    }
    var temp = {};
    for (var key in obj) {
        temp[key] = cloneObj(obj[key]);
    }
    return temp;
};

var clearEmpty = function(arr) {
    if (typeof arr!=='object') return arr;
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] === undefined) {
            arr.splice(i, 1);
            clearEmpty(arr);
        }
    }
};

var socketQuery_site = function (obj, callback) {
    var config = {
        protocol: 'https',//'http',//'https',
        ip: 'shop.mirbileta.ru'//'192.168.1.190'//'shop.mirbileta.ru'
    };

    console.log('MQ', makeQuery(obj));

    $.ajax({
        url: config.protocol + '://' + config.ip + '/cgi-bin/site?request=' + makeQuery(obj),
        method: 'GET',
        dataType: 'jsonp',
        error: function (err) {
            console.log('Не удалось подключиться к серверу');
            callback('NOT_AVALIBLE');
        },
        success: function (result) {
            result = JSON.stringify(applyDictionary(result));
//            console.log(result);
            callback(result);
            //callback(JSON.stringify(result));
        }
    });
};

var socketQuery_b2e = function (obj, callback) {
    var config = {
        protocol: 'https',//'http',//'https',
        ip: 'shop.mirbileta.ru'//'192.168.1.190'//'shop.mirbileta.ru'
    };

    console.log('MQ', makeQuery(obj));

    $.ajax({
        url: config.protocol + '://' + config.ip + '/cgi-bin/b2e?request=' + makeQuery(obj),
        method: 'GET',
        dataType: 'jsonp',
        error: function (err) {
            console.log('Не удалось подключиться к серверу');
            callback('NOT_AVALIBLE');
        },
        success: function (result) {
            result = JSON.stringify(applyDictionary(result));
            callback(result);
        }
    });
};


var socketQuery_b2c = function (obj, callback) {
    var config = {
        protocol: 'https',//'http',//'https',
        ip: 'shop.mirbileta.ru'//'192.168.1.190'//'shop.mirbileta.ru'
    };


    config = {
        protocol: 'http',//'http',//'https',
        ip: '192.168.1.190'//'192.168.1.190'//'shop.mirbileta.ru'
    };


    obj.params.sid = getCookie('site_sid');

    console.log('MQ', makeQuery(obj));

    $.ajax({
        url: config.protocol + '://' + config.ip + '/cgi-bin/b2c?request=' + makeQuery(obj),
        method: 'GET',
        dataType: 'jsonp',
        error: function (err) {
            console.log('Не удалось подключиться к серверу');
            callback('NOT_AVALIBLE');
        },
        success: function (result) {
            result = JSON.stringify(applyDictionary(result));
            callback(result);
        }
    });
};

var getGuid = function () {
    return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxxx".replace(/[xy]/g, function (c) {
        var r, v;
        r = Math.random() * 16 | 0;
        v = (c === "x" ? r : r & 0x3 | 0x8);
        return v.toString(16);
    }).toUpperCase();
};
var validator = {
    int: function(val){
        var reg = new RegExp(/^\s*[0-9]+\s*$/);
        return reg.test(val);
    },
    float: function(val){
        var reg = new RegExp(/^\s*[0-9]+[\.]?[0-9]+\s*$/);
        return reg.test(val);
    },
    time: function(val){
        var reg = new RegExp(/^\s*[0-9][0-9]\:[0-9][0-9]\s*$/);
        return reg.test(val);
    },
    date: function(val){
        var reg = new RegExp(/^\s*[0-9][0-9]\.[0-9][0-9]\.[0-9][0-9][0-9][0-9]\s*$/);
        return reg.test(val);
    },
    datetime: function(val){
        var reg = new RegExp(/^\s*[0-9][0-9]\.[0-9][0-9]\.[0-9][0-9][0-9][0-9]\s+[0-9][0-9]\:[0-9][0-9]\s*$/);
        return reg.test(val);
    }
};