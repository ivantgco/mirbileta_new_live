<?php
/**
 * Created by PhpStorm.
 * User: goptarev
 * Date: 10.05.16
 * Time: 19:51
 */

$url =  $global_prot ."://". $global_url . "/cgi-bin/site?request=<command>get_action_tag</command><url>mirbileta.ru</url>";

$ch = curl_init();

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$resp = curl_exec($ch);

if(curl_errno($ch))
    print curl_error($ch);
else
    curl_close($ch);

$columns = json_decode($resp)->results["0"]->data_columns;
$data = json_decode($resp)->results["0"]->data;


?>

<div class="sidebar-tags-wrapper">
    <div class="sidebar-title">

        <div class="sidebar-title-inner">ТЕГИ</div>

        <div class="sidebar-tags-search-wrapper">
            <input type="text" class="sidebar-tags-search" placeholder="#"/>
        </div>

    </div>

    <div class="sidebar-tags-list">
        <?php


        $tagsHtml = "";

        foreach ($data as $key => $value){

            $action_tag_id =       $value[array_search("ACTION_TAG_ID", $columns)];
            $action_tag_name =        $value[array_search("ACTION_TAG", $columns)];


            $tagsHtml .= '<div class="sidebar-tag-item" data-id="'.$action_tag_id.'">'.$action_tag_name.'</div>';

        }

        if(strlen($tagsHtml) == 0){
            echo '<div class="somethinggoeswrong">Что-то пошло не так, звоните +7 (906) 063-88-66</div>';
        }else{
            echo $tagsHtml;
        }
        ?>
    </div>

    <div class="sidebar-tags-toggler">Показать больше тегов</div>

</div>