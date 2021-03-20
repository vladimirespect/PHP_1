<?php


namespace app\engine;
require_once '../vendor/autoload.php';

use app\interfaces\IRenderer;

class TwigRender implements IRenderer
{

    private $twigObject;


    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twigObject = new \Twig\Environment($loader);
    }


    public function renderTemplate($template, $params = []) {
        return $this->twigObject->render($template. '.twig', $params);



    }
}

