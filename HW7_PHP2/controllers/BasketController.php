<?php


namespace app\controllers;

use app\models\entities\{Basket, Orders};
use app\models\repositories\{BasketRepository, OrdersRepository};
use app\engine\{Request, Session};

class BasketController extends Controller
{

    public function actionIndex()
    {
        $session = new Session();
        $basket = (new BasketRepository())->getBasket($session->getId());

        if(isset((new Request())->getParams()['ordermessage'])) {
            $ordermessage = "Заказ успешно оформлен. Спасибо!";
        }

        echo $this->render('basket', [
            'basket' => $basket,
            'ordermessage' => $ordermessage
        ]);
    }




    public function actionAdd()
    {

        $id = (new Request())->getParams()['id'];
        $session = new Session();

        $basket = new Basket($session->getId(), $id);
        (new BasketRepository())->save($basket);


        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', $session->getId()),
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {

        $id = (new Request())->getParams()['id'];
        $session = new Session();
        (new BasketRepository())->deleteAnd('id', $id, 'session_id', $session->getId());

        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', $session->getId()),
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionOrder() {

        $nameInBasket = (new Request())->getParams()['nameInBasket'];
        $phone = (new Request())->getParams()['phone'];
        $orderAmount = (new Request())->getParams()['totalBasket'];
        $session = new Session();

        $order = new Orders($nameInBasket, $phone, $session->getId(), $orderAmount, 0);
        (new OrdersRepository())->save($order);

        $session->regenerate();

        header("Location:" . $_SERVER['HTTP_REFERER']); //TODO Уважаемый преподаватель! В РНР1 мы просто передавали ?ordermessage=orderok методом гет в запросе,
        //TODO благодаря чему могли вывести сообщение об успешном оформлении заказа. Подскажите а как это реализовать с ЧПУ?
        die();

    }

}