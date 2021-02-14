<?php

//2.Создать калькулятор, который будет определять тип выбранной пользователем операции, ориентируясь на нажатую кнопку.

//При желании сделать через ajax- часа 4 делал. Не получилось. Не проходил JS, и не получилось пробросить знак операции в функцию MathOperation.
//удавалось определить нажатую кнопку по типу this.innerHTML. Alert выдавал правильный результат.
// Но передать результат каким-то образом через переменную в AJAX а потом на сервер не удалось.
//3000 файлов с плохим кодом прикреплять не стал.

include "formulas.php";

$arg1 = "";
$arg2 = "";
$result = "";
$operation ="";

function button() {
    if (isset($_POST['+'])) {
        return $_POST['+'];
    } elseif (isset($_POST['-'])) {
        return $_POST['-'];
    } elseif (isset($_POST['*'])) {
        return $_POST['*'];
    } else {
        return $_POST['/'];
    }
}

if ($_POST) { //если пришли данные от пользователя
    $arg1 = (float)strip_tags($_POST["arg1"]);
    $arg2 = (float)strip_tags($_POST["arg2"]);
    $operation = strip_tags(button());

    $result = mathOperation($arg1, $arg2,"$operation");
}
//
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
    <input type="text" name="arg1" value="<?=$arg1?>">
    <input type="submit" value="+" name="+">
    <input type="submit" value="-" name="-">
    <input type="submit" value="*" name="*">
    <input type="submit" value="/" name="/">
    <input type="text" name="arg2" value="<?=$arg2?>">=
    <input type="text" name="result" readonly value="<?=$result?>">
</form>

</body>
</html>
