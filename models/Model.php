<?php

namespace app\models;

abstract class Model 
{
    public $props = [];

    public function __set($name, $value)
    {
        if (
            array_key_exists($name, $this->props) &&
            $value != $this->$name)
        {
            $this->props[$name] = true;
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        return isset($this->name);
    }



}
