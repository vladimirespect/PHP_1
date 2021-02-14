<?php
include "classSimpleImage.php";
include "db.php";



define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('BIG', DIR_ROOT . '/gallery_img/big/');
define('SMALL', DIR_ROOT . '/gallery_img/small/');

function upload() {
    include "upload.php";
}

$messages = [
    'ok' => 'Файл загружен',
    'error' => 'Ошибка загрузки'
];
if (!empty($_FILES)) {
    if (isset($_POST['load'])) { //ловим нажатие кнопки load
        upload();//upload.php лучше оформить в виде функции и вызывать как функцию, а не делать include прямо в логике, это зло.
    }
}

$result = mysqli_query($db, "SELECT * FROM `gallery` WHERE 1 ORDER BY likes DESC"); // ORDER BY likes DESC -
//Еще получается в момент загрузки изображения выполняется SELECT * FROM goods WHERE 1,
// а результаты его не используются, т.к. после загрузки переход происходит, этот запрос надо ниже загрузки сделать.
$message = $messages[$_GET['message']];
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Моя галерея</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body link="white" vlink="white" alink="#ff7f50">
<div id="main">
    <?php include "menu.php"?>
    <a href="<?= $_SERVER['HTTP_REFERER']; ?>">Назад</a>
    <div class="post_title"><h2>Моя галерея</h2></div>
    <div class="gallery">
        <? while ($row = mysqli_fetch_assoc($result)) : ?>
            <a class="link" href="/bigImage.php?id=<?= $row['id'] ?>"><img
                        src="/gallery_img/small/<?= $row['name'] ?>" width="150"/></a>
        <? endwhile; ?>
    </div>
    <?= $message ?>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="Загрузить" name="load">
    </form>
</div>
</body>
</html>