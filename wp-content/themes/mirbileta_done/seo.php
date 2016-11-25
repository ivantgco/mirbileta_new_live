<?php

    $seo = explode('/', get_the_title(get_the_ID()));

    $t = $seo[0];
    $d = $seo[1];

    $title = ($t)? $t : 'Мир Билета - Купить билеты по номиналу без наценок в театр и на концерт в Москве.';
    $desc = ($d)? $d : 'Купить электронные билеты онлайн в театр и на концерт в Москве. Mirbileta.ru';


?>



<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $desc; ?>">