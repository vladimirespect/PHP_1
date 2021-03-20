<?php


namespace app\models\repositories;


use app\engine\{Request, Session};
use app\models\Repository;
use app\models\entities\Users;


class UsersRepository extends Repository
{

    protected function getTableName()
    {
        return 'users';
    }

    protected function getEntityClass()
    {
        return Users::class;
    }

    public function auth($login, $pass)
    {
        $user = $this->getWhere('login', $login);
        if (password_verify($pass, $user->pass)) {
            $_SESSION['auth']['login'] = $login;
            $_SESSION['auth']['id'] = $user->id;
            return true;
        } else {
            return false;
        }
    }


    public function isAuth()
    {
        $session = new Session();
        $session = $session->get('login'); //TODO если что не работает с save session искать ошибку здесь
        if (isset((new Request())->getParams()['hash']) && !isset($session)) {
            $hash = (new Request())->getParams()['hash'];
            $user = $this->getWhere('hash', $hash);
            if ($user) {
                $_SESSION['auth']['login'] = $user->login;
            }
        }
        return isset($_SESSION['auth']['login']);
    }

    public function getName()
    {
        return $_SESSION['auth']['login'];
    }
}
