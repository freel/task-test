<?php

namespace App\conf;

class Routes
{
    /**
     * Описание роутов
     * слева uri, справа модель/действие/переменная из uri
     * @return array
     */
    public static function routes()
    {
        return [
            '^$' => 'task/index',
            '^([0-9]+$)' => 'task/index/$1',
            'task/create' => 'task/create',
            'task/edit/([0-9]+)' => 'task/edit/$1',
            'task/update/([0-9]+)' => 'task/update/$1',
            'admin/login' => 'user/login',
            'admin/logout' => 'user/logout',
        ];
    }
}
