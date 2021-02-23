<?php
include "widgets/db.php";
include "widgets/auth.php";

if($_GET['action'] == 'order') {
    $nameInBasket = htmlspecialchars(strip_tags(mysqli_real_escape_string($db, $_POST['nameInBasket'])));
    $phone = htmlspecialchars(strip_tags(mysqli_real_escape_string($db, $_POST['phone'])));
    $sql = "INSERT INTO `orders`(`name`, `phone`, `session_id`) VALUES ('{$nameInBasket}','{$phone}','{$session}')";
    session_regenerate_id();//сбрасывает айди сессии- сбрасывает корзину
    mysqli_query($db, $sql);
    header("Location: basket.php?ordermessage=orderok");
    die();
}

if($_GET['ordermessage']){
    $ordermessage = "Заказ успешно оформлен. Спасибо!";
}


$basket = mysqli_query($db,"SELECT basket.id as basket_id, goods.id as goods_id, goods.name as name, goods.image as image, goods.price as price, goods.description as 
description FROM basket, goods WHERE basket.goods_id=goods.id AND session_id='{$session}'");


if ($_GET['action'] == 'delete') {
    $idBasketDelete = (int)$_GET['basket_id'];
    $resultBasketDelete = mysqli_query($db, "SELECT session_id FROM basket WHERE id = {$idBasketDelete}");
    $rowBasketDelete = mysqli_fetch_assoc($resultBasketDelete);
    if ($session == $rowBasketDelete['session_id'])
     mysqli_query($db, "DELETE FROM basket WHERE basket.id = {$idBasketDelete}");
    header("Location: /basket.php");
    die();
}
//count(price) as price, не работает
$totalBasket = 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basket</title>
    <link rel="stylesheet" type="text/css" href="config/style.css"/>
</head>
<body link="white" vlink="white" alink="#ff7f50">

<div id="main">
    <?php include "widgets/form.php"; ?>
    <?php include "widgets/menu.php" ?>
    <a href="<?= $_SERVER['HTTP_REFERER']; ?>">Назад</a>
    <div class="heading1"><h2>Корзина</h2> <hr>
        <? foreach ($basket as $value) : ?>
                <h2><?= $value['name'] ?></h2>
                <img src="/img/catalog_img/small/<?= $value['image'] ?>" width="150"/></a><br>
            Стоимость: <?= $value['price'] ?> руб.
        <?php $totalBasket += $value['price']; ?>
            <a href="?action=delete&basket_id=<?=$value['basket_id'] ?>"><button>Удалить</button></a><!-- value['basket_id'] тк id товара и id корзины имеют одинаковое название столбца, при их объединении sql запросом мы задали им ассоциативные имена для разделения их id -->
            <br>
            <hr>
        <? endforeach; ?>
        <b>Итого к оплате: <?=$totalBasket . " руб.";?></b>
        <br>
        <hr>
        Введите данные, чтобы оформить заказ:<br><br>
        <form action="?action=order" method="post">
            <input type="text" name="nameInBasket" placeholder="Имя">
            <input type="text" name="phone" placeholder="Телефон">
            <input type="submit" value="Оформить заказ">
        </form><br>
        <h3><b><?=$ordermessage;?></b></h3>
        <br>
    </div>
    <?php include "widgets/footer.php" ?>
</body>

</html>
