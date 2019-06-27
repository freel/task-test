<?php

namespace App\models;

use App\core\DB;

class Task
{
    const PER_PAGE = 3;
    const SORT_DEFAULT = 'id';
    const ORDER_DEFAULT = 'id';

    private $DB;
    private $table_name = "tasks";
    private $fields = [
        'id',
        'user',
        'email',
        'task',
        'status',
    ];

    public $sort;
    public $order;
    public $page = 1;
    public $statuses = [
        0 => 'new',
        1 => 'active',
        2 => 'complete'
    ];

    /**
     * Task constructor.
     *
     * Подключает базу
     * Присваивает значения сессии
     */
    public function __construct()
    {
        $this->DB = new DB();

        if (!isset($_SESSION['sort'])) {
            $_SESSION['sort'] = self::SORT_DEFAULT;
        }
        $this->sort = &$_SESSION['sort'];

        if (!isset($_SESSION['order'])) {
            $_SESSION['order'] = self::ORDER_DEFAULT;
        }
        $this->order = &$_SESSION['order'];
    }

    /**
     * Создает задачу
     *
     * @param $user string имя пользователя
     * @param $email string почта
     * @param $text string текст задачи
     * @throws \Exception
     */
    public function create($user, $email, $text)
    {
        $values = [
            'user' => $user,
            'email' => $email,
            'task' => $text,
            'status' => 0
        ];

        $this->DB->create($this->table_name, $values);
    }

    /**
     * Обновляет задачу
     *
     * @param $id int идентификатор задачи
     * @param $text string новый текст
     * @param $status int новый статус
     * @throws \Exception
     */
    public function update($id, $task, $status)
    {
        $values = [
            'task' => $task,
            'status' => $status,
        ];

        $this->DB->update($this->table_name, $values, "id=${id}");
    }

    /**
     * Читает список задач, с учётом пагинации
     *
     * @param int $page страница
     * @param int $per_page количество на странице
     * @return bool
     * @throws \Exception
     */
    public function readList($page = 0, $per_page = self::PER_PAGE)
    {
        $start = $per_page * ($page - 1);
        $list = $this->DB->read($this->table_name, implode(",", $this->fields), "id>0", "$start, $per_page", $this->sort, $this->order);
        return array_map(function ($el) {
            $el['status'] = $this->statuses[$el['status']];
            return $el;
        }, $list);
    }

    /**
     * Читает единственную задачу
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function read($id)
    {
        return $this->DB->read($this->table_name, implode(",", $this->fields), "id=${id}", 1)[0];
    }

    /**
     * Возвращает число страниц
     *
     * @param int $per_page
     * @return float
     * @throws \Exception
     */
    public function getPages($per_page = self::PER_PAGE)
    {
        $rows_count = $this->DB->read($this->table_name, "COUNT(id)", "id>0")[0]["COUNT(id)"];
        $pages_count = ceil($rows_count / $per_page);

        return $pages_count;
    }
}
