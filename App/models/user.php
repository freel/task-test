<?php


namespace App\models;


class User
{
    const USER_NAME = "admin";
    const USER_PASS = "123";

    /**
     * Логин
     *
     * @param $user имя пользователя
     * @param $password пароль
     * @return bool true если есть такой пользователь
     */
    public static function login($user, $password)
    {
        if ($user == self::USER_NAME && $password == self::USER_PASS) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    /**
     * Выход пользователя
     * завершает сессию пользователя
     */
    public static function logout()
    {
        unset($_SESSION['user']);
    }

    /**
     * Проверка текущего пользователя
     *
     * @return bool false если пользователь выполнил вход
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
}
