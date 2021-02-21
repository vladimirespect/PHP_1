<?php
include "widgets/auth.php";

$id = (int)$_GET['id'];//ловим клик по фотографии с главной страницы чтобы получить АЙди конкретной фотографии по которой кликнули
//именно для этого в ссылке для URL с главной стр. прописано ?ID=
//явное преобразование типов использовано для предотвращения попадания от пользователя вредоносного кода в БД
mysqli_query($db, "UPDATE gallery SET likes=likes + 1 WHERE id = {$id}");//likes=likes + 1 лучше сделать после запроса на картинку,
// а то выводится со старым значением лайков, еще не обновленные, т.е. 0 будет при первом просмотре, хотя он уже произошел.
$result = mysqli_query($db, "SELECT * FROM `gallery` WHERE id = {$id}");//подгружаем из базы по айди пойманному с главной и переданному в БД
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Моя галерея</title>
    <link rel="stylesheet" type="text/css" href="config/style.css"/>
</head>

<body link="white" vlink="white" alink="#ff7f50">
<div id="main">
    <a class="link" href="/">Главная</a>
    <a class="link" href="<?= $_SERVER['HTTP_REFERER']; ?>">Назад</a>
    <div class="post_title"><h2>Моя галерея</h2></div>
    <div class="likes"> Количество просмотров <?= $row['likes'] ?></div>
    <div class="gallery">
        <img src="/img/gallery_img/big/<?= $row['name'] ?>"/></a>
    </div>

</body>
</html>
