<?php

//1. Создать форму-калькулятор с операциями: сложение, вычитание, умножение, деление.
// Не забыть обработать деление на ноль! Выбор операции можно осуществлять с помощью тега <select>.
// Оставьте введенные значения в форме, и выбранную операцию тоже!

include "formulas.php";

$arg1 = "";
$arg2 = "";
$result = "";
$operation ="";

if ($_POST) { //если пришли данные от пользователя
    $arg1 = (float)strip_tags($_POST["arg1"]);
    $arg2 = (float)strip_tags($_POST["arg2"]);
    $operation = strip_tags($_POST["operation"]);

$result = mathOperation($arg1, $arg2,"$operation");
}
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
    <select name="operation" >
        <option <?php if ($operation == "+") echo 'selected'?>>+</option>
        <option <?php if ($operation == "-") echo 'selected'?>>-</option>
        <option <?php if ($operation == "*") echo 'selected'?>>*</option>
        <option <?php if ($operation == "/") echo 'selected'?>>/</option>
    </select>
    <input type="text" name="arg2" value="<?=$arg2?>">
    <input type="submit" value="=">
    <input type="text" name="result" readonly value="<?=$result?>">
</form>

</body>
</html>
