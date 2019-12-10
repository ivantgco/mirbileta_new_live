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

    if (getCookie('mb_utm') == undefined) {
        setCookie('mb_utm', '<?php echo $query_h; ?>', {
            path: '/'
        });
    }
</script>


    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(55857691, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true,
            ecommerce: "dataLayer"
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/55857691" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>





        <div class="mbw-loader-holder">
            <div class="mbw-loader-gif"></div>
            <div class="mbw-loader-text">Секундочку, сейчас все загрузим...</div>
        </div>

        <!---->
        <?php
        //
        //    if(!strpos($_SERVER['REQUEST_URI'],'parad_trubachej_koncert_posvyashhennij_letiyu_so_dnya_rozhdeniya_timofeya_dokshicera_6750') || !strpos($_SERVER['REQUEST_URI'],'cirkus__5612')){
        //
        //        echo '<a href="http://mirbileta.ru/parad_trubachej_koncert_posvyashhennij_letiyu_so_dnya_rozhdeniya_timofeya_dokshicera_6750/?utm_source=top_milstein"><div class="mb-top-adv"></div></a>';
        //    }
        //
        //
        ?>







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
                                                            //                        
                                                            ?>
                            <!---->
                            <!---->
                            <!--                    </div>-->
                            <!---->
                            <!--                    <div class="">Или</div>-->


                            <div class="pa-login-field-holder">
                                <input type="text" placeholder="Ваш e-mail" id="pa-reg-email" />
                            </div>

                            <div class="pa-login-field-holder">
                                <input type="password" placeholder="Пароль" id="pa-reg-pass" />
                            </div>

                            <div class="pa-login-field-holder">
                                <input type="password" placeholder="Пароль повторно" id="pa-reg-pass-re" />
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
                                <input type="text" placeholder="Ваш e-mail" id="pa-log-email" />
                            </div>

                            <div class="pa-login-field-holder">
                                <input type="password" placeholder="Пароль" id="pa-log-pass" />
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