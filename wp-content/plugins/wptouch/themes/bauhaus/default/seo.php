<?php

    $t = get_field('title', get_the_ID());
    $d = get_field('description', get_the_ID());

    $title = ($t)? $t : 'Мир Билета - Купить билеты по номиналу без наценок в театр и на концерт в Москве.';
    $desc = ($d)? $d : 'Купить электронные билеты онлайн в театр и на концерт в Москве. Mirbileta.ru';


?>



<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $desc; ?>">