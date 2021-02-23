<?php
$db = @mysqli_connect("localhost:3306", "root", "root", "site") or die(mysqli_connect_error());
//@-убирает вывод системных сообщений(до 8й версии) (локалхост- не папка с сайтом)
//урок 5 2 часа 0 минут- как завернуть бд в функцию
/*function getDb() {
    static $db = null;
    if (is_null($db)) {
        $db = @mysqli_connect("localhost:3306", "root", "root", "site") or die("Could not connect: " . mysqli_connect_error());
    }
    return $db;
}*/