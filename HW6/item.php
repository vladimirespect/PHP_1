<?php

include "db.php";

$id = (int)$_GET['id'];//ловим клик по фотографии с главной страницы чтобы получить АЙди конкретной фотографии по которой кликнули
//именно для этого в ссылке для URL с главной стр. прописано ?ID=
//явное преобразование типов использовано для предотвращения попадания от пользователя вредоносного кода в БД

$result = mysqli_query($db, "SELECT * FROM `goods` WHERE id = {$id}");//подгружаем из базы по айди пойманному с главной и переданному в БД
if ($result->num_rows != 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    $message = "Товар отсутствует.";
}

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Ваш виски</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body link="white" vlink="white" alink="#ff7f50">
<div id="main">
    <a class="link" href="/">Главная</a>
    <a class="link" href="<?= $_SERVER['HTTP_REFERER']; ?>">Назад</a>
    <div class="post_title"><h2>Конкретный товар</h2></div>
    <div class="gallery">
        <h3><?= $row['name'] ?></h3>
        <img src="catalog_img/big/<?= $row['image'] ?>"/></a><br>
        <div class="price"> Цена: <br> <?= $row['price'] ?> руб.</div>
        <button>Купить</button><br><br>
        <div class="description"> Описание товара:<br> <?= $row['description'] ?></div>
        <? if(isset($message)) {
        echo $message; } ?>
    </div>

</body>
</html>