<?php

namespace app\models\repositories;

use app\engine\Session;
use app\models\Repository;
use app\models\entities\User;

class UserRepository extends Repository
{
    protected function getTableName()
    {
        return "users";
    }

    protected  function getEntityClass()
    {
        return User::class;
    }
}