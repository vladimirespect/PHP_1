<?php

/*1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения.
 Затем написать скрипт, который работает по следующему принципу:
•	если $a и $b положительные, вывести их разность;
•	если $а и $b отрицательные, вывести их произведение;
•	если $а и $b разных знаков, вывести их сумму;
Ноль можно считать положительным числом.*/

//echo rand(1,5);//вернёт случайное целое число от 1 до 5

$a = rand(-5,5);
$b = rand(-5,5);


if($a >=0 && $b >=0) {
    echo "разность<br>";
} elseif ($a < 0 && $b < 0) {
    echo "произведение<br>";
} elseif (($a < 0 && $b >=0) || ($a >=0 && $b < 0) ) {
    echo "сумма<br>";
}


/* 2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора switch организовать вывод чисел от $a до 15.
 При желании сделайте это задание через рекурсию. */

$a = rand(0,15);

switch($a) {
    case 0:
        echo "$a<br>";
    case 1:
        echo "1<br>";
    case 2:
        echo "2<br>";
    case 3:
        echo "3<br>";
    case 4:
        echo "4<br>";
    case 5:
        echo "5<br>";
    case 6:
        echo "6<br>";
    case 7:
        echo "7<br>";
    case 8:
        echo "8<br>";
    case 9:
        echo "9<br>";
    case 10:
        echo "10<br>";
    case 11:
        echo "11<br>";
    case 12:
        echo "12<br>";
    case 13:
        echo "13<br>";
    case 14:
        echo "14<br>";
    case 15:
        echo "15<br>";

}

// При желании сделайте это задание через рекурсию.

echo recurs($a);

function recurs($a) {
    if($a == 15) {
        return $a;
    } else {
        echo $a . '<br>';
        return recurs($a + 1);
    }
}


/* 3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами.
Обязательно использовать оператор return. В делении проверьте деление на 0 и верните текст ошибки. */

echo "<br>" . addition(2, 3);
echo "<br>" .  subtraction(2, 3);
echo "<br>" .  division(2, 0);
echo "<br>" .  multiplication(2, 3) . "<br>";

function addition($a, $b) {
    return $a + $b;
}

function subtraction($a, $b) {
    return $a - $b;
}

/*function division($a, $b) {
    if ($b == 0) {
        return "На ноль делить нельзя!";
    }
    return $a / $b;
}*/

function division($a, $b) {
    return ($b == 0) ? "На ноль делить нельзя!" : $a / $b;
}

function multiplication($a, $b) {
    return $a * $b;
}



/* 4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation),
 где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции.
 В зависимости от переданного значения операции выполнить одну из арифметических операций
(использовать функции из пункта 3) и вернуть полученное значение (использовать switch).*/

echo "<br>" . mathOperation(105, 3, '+');
echo "<br>" . mathOperation(100, 3, '-');
echo "<br>" . mathOperation(100, 0, '/');
echo "<br>" . mathOperation(100, 9, '*');

function mathOperation($arg1, $arg2, $operation)
{
    switch ($operation) {
        case '+':
            return addition($arg1, $arg2);
        case '-':
            return subtraction($arg1, $arg2);
        case '/':
            return division($arg1, $arg2);
        case '*':
            return multiplication($arg1, $arg2);
        default:
            return 'неверный знак операции!';
    }
}



/*5. Собрать страницу с меню и контентом, зарендерить как минимум 2 подшаблона через renderTemplate. ВАЖНОЕ

См.файл render.php


6. *С помощью рекурсии организовать функцию возведения числа в степень.
 Формат: function power($val, $pow), где $val – заданное число, $pow – степень.*/


echo "<br>" . power(7, 3) . "<br>";

function power($val, $pow) {
    if ($pow == 1) {
        return $val;
    } elseif ($pow == 0 && $val != 0) {
        return 1;
    } elseif ($pow == 0 && $val == 0) {
        return "Нуль в нулевой степени не определен, такое выражение не имеет смысла.";
    } elseif ($pow < 0 ) {
        return "Извините, функция реализована только для положительных степеней";
    } elseif ($pow >= 2) {
        return $val * power($val, $pow-1);
    }
}

/* 7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
22 часа 15 минут
21 час 43 минуты*/

echo tm(21, 43);

function tm($h, $m)
{
    return hours($h) . " " . minuts($m);
}

function hours($a)
{
    if ($a == 1 || $a == 21) {
        return $a . adapt(4);
    } elseif (($a >= 2 && $a <= 4) || ($a >= 22 && $a <= 24)) {
        return $a . adapt(5);
    } else {
        return $a . adapt(6);
    }
}

function minuts($b){
    if ($b == 1 || $b == 21 || $b == 31 || $b == 41) {
        return $b . adapt(2);
    } elseif ((($b >= 2 && $b <= 4) || ($b >= 22 && $b <= 24)) || (($b >= 32 && $b <= 34) || ($b >= 42 && $b <= 44))) {
        return $b . adapt(3);
    } else {
        return $b . adapt(1);
    }
}

function adapt($m)
{
    switch ($m) {
        case 1:
            return " минут";
        case 2:
            return " минута";
        case 3:
            return " минуты";
        case 4:
            return " час";
        case 5:
            return " часа";
        case 6:
            return " часов";

    }
}
?>
<link rel="stylesheet" href="style.css">
<ul class="menu">

    <li><a href="Catalog/whisky.html"> Каталог товаров и&nbsp;услуг</a> <br></li>
    <li class="li2"><a href="render.php"> На зарендеренную</a> <br></li>
</ul>





