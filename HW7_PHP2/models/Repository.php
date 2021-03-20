<?php


namespace app\models;


use app\engine\Db;

abstract class Repository
{
    abstract protected function getTableName();
    abstract protected function getEntityClass();

    /*public static function getAll()  //заккоментил пока не переделаем,  потому что в контроллере обрабатываем массивы а не объекты
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAllObjects($sql, static::class);
    }
*/

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function getWhere ($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$name} = :value";
        return Db::getInstance()->queryOneObject($sql, ['value' => $value ], static::class);
    }

    public function getCountWhere ($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE {$name} = :value";
        return Db::getInstance()->queryOne($sql, ['value' => $value ])['count'];
    }


    public function getLimit($limit) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);
    }

//CRUD Active Record

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function insert(Model $entity) {
        $params = [];
        $sql = "";
        $sqlValue = "";

        foreach ($entity->props as $key => $value) {
            $params["{$key}"] = $entity->$key;
            $sql .= "{$key}, ";
            $sqlValue .=":{$key}, ";
        }
        $tableName = $this->getTableName();
        $sql = mb_substr($sql, 0, -2);
        $sqlValue = mb_substr($sqlValue, 0, -2);
        $sql = "INSERT INTO {$tableName} ({$sql}) VALUES ({$sqlValue})";
        Db::getInstance()->execute($sql, $params);
        $entity->id = Db::getInstance()->lastInsertId();
    }


    public function update(Model $entity) {
        $params = [];
        $sql = "";
        foreach ($entity->props as $key => $value) {
            if (!$value) continue;
            $sql .= "{$key}=:{$key}, ";
            $params["{$key}"] = $entity->$key;
            $entity->props[$key] = false;
        }
        $params["id"] = $entity->id;
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET " . mb_substr($sql, 0, -2) . ' WHERE id = :id';
        Db::getInstance()->execute($sql, $params);
    }


    public function delete(Model $entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $entity->id]);
    }
    //END CRUD

    public function deleteAnd($name, $value, $name2, $value2) { //TODO убрал статику 18.03.21
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE {$name} = :value AND {$name2} = :value2";
        return Db::getInstance()->execute($sql, ['value' => $value , 'value2' => $value2 ]);
    }

    public function save(Model $entity) {
        if(is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }
}