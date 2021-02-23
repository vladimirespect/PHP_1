<?php
include "widgets/db.php";
include "widgets/auth.php";
include "widgets/GetBasket.php";
$id = (int)$_GET['id'];//ловим клик по фотографии с главной страницы чтобы получить АЙди конкретной фотографии по которой кликнули
//явное преобразование типов использовано для предотвращения попадания от пользователя вредоносного кода в БД



$result = mysqli_query($db, "SELECT * FROM `goods` WHERE id = {$id}");
if ($result->num_rows != 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    $message = "Товар отсутствует.";
}

GetBasket("item.php?id=$id", $db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ваш виски</title>
    <link rel="stylesheet" type="text/css" href="config/style.css"/>
</head>

<body link="white" vlink="white" alink="#ff7f50">
<div id="main">
    <?php include "widgets/menu.php"?>
    <a class="link" href="<?= $_SERVER['HTTP_REFERER']; ?>">Назад</a>
    <div class="post_title"><h2>Конкретный товар</h2></div>
    <div class="gallery">
        <h3><?= $row['name'] ?></h3>
        <img src="/img/catalog_img/big/<?= $row['image'] ?>" alt="goods"/><br>
        <div class="price"> Цена: <br> <?= $row['price'] ?> руб.</div>
        <a href="?action=buy&basket_id=<?= $row['id'] ?>&id=<?= $id ?>"><button>Купить</button></a><br><br>
        <div class="description"> Описание товара:<br> <?= $row['description'] ?></div>
        <? if(isset($message)) {
        echo $message; } ?>
    </div>

</body>
</html>