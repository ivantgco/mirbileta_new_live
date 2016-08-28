<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 22.01.16
 * Time: 19:10
 */


$href_h = request_url();
$arr_h = parse_url($href_h);
$query_h = $arr_h['query'];

$sid = $_COOKIE["site_sid"];

//require_once 'wp-content/plugins/SocialAuther-master/lib/SocialAuther/autoload.php';


?>


<div style="display: none"><?php echo $query_h; ?></div>

<script type="text/javascript">


    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
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

    if(getCookie('mb_utm') == undefined){
        setCookie('mb_utm', '<?php echo $query_h; ?>', {path: '/'});
    }


</script>




<div class="mbw-loader-holder">
    <div class="mbw-loader-gif"></div>
    <div class="mbw-loader-text">Секундочку, сейчас все загрузим...</div>
</div>




<div class="header-holder header">

    <div class="main-search-dd">
        <div class="search-dd-wide-bg"></div>
        <div class="search-dd-wide">
            <div class="container posRel noPad sdd-holder">

                <div class="main-search-dd-arrow"></div>
                <div class="ms-actions-wrapper mb-medium-actions"></div>
                <div class="ms-venues-wrapper-holder">
                    <div class="ms-subblock-header">Площадки:</div>
                    <div class="ms-venues-wrapper chromeScroll">

                    </div>
                </div>
                <div class="ms-actors-wrapper-holder">
                    <div class="ms-subblock-header">Актеры:</div>
                    <div class="ms-actors-wrapper chromeScroll">

                    </div>
                </div>
                <div class="ms-settings-wrapper">

                    <div class="mb-tf-header">
                        <div class="mb-tf-title">Цена билета:</div>
                    </div>
                    <div class="mb-tf-body">
                        <div class="mb-ms-rangeslider"></div>
                        <div class="mb-tf-rangeslider-inputs">
                            <input class="mb-tf-rs-input mb-tf-rs-from" disabled type="text" placeholder="" value=""/>
                            &mdash;
                            <input class="mb-tf-rs-input mb-tf-rs-to" disabled type="text" placeholder="" value=""/>
                        </div>
                    </div>

                    <div class="mb-tf-header">
                        <div class="mb-tf-title">Диапазон дат:</div>
                    </div>
                    <div class="mb-tf-body">
                        <div class="taCenter">
                            <input class="mb-tf-rs-input mb-tf-ms-from-date" type="text" placeholder=""/>
                            &mdash;
                            <input class="mb-tf-rs-input mb-tf-ms-to-date" type="text" placeholder=""/>
                        </div>
                    </div>

                    <div class="mb-border-btn main-search-clear"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Сбросить</div>
                    <div class="mb-border-btn main-search-close"><i class="fa fa-times"></i>Закрыть</div>

                </div>
            </div>
        </div>
    </div>

    <div class="container posRel">


        <a href="/">
            <div class="logo-wrapper">
<!--                <div class="mb-logo-title">MIRBILETA.RU</div>-->
<!--                <div class="mb-logo-subtitle">Электронные&nbsp;билеты</div>-->
            </div>
        </a>

        <div class="search-holder">
            <div class="site-search-holder">
                <input type="text" id="site-search" class="main-search" placeholder="Поиск, универсальный"/>
                <div class="main-search-input-clear"></div>
            </div>
        </div>

        <div class="date-holder">
            <div class="date-search-holder">
                <input type="text" id="date-search" class="main-search-daterange" placeholder="ДАТА"/>
            </div>
        </div>






        <div class="advanced-search-holder">
            Расширенный поиск
        </div>


            <?php

            if(strlen($sid) > 0){

                echo '<div class="pa-holder-inline pa-account"><div class="">Кабинет</div></div>';

            }else{

                echo '<div class="pa-holder-inline pa-enter"><div class="">Войти</div></div>';

            }

            ?>


        <div class="phone-holder">
            <div class="phone-phone">
                +7 <span>(499</span>) 391-61-97
            </div>
            <div class="phone-email">
                support@mirbileta.ru
            </div>
        </div>

        <div class="posRel">


        </div>

    </div>

</div>

<div class="ext-search-holder">

    <?php include 'extend_search.php'; ?>

</div>




<div id="filters_data"></div>


<div class="pa-modal-holder">
    <div class="pa-modal-fader"></div>
    <div class="pa-modal-wrapper pa-registration-login-holder">

        <div class="sc_tabulatorParent">
            <div class="tabsTogglersRow sc_tabulatorToggleRow">

                <div class="tabToggle sc_tabulatorToggler opened" dataitem="0" title="">
                    <span class="">Регистрация</span>
                </div>

                <div class="tabToggle sc_tabulatorToggler" dataitem="1" title="">
                    <span class="">Вход</span>
                </div>

                <div class="pa-modal-close fa fa-times"></div>

            </div>

            <div class="ddRow notZindexed sc_tabulatorDDRow">

                <div class="tabulatorDDItem sc_tabulatorDDItem opened noMaxHeight chromeScroll" dataitem="0">


<!--                    <div class="pa-social-reg-holder">-->
<!---->
<!--                        --><?php
//
//                        // конфигурация настроек адаптера
//                        $vkAdapterConfig = array(
//                            'client_id'     => '5516978',
//                            'client_secret' => 'uYYXOq8uswQQKJVgktHH',
//                            'redirect_uri'  => 'http://mirbileta.ru/auth?provider=vk'
//                        );
//
//                        // создание адаптера и передача настроек
//                        $vkAdapter = new SocialAuther\Adapter\Vk($vkAdapterConfig);
//
//                        // передача адаптера в SocialAuther
//                        $auther = new SocialAuther\SocialAuther($vkAdapter);
//
//                        // аутентификация и вывод данных пользователя или вывод ссылки для аутентификации
//                        if (!isset($_GET['code'])) {
//                            echo '<p><a href="' . $auther->getAuthUrl() . '">Аутентификация через ВКонтакте</a></p>';
//                        } else {
//                            if ($auther->authenticate()) {
//                                if (!is_null($auther->getSocialId()))
//                                    echo "Социальный ID пользователя: " . $auther->getSocialId() . '<br />';
//
//                                if (!is_null($auther->getName()))
//                                    echo "Имя пользователя: " . $auther->getName() . '<br />';
//
//                                if (!is_null($auther->getEmail()))
//                                    echo "Email пользователя: " . $auther->getEmail() . '<br />';
//
//                                if (!is_null($auther->getSocialPage()))
//                                    echo "Ссылка на профиль пользователя: " . $auther->getSocialPage() . '<br />';
//
//                                if (!is_null($auther->getSex()))
//                                    echo "Пол пользователя: " . $auther->getSex() . '<br />';
//
//                                if (!is_null($auther->getBirthday()))
//                                    echo "День Рождения: " . $auther->getBirthday() . '<br />';
//
//                                // аватар пользователя
//                                if (!is_null($auther->getAvatar()))
//                                    echo '<img src="' . $auther->getAvatar() . '" />'; echo "<br />";
//                            }
//                        }
//
//
//                        $facebookAdapterConfig = array(
//                            'client_id'     => '911528195635736',
//                            'client_secret' => '2de1ab376d1c17cd47250920c05ab386',
//                            'redirect_uri'  => 'http://localhost/auth?provider=facebook'
//                        );
//
//                        $facebookAdapter = new SocialAuther\Adapter\Facebook($facebookAdapterConfig);
//
//                        $auther = new SocialAuther\SocialAuther($facebookAdapter);
//
//                        if (!isset($_GET['code'])) {
//                            echo '<p><a href="' . $auther->getAuthUrl() . '">Аутентификация через Facebook</a></p>';
//                        } else {
//                            if ($auther->authenticate()) {
//                                if (!is_null($auther->getSocialId()))
//                                    echo "Социальный ID пользователя: " . $auther->getSocialId() . '<br />';
//
//                                if (!is_null($auther->getName()))
//                                    echo "Имя пользователя: " . $auther->getName() . '<br />';
//
//                                if (!is_null($auther->getEmail()))
//                                    echo "Email пользователя: " . $auther->getEmail() . '<br />';
//
//                                if (!is_null($auther->getSocialPage()))
//                                    echo "Ссылка на профиль пользователя: " . $auther->getSocialPage() . '<br />';
//
//                                if (!is_null($auther->getSex()))
//                                    echo "Пол пользователя: " . $auther->getSex() . '<br />';
//
//                                if (!is_null($auther->getBirthday()))
//                                    echo "День Рождения: " . $auther->getBirthday() . '<br />';
//
//                                // аватар пользователя
//                                if (!is_null($auther->getAvatar()))
//                                    echo '<img src="' . $auther->getAvatar() . '" />'; echo "<br />";
//                            }
//                        }
//
//                        ?>
<!---->
<!---->
<!--                    </div>-->
<!---->
<!--                    <div class="">Или</div>-->


                    <div class="pa-login-field-holder">
                        <input type="text" placeholder="Ваш e-mail" id="pa-reg-email"/>
                    </div>

                    <div class="pa-login-field-holder">
                        <input type="password" placeholder="Пароль" id="pa-reg-pass"/>
                    </div>

                    <div class="pa-login-field-holder">
                        <input type="password" placeholder="Пароль повторно" id="pa-reg-pass-re"/>
                    </div>

                    <div class="pa-login-field-holder">
                        <div class="pa-reg-confirm">Зарегистрироваться</div>
                    </div>

                    <div class="pa-login-field-holder">
                        <div class="pa-forget-pass">Забыли пароль?</div>
                    </div>

                </div>

                <div class="tabulatorDDItem sc_tabulatorDDItem noMaxHeight chromeScroll" dataitem="1">

                    <div class="pa-login-field-holder">
                        <input type="text" placeholder="Ваш e-mail" id="pa-log-email"/>
                    </div>

                    <div class="pa-login-field-holder">
                        <input type="password" placeholder="Пароль" id="pa-log-pass"/>
                    </div>

                    <div class="pa-login-field-holder">
                        <div class="pa-login-confirm">Войти</div>
                    </div>

                    <div class="pa-login-field-holder">
                        <div class="pa-forget-pass">Забыли пароль?</div>
                    </div>

                </div>

            </div>
        </div>


    </div>
</div>







