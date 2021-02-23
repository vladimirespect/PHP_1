<?php
global $count;
$menu = [
    [
        "title" => "Главная",
        "href" => "/index.php"
    ],
    [
        "title" => "Галерея",
        "href" => "/gallery.php"
    ],
    ["title" => "Каталог товаров и&nbsp;услуг",
        "href" => "/catalog.php",
        /*"subitems" => [
            [
                "title" => "Товары",
                "href" => "/Catalog/goods/",
                "subitems" => [
                    [
                        "title" => "Виски",
                        "href" => "/Catalog/goods/whisky.html"
                    ],
                    ["title" => "Самогонка",
                        "href" => "/Catalog/goods/whisky2.html"

                    ]
                ],
            ],
            [
                "title" => "Услуги",
                "href" => "/Catalog/goods/"
            ]
        ],*/
    ],
    [
        "title" => "Отзывы",
        "href" => "/feedback_own.php"
    ],
    [
        "title" => "Корзина ({$count})",
        "href" => "/basket.php"
    ],
];



function menuRender($menu_array){
    $resultMenu = "";

    foreach($menu_array as $item){
        $resultMenu .= "<li><a href='{$item['href']}'><img src=/img/flag.jpg alt=\"f\">{$item['title']}</a>";
        /*if(isset($item["subitems"])){
            $result .= "<ul>";
            $result .= menuRender($item["subitems"]);
            $result .= "</ul>";
        }*/
        $resultMenu .= "</li>";
    }

    return $resultMenu;
}

$resultMenu = "<ul>";
$resultMenu .= menuRender($menu);
$resultMenu .= "</ul>";

echo $resultMenu;
