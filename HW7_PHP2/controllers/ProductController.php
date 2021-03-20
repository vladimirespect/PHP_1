<?php


namespace app\controllers;

use app\engine\Request;
use app\models\repositories\GoodsRepository;


class ProductController extends Controller
{


    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = (new Request())->getParams()['page'] ?? 0;
        $catalog = (new GoodsRepository())->getLimit(($page + 1) * 2);

        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $id = (new Request())->getParams()['id'];

        $good = (new GoodsRepository())->getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }


}