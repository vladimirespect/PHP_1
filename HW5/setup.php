<?php
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('BIG', DIR_ROOT . '/gallery_img/big/');

include "db.php";

$result = mysqli_query($db, "SELECT id FROM goods");
// ...= выполнить запрос(указываем соединение, сам запрос)- если данных в табл бд не существует вернёт ноль в num_rows.
if ($result->num_rows == 0) {
    echo "Таблица пустая.";
    $images = array_splice(scandir(BIG), 2);
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
    $result2 = "INSERT INTO `goods`(`name`) VALUES " . $result2;
    $result2 = substr($result2, 0, -2);
    return $result2;
}
