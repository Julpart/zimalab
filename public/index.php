<?php

use app\engine\{Autoload, Request, Render};

include "../engine/Autoload.php";
include "../config/config.php";
require_once '../vendor/autoload.php';

spl_autoload_register([new Autoload(), "loadClass"]);

try {
    $request = new Request();
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $controllerName = @$request->getControllerName();

    if(empty($controllerName)){
        header('Location: /user/index/');
        exit();
    }

    $actionName = @$request->getActionName();
    $controllerClass =  CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new Render());
        $controller->runAction($actionName);
    } else {
        die("Error 404");
    }
} catch (PDOException $e) {
    var_dump($e->getMessage());
} catch(Exception $e){
    var_dump($e);
}













