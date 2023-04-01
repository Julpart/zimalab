<?php

namespace app\engine;

use app\traits\TSingletone;

class Db
{
    private $connection = null;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3306',
        'login' => 'root',
        'password' => '',
        'database' => 'zimalab',
        'charset' => 'utf8'
    ];

    use TSingletone;

    private function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->prepareDsnString(), $this->config['login'], $this->config['password']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function prepareDsnString()
    {
        return sprintf(
            "%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']

        );
    }

    public function lastInsertId(){
        return $this->connection->lastInsertId();
    }

    private function query($sql, $params)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->execute($params);
        return $STH;
    }

    public function queryOneObject($sql,$class,$params = [])
    {
        $STH = $this->query($sql, $params);
        $STH->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,$class);
        $obj = $STH->fetch();

        if(!$obj) {
            throw new \Exception("Error 404", 404);
        }

        return $obj;
    }

    public function queryLimit($sql,$offset,$limit){
        $STH = $this->getConnection()->prepare($sql);
        $STH->bindValue('offset', $offset, \PDO::PARAM_INT);
        $STH->bindValue('limit', $limit, \PDO::PARAM_INT);
        $STH->execute();
        return $STH->fetchAll();
        
    }

    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }
   
}
