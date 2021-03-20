<?php


namespace app\controllers;
use app\interfaces\IRenderer;
use app\models\repositories\{UsersRepository, BasketRepository};

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $defaultLayout = 'main';
    private $useLayout = true;

    private $renderer;

    public function __construct(IRenderer $render) {
        $this->renderer = $render;
    }


    public function runAction($action = null) {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    public function render($template, $params = []) {
        if($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->defaultLayout}", [
                'menu' => $this->renderTemplate('menu', [
                    'isAuth' => (new UsersRepository())->isAuth(),
                    'userName' => (new UsersRepository())->getName(),
                    'count' => (new BasketRepository())->getCountWhere('session_id',session_id())
                    ]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []) {
        return $this->renderer->renderTemplate($template, $params);
    }

}