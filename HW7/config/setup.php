<?php
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('BIG', DIR_ROOT . '/img/gallery_img/big/');

include "db.php";

$result = mysqli_query($db, "SELECT id FROM gallery");
// ...= выполнить запрос(указываем соединение, сам запрос)- если данных в табл бд не существует вернёт ноль в num_rows.
if ($result->num_rows == 0) {
    echo "Таблица пустая.";
    $images = array_splice(scandir(BIG), 3);//углубил подпапку поменял 2 на 3 18.02.21
    //INSERT INTO `goods`(`name`) VALUES ('1.jpg'), ('2.jpg')
    mysqli_query($db, getNames($images));//пользуясь этим методом нужно убедиться что столбцы БД не затронутые этой функцией имеют значение по умолчанию.
} else {
    echo "Какие-то данные есть =)";
}
//echo getNames($images);

function getNames($images_array)
{
    $result2 = "";
    foreach ($images_array as $name) {
        $result2 .= "('" . $name . "'), ";
    }
    $result2 = "INSERT INTO `gallery`(`name`) VALUES " . $result2;
    $result2 = substr($result2, 0, -2);
    return $result2;
}
