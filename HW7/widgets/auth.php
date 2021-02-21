<?php
session_start();
include "config/db.php";


//минус способа в том что при перезагрузке компьютера сессия удалится и каждый раз придётся заново вносить логить и пароль

$auth = false;

if (isAuth($db)) {
    $auth = true;
    $name = getUser();
}

if (isset($_GET['logout'])) {
    session_destroy(); //удалит связь с сервером, а потом сервер удалит файл
    //session_regenerate_id(); - заменит id сессии
    header("Location: /");
    die();
}




if ($_POST) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];


    if (auth($login, $pass, $db)) {
        if (isset($_POST['save'])) {
            $hash = uniqid(rand(), true);
            $id = $_SESSION['auth']['id']; //чтобы поменять юзеру хэш в бд
            $sql = "UPDATE users SET hash = '{$hash}' WHERE id = {$id}";
            $result = mysqli_query($db, $sql);
            setcookie("hash", $hash, time() + 3600, "(/)");
        }
        header("Location: /");
        die();
    } else {
        die("Не верный логин/пароль");
    }
}



function auth($login, $pass, $db) {
    $login = mysqli_real_escape_string($db, strip_tags(stripslashes($login)));
    $result = mysqli_query($db, "SELECT * FROM users WHERE login = '{$login}'");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row['pass']) { //(password_verify($pass, $row['pass'])) в бд должен быть захешированный пароль
            // Если сравнение успешно, то Авторизация
            $_SESSION['auth']['login'] = $login;//поскольку в сессии могут быть одинаковые имена уточняем двумерным массивом
            $_SESSION['auth']['id'] = $row['id'];
            return true;
        }
    }

    return false;
}


//проверяет авторизован ли кто-то/ Честно не очень понял что здесь нужно было доработать. Вы на уроке просили доработать что-то с кукой.
function isAuth($db) {
    if (isset($_COOKIE["hash"])) {
        $hash = $_COOKIE["hash"];
        $sql = "SELECT * FROM users WHERE hash = '{$hash}'";
        $result = mysqli_query($db, $sql);
        if($result) { //если такой хэш найдётся извлекаем запись из БД
            $row = mysqli_fetch_assoc($result);
            $user = $row['login'];
            if(!empty($user)) {
                $_SESSION['auth']['login'] = $user;
            }
        }
    }
    return isset($_SESSION['auth']['login']);
}

function getUser() {
    return $_SESSION['auth']['login'];
}

/*function Buy($id) {
    $_SESSION['basket'][] = $id;
}*/

//BasketCount
$session = session_id();//session_id();-функция $_SESSION, выдаст ID сессии
$basketCount = mysqli_query($db, "SELECT count(id) as count FROM basket WHERE session_id = '{$session}'");
$count = mysqli_fetch_assoc($basketCount)['count'];
