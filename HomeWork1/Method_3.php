<?php
    $year =2021;
    $h1="Hi, Scotland!";
    $title="Method_3";

    $text = file_get_contents("Method_3.html");

    $text = str_replace("{{ year }}", $year, $text);
    $text = str_replace("{{ h1 }}", $h1, $text);
    $text = str_replace("{{ title }}", $title, $text);

    echo $text;
