<?php
$session = session_id();//session_id();-функция $_SESSION, выдаст ID сессии
$basketCount = mysqli_query($db, "SELECT count(id) as count FROM basket WHERE session_id = '{$session}'");
$count = mysqli_fetch_assoc($basketCount)['count'];