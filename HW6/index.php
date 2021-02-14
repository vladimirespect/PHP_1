<?php
$h1="Hi, Scotland!";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Интернет-магазин "<?=$h1?>"</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
<h1 class="heading1">Интернет-магазин &laquo;<?=$h1?>&raquo;</h1> <br>

<img src="img/viaduk.jpg" alt="мост виадук"><br>

<h3>Приветствую Вас, уважаемый гость.</h3>

<p>На&nbsp;нашем сайте вы&nbsp;можете увидеть и&nbsp;приобрести уникальные товары из&nbsp;Шотландии.<br>
    Например, здесь вы&nbsp;можете купить Килт, виски и&nbsp;тур по&nbsp;средневековым замкам этой замечательной страны! </p> <br>
<?php include "menu.php" ?>
</body>
<?php include "footer.php" ?>



</html>