<?php

namespace app\controllers;

use app\engine\Request;
use app\models\entities\User;
use app\models\repositories\UserRepository;

class UserController extends Controller
{
    public function actionIndex()
    {
        $sizePage = 10;
        $userRepo = new UserRepository();
        $page = (new Request())->getParams()['page'] ?? 1;
        $users = $userRepo->getLimit(($page - 1) * $sizePage);
        $totalRows = $userRepo->getCount();
        $totalPages = ceil($totalRows['count'] / $sizePage);
        echo $this->render('index', [
            'users' => $users,
            'page' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function actionDestroy()
    {
        $userRepo = new UserRepository();
        $id = (new Request())->getParams()['id'];
        $page = (new Request())->getParams()['page'];
        $user = $userRepo->getOne($id);
        $userRepo->delete($user);
        header('Location: /user/index/?page='.$page);
        exit();
    }

    public function actionCreate()
    {
        echo $this->render('form');
    }

    public function actionStore()
    {
        $userRepo = new UserRepository();
        $input = (new Request())->getParams();

        foreach ($input as &$item) {
            if(empty($item)){
                $item = null;
            }
        }

        $user = new User(
            $input['firstName'],
            $input['lastName'],
            $input['email'],
            $input['companyName'],
            $input['position'],
            (isset($input['phoneNumber1']) ? str_replace('-','',$input['phoneNumber1']):null),
            (isset($input['phoneNumber2']) ? str_replace('-','',$input['phoneNumber2']):null),
            (isset($input['phoneNumber3']) ? str_replace('-','',$input['phoneNumber3']):null)
        );

        $userRepo->save($user);
        header('Location: /user/index/');
        exit();
    }

    public function actionEdit()
    {
        $userRepo = new UserRepository();
        $id = (new Request())->getParams()['id'];
        $page= (new Request())->getParams()['page'];
        $user = $userRepo->getOne($id);
        echo $this->render('form',[
            'user' => $user,
            'id' => $id,
            'page' => $page,
        ]);
    }

    public function actionUpdate()
    {
        $userRepo = new UserRepository();
        $input = (new Request())->getParams();
        $page = $input['page'];
        $user = $userRepo->getOne($input['id']);

        foreach ($input as $key => $item) {
            $user->$key=$item;
        }

        $userRepo->save($user);
        header('Location: /user/index/?page=' . $page);
        exit();
    }
}