<?php

session_start();

use app\engine\{Autoload, Render, TwigRender, Request};

include "../config/config.php";
//include "../engine/Autoload.php"; после добавления автозагрузчика phpunit с папки vendor после редактирования composer
//необходимость в нашем автозагрузчике отпала
include "../vendor/autoload.php";

//try catch - перхват фатала. Нужен для поиска ошибок во время разработки.
// А тесты при добавлении функционала. Кетч ловит ошибку в любом месте проекта. Если ошибок нет просто выдаст страницу как обычно

try {
    spl_autoload_register([new Autoload(), 'loadClass']);

    $request = new Request();

    $controllerName = $request->getControllerName() ?: 'product';
    $actionName = $request->getActionName();

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new Render());
        $controller->runAction($actionName);
    }


} catch (\PDOException $exception) { //можем последовательно ловить и отлаживать разные исключения, как здесь в ПДО
    var_dump($exception->getMessage()); //в engine class Request приведён пример как унаследоваться от exception чтобы делать так в своих классах

} catch (\Exception $exception) { //главное не забывать что исключения \Exception должны идти после всех остальных
    var_dump($exception->getTrace());
    //если хотим вникнуть читаем Котерова
}
