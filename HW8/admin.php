<?php
include "widgets/db.php";
include "widgets/auth.php";

$result = mysqli_query($db, "SELECT * FROM `orders` WHERE 1");

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
    <div class="post_title"><h2>Управление заказами</h2></div>
    <div class="gallery"><br>
        <? while ($row = mysqli_fetch_assoc($result)) : ?>
            <span>Имя покупателя: <?=$row['name']?></span><br>
            <span>Телефон: <?=$row['phone']?></span><br>
            <span>Статус заказа: <?=$row['status']?></span><br>
            <a class="link" href="/adminfull.php?basketid=<?= $row['id'] ?>">Подробности заказа</a><br>
            <hr>
        <? endwhile; ?>
    </div>
</div>
<?php endif; ?>
</body>
</html>
