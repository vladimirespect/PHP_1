<?php
$menu = [
	[
		"title" => "Главная",
		"href" => "/"
	],
	[
		"title" => "Каталог",
		"href" => "/catalog/",
		"subitems" => [
			[
				"title" => "Самогонка",
				"href" => "/catalog/goods/"
			],
			[
				"title" => "Виски",
				"href" => "/catalog/goods/whisky.html",
				"subitems" => [
						[
							"title" => "Шотландское",
							"href" => "/catalog/goods/whisky.html"
						],
						[
							"title" => "Американское",
							"href" => "/catalog/goods/"
						]
					]
			]
		]
	],
	[
		"title" => "Коньяк",
		"href" => "/catalog/goods/"
	],
];

$result = "<ul>";
$result .= menuRender($menu);
$result .= "</ul>";

echo $result;


function menuRender($menu_array){
	$result = "";
	
	foreach($menu_array as $item){
		$result .= "<li><a href='{$item['href']}'>{$item['title']}</a>";
		
		if(isset($item["subitems"])){
			$result .= "<ul>";
			$result .= menuRender($item["subitems"]);
			$result .= "</ul>";
		}
		
		$result .= "</li>";
	}
	
	return $result;
}



