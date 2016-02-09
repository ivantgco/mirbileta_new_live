<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 25.01.16
 * Time: 16:49
 */
require('./vendor/fightbulc/moment/src/MomentLocale.php');
require('./vendor/fightbulc/moment/src/Moment.php');
$m = new \Moment\Moment(); // default is "now" UTC
echo $m->format(); // e.g. 2012-10-03T10:00:00+0000
phpinfo();

?>