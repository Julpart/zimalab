<?php

namespace app\controllers;

use app\engine\Render;
abstract class Controller
{
    private $render;

    public function __construct(Render $render)
    {
        $this->render = $render;
    }

    public function runAction($action)
    {
        $method = 'action' . ucfirst($action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die("404");
        }
    }

    public function render($template, $params = [])
    {
        return $this->renderTemplate('layouts/main', [
            'content' => $this->renderTemplate($template, $params)
        ]);
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }
}
