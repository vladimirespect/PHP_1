<?php
include "widgets/db.php";
include "widgets/auth.php";

$basketid = (int)$_GET['basketid'];

$result1 = mysqli_query($db, "SELECT session_id, name FROM `orders` WHERE id = {$basketid}");
$row1 = mysqli_fetch_assoc($result1);


$userBasket = mysqli_query($db,"SELECT basket.id as basket_id, goods.id as goods_id, goods.name as name, goods.image as image, goods.price as price, goods.description as 
description FROM basket, goods WHERE basket.goods_id=goods.id AND session_id='{$row1['session_id']}'");

$totalBasket = 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management</title>
    <link rel="stylesheet" type="text/css" href="config/style.css"/>
</head>
<body link="white" vlink="white" alink="#ff7f50">
<?php if($auth): ?>
<div id="main">
    <?php include "widgets/form.php"; ?>
    <?php include "widgets/menu.php"?>
    <a href="<?= $_SERVER['HTTP_REFERER']; ?>">Назад</a>
    <div class="heading1"><h2>Подробности заказа пользователя: <?=$row1['name']?></h2> <hr>
        <? foreach ($userBasket as $value) : ?>
            <h2><?= $value['name'] ?></h2>
            <img src="/img/catalog_img/small/<?= $value['image'] ?>" width="150"/></a><br>
            Стоимость: <?= $value['price'] ?> руб.
            <?php $totalBasket += $value['price']; ?>
            <br>
            <hr>
        <? endforeach; ?>
        <b>Итого к оплате: <?=$totalBasket . " руб.";?></b>
        <br>
        <hr>
        <br>
    </div>
    <?php endif; ?>
</body>
</html>
