<?php

    $seo = explode('/', get_the_title(get_the_ID()));

    $t = $seo[0];
    $d = $seo[1];

    $adm_t = get_field('title');
    $adm_d = get_field('description');

    $title = ($t)? $t : (strlen($adm_t) > 0)? $adm_t : 'Мир Билета - Купить билеты по номиналу без наценок в театр и на концерт в Москве.';
    $desc = ($d)? $d : (strlen($adm_d) > 0)? $adm_d : 'Купить электронные билеты онлайн в театр и на концерт в Москве. Mirbileta.ru';


?>



<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $desc; ?>">
