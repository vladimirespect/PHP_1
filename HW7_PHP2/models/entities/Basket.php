<?php

namespace app\models\entities;

use app\engine\Db;
use app\models\Model;

class Basket extends Model
{
    protected $id = null;
    protected $session_id;
    protected $goods_id;
   // public $id_;//поле для будущих связей

    protected $props = [
        'session_id' => false,
        'goods_id' => false
    ];

//	Alt + Insert
    public function __Construct($session_id = null, $goods_id = null) {
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }




}