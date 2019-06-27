<?php

namespace App\conf;

class DBConf
{
    /**
     * Настройки БД
     * @return array
     */
    public static function config()
    {
        return [
            "host" => "db",
            "user" => "beejee",
            "pass" => "beejee",
            "db" => "beejee"
        ];
    }
}
