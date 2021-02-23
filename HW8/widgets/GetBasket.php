<?php
function GetBasket($page, $db) {
    if($_GET['action'] == 'buy') {
        $session = session_id();
        $basket_id = (int)$_GET['basket_id'];
        mysqli_query($db, "INSERT INTO basket(session_id, goods_id) VALUES ('{$session}','{$basket_id}')");
        $str = "location: /$page";
        header($str);
        die();
    }
}