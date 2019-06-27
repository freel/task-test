<?php


namespace App\controllers;


use App\models\User;

class UserController
{
    public $user = null;

    private $validation_errors = [];

    /**
     * Вход пользователя
     */
    public function login()
    {
        if (User::isGuest()) {
            $name = $this->validateUser();
            $password = $this->validatePassword();
            if (!$this->validation_errors && $name && $password) {
                if (User::login($name, $password)) {
                    require_once "App/views/user/logged.php";
                    return;
                };
                $this->validation_errors = "Invalid login or password!";
            }

            require_once "App/views/user/login.php";
            return;
        }
        require_once "App/views/user/logged.php";
    }

    /**
     * Выход пользователя
     */
    public function logout()
    {
        User::logout();
        require_once "App/views/user/logout.php";
    }

    /**
     * Валидация имени пользователя
     *
     * @return bool|mixed
     */
    private function validateUser()
    {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            if (strlen($name) < 3) {
                $this->validation_errors[] = "User name must be more than 3 characters";
            }
            return $name;
        }
        return false;
    }

    /**
     * Валидация пароля
     *
     * @return bool|mixed
     */
    private function validatePassword()
    {
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            if (strlen($password) < 3) {
                $this->validation_errors[] = "Password must be more than 3 characters";
            }
            return $password;
        }
        return false;
    }
}
