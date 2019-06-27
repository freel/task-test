<?php

namespace App\core;

use App\conf\DBConf;
use Exception;
use mysqli;

class DB
{
    private $connection;

    private $connection_settings;

    /**
     * DB constructor.
     * @param null $connection_settings
     */
    function __construct($connection_settings = null)
    {
        $this->connection_settings
            = !is_null($connection_settings)
            ? $connection_settings
            : DBConf::config();
    }

    /**
     * Подключение к БД
     *
     * @return bool
     * @throws Exception
     */
    private function connect()
    {
        if ($this->connection instanceof mysqli && $this->connection->ping()) {
            return true;
        }

        $conn = new mysqli(
            $this->connection_settings["host"],
            $this->connection_settings["user"],
            $this->connection_settings["pass"],
            $this->connection_settings["db"]
        );

        if ($conn->connect_error) {
            throw new Exception($conn->connect_error);
        }

        $this->connection = $conn;
    }

    /**
     * Отключение от БД
     */
    private function disconnect()
    {
        if ($this->connection instanceof mysqli && $this->connection->ping()) {
            $this->connection->close();
        }
    }

    /**
     * Создание записи в БД
     *
     * @param string $table имя таблицы
     * @param array $values_array массив данных
     * @param bool $close флаг завершения сессии
     * @throws Exception
     */
    public function create($table, $values_array, $close = false)
    {
        $this->connect();

        $rows = implode(",", array_keys($values_array));
        $vals = implode(",", array_map(function ($el) {
            return "'${el}'";
        }, $values_array));

        $sql = "INSERT INTO ${table} (${rows}) VALUES (${vals})";

        $query = $this->connection->query($sql);
        if (!$query) {
            throw new \Exception($this->connection->error);
        }

        if ($close) {
            $this->disconnect();
        }
    }

    /**
     * Чтение записи
     *
     * @param string $table имя таблицы
     * @param string $cols имена переменных
     * @param string $condition условие
     * @param int $limit лимит
     * @param string $group_by группировка
     * @param bool $order порядок
     * @param bool $close флаг завершения сессии
     * @return bool
     * @throws Exception
     */
    public function read($table, $cols, $condition, $limit = 3, $group_by = "id", $order = true, $close = false)
    {
        $this->connect();

        $ord = $order ? "ASC" : "DESC";

        $sql = "SELECT ${cols} FROM ${table} WHERE ${condition} ORDER BY ${group_by} ${ord} LIMIT ${limit}";

        $query = $this->connection->query($sql);
        if (!$query) {
            throw new \Exception($this->connection->error);
        }

        $result = ($query->num_rows > 0) ? $query->fetch_all(MYSQLI_ASSOC) : null;

        if ($close) {
            $this->disconnect();
        }

        return $result;
    }

    /**
     * Обновление записи
     *
     * @param string $table имя таблицы
     * @param array $values_array массив значений
     * @param bool $close флаг завершения сессии
     * @throws Exception
     */
    public function update($table, $values_array, $condition, $close = false)
    {
        $this->connect();

        foreach ($values_array as $key => $value) {
            $set_vals[] = "${key}='${value}'";
        }
        $vals = implode(",", $set_vals);

        $sql = "UPDATE ${table} SET ${vals} WHERE ${condition}";

        $query = $this->connection->query($sql);
        if (!$query) {
            throw new \Exception($this->connection->error);
        }

        if ($close) {
            $this->disconnect();
        }
    }
}
