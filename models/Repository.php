<?php

namespace app\models;

use app\engine\Db;
use app\Interfaces\IRepository;

abstract class Repository implements IRepository
{

    protected abstract function getTableName();
    protected abstract function getEntityClass();

    public function getOne($id)
    {
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE id = :id";
        return Db::getInstance()->queryOneObject($sql, $this->getEntityClass(), ['id' => $id]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->getTableName();
        return  Db::getInstance()->queryAll($sql);
    }

    public function getLimit($offset,$limit=10){
        $sql = "SELECT * FROM " . $this->getTableName() . " LIMIT :offset, :limit";
        return Db::getInstance()->queryLimit($sql,$offset,$limit);
    }

    public  function getCount() {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} ";
        return Db::getInstance()->queryOne($sql);
    }

    public function insert(Model $entity)
    {
        foreach ($entity->props as $key => $value) {
            $columns[] = $key;
            $values[] = $entity->$key;
        }
        $query = array_combine($columns, $values);
        $values = implode(",:", $columns);
        $columns = implode(",", $columns);
        $sql = "INSERT INTO " . $this->getTableName() . " ($columns) VALUES(:$values)";
        Db::getInstance()->execute($sql, $query);
        $entity->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    public function update(Model $entity)
    {
        foreach ($entity->props as $key => $value) {
            if ($value) {
                $columns[] = $key;
                $values[] = $entity->$key;
                $entity->props[$key] = false;
            }
        }
        if(empty($columns)){
            return $this;
        }
        $query = array_combine($columns, $values);
        $quest = '';

        foreach ($query as $key => $value) {
            $quest = $quest . $key . " = '" . $value . "',";
        }

        $quest = rtrim($quest, ',');
        $sql = "UPDATE " . $this->getTableName() . " SET $quest WHERE id = :id";
        var_dump($sql);
        Db::getInstance()->execute($sql, ['id' => $entity->id]);
        $entity->id = Db::getInstance()->lastInsertId();
        return $this;
    }
    public function save(Model $entity)
    {
        if (is_null($entity->id)){
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }

    public function delete(Model $entity)
    {
        $sql = "DELETE FROM " . $this->getTableName() . " WHERE id = :id";
        Db::getInstance()->execute($sql, ['id' => $entity->id]);
    }


}
