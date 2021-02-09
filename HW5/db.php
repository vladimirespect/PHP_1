<?php
$db = @mysqli_connect("localhost:3306", "root", "root", "site") or Die(mysqli_connect_error());
//@-убирает вывод системных сообщений(до 8й версии) (локалхост- не папка с сайтом)