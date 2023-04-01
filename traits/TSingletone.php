<?php

namespace app\traits;

trait TSingletone
{
    private static $instatnce = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (is_null(static::$instatnce)) {
            static::$instatnce = new static();
        }
        return static::$instatnce;
    }
}
