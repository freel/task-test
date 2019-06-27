<?php

namespace App\controllers;

use App\models\Task;
use App\models\User;

class TaskController
{
    private $model;
    private $validation_errors = [];

    /**
     * TaskController constructor.
     *
     * Создает экземпляр модели
     */
    public function __construct()
    {
        $this->model = new Task();
    }

    /**
     * Отображает основную страницу
     *
     * @param int $page - отображаемая страница
     * @throws \Exception
     */
    public function index($page = 1)
    {
        if (isset($_POST['page'])) {
            $this->model->page = $_POST['page'];
        }
        if (isset($_POST['sort'])) {
            $this->model->sort = $_POST['sort'];
        }
        if (isset($_POST['order'])) {
            $this->model->order = $_POST['order'];
        }

        $pages_count = $this->model->getPages();

        $list = $this->model->readList($page);

        $list
            ? require_once "App/views/task/index.php"
            : require_once "App/views/task/empty.php";
    }

    /**
     * Создаёт задачу
     */
    public function create()
    {
        $name = $this->validateUser();
        $email = $this->validateEmail();
        $task = $this->validateTask();

        if (!$this->validation_errors && $name && $email && $task) {
            $this->model->create($name, $email, $task);
        }

        require_once "App/views/task/create.php";
    }

    /**
     * Изменяет задачу, сохраняет только если пользователь зарегистрирован
     *
     * @param $id
     * @throws \Exception
     */
    public function edit($id)
    {
        $task_row = $this->model->read($id);

        if ($_POST['task'] || $_POST['status'] && !User::isGuest()) {
            $task_row['task'] = $this->validateTask();
            $task_row['status'] = $this->validateStatus();

            if (!$this->validation_errors && $task_row['task'] && $task_row['status']) {
                $this->model->update($id, $task_row['task'], $task_row['status']);
            }
        }

        require_once "App/views/task/edit.php";
    }

    /**
     * Валидация Имени пользователя
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
     * Валидация описания задачи
     *
     * @return bool|mixed
     */
    private function validateTask()
    {
        if (isset($_POST['task'])) {
            $task = $_POST['task'];
            if (!strlen($task)) {
                $this->validation_errors[] = "Task must be not empty";
            }
            return $task;
        }
        return false;
    }

    /**
     * Валидация почтового ящика
     *
     * @return bool|mixed
     */
    private function validateEmail()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->validation_errors[] = "Incorrect email";
            }
            return $email;
        }
        return false;
    }

    /**
     * Валидация статуса
     *
     * @return bool|mixed
     */
    private function validateStatus()
    {
        if (isset($_POST['status'])) {
            $status = $_POST['status'];
            if (!in_array($status, array_keys($this->model->statuses))) {
                $this->validation_errors[] = "Incorrect status";
            }
            return $status;
        }
        return false;
    }
}
