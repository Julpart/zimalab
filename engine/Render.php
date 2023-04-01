<?php

namespace app\engine;

class Render
{
    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        include VIEWS_DIR . $template . ".php";
        return ob_get_clean();
    }
}
