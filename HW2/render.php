<?php

$menu = renderTemplate('menu');
$content = renderTemplate('content');
echo renderTemplate('layout', $menu, $content);
//echo renderTemplate('layout', $content);

function renderTemplate($page, $menu = "", $content = "") {
    ob_start();//копим инфу в буфере
    include $page . ".php";
    return ob_get_clean();
}


