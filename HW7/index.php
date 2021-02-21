<?php
include "widgets/auth.php";//этот инклюд и инклюд формы должен быть на всех страницах, что удобнее было бы делать на движке

$h1 = "Hi, Scotland!";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Интернет-магазин "<?= $h1 ?>"</title>
        <link rel="stylesheet" href="config/style2.css?<?=rand(1,9999)?>">
    </head>
    <?php include "widgets/form.php"; ?>
    <body>
    <h1 class="heading1">Интернет-магазин &laquo;<?= $h1 ?>&raquo;</h1> <br>
    <?php include "widgets/menu.php" ?>
    <img src="img/viaduk.jpg" alt="мост виадук"><br>
    <p>На&nbsp;нашем сайте вы&nbsp;можете увидеть и&nbsp;приобрести уникальные товары из&nbsp;Шотландии.<br>
        Например, здесь вы&nbsp;можете купить Килт, виски и&nbsp;тур по&nbsp;средневековым замкам этой замечательной
        страны! </p> <br>
    </body>
    <?php include "widgets/footer.php" ?>
</html>