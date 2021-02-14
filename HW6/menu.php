<?php
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
];



/* <li><a href="/Catalog/goods/whisky.html"> Каталог товаров и&nbsp;услуг</a></li>
 <li><a href="/index.php"><img src="img/flag.jpg" alt="f"> Главная</a></li>
 <li><a href="/здесь_будет_ссылка.php"> что-то1</a></li>
 <li><a href="/здесь_будет_ссылка2.php">что-то2</a></li>
*/




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
