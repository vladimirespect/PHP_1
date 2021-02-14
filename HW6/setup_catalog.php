<?php
//строки 'name' и 'description' в БД надо добавлять после настройки, либо задать временно им значение INT и по умолчанию 0. Только в этом случае автонастройка удастся
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('BIG_CAT', DIR_ROOT . '/catalog_img/big/');

include "db.php";

$result = mysqli_query($db, "SELECT id FROM goods");
// ...= выполнить запрос(указываем соединение, сам запрос)- если данных в табл бд не существует вернёт ноль в num_rows.
if ($result->num_rows == 0) {
    echo "Таблица пустая.";
    $goods = array_splice(scandir(BIG_CAT), 2);
    //INSERT INTO `goods`(`image`) VALUES ('1.jpg'), ('2.jpg')
    mysqli_query($db, getNames($goods));//пользуясь этим методом нужно убедиться что столбцы БД не затронутые этой функцией имеют значение по умолчанию.
    var_dump($goods);
} else {
    echo "Какие-то данные есть =)";
}


function getNames($goods_array)
{
    $result2 = "";
    foreach ($goods_array as $name) {
        $result2 .= "('" . $name . "'), ";
    }
    $result2 = "INSERT INTO `goods`(`image`) VALUES " . $result2;
    $result2 = substr($result2, 0, -2);
    var_dump($result2);
    return $result2;
}
