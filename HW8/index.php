<?php
include "widgets/db.php";
include "widgets/auth.php";

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
    <?php if($auth): ?>
     <a href="/admin.php">Информация о заказах (требуются права администратора)</a><br><br>
    <?php endif; ?>
    <img src="img/viaduk.jpg" alt="мост виадук"><br>
    <p>На&nbsp;нашем сайте вы&nbsp;можете увидеть и&nbsp;приобрести уникальные товары из&nbsp;Шотландии.<br>
        Например, здесь вы&nbsp;можете купить Килт, виски и&nbsp;тур по&nbsp;средневековым замкам этой замечательной
        страны! </p> <br>
    <?php include "widgets/footer.php" ?>
    </body>
</html>