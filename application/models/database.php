<?php
namespace Application\Models;
use mysqli;

/**
 *  class ORM
 */

class Database
{
    /**
     * Хранит информацию о подключение к БД
     * @var mysqli $conn
     */
    protected mysqli $conn;

    /**
     * Хранит SQL запрос
     * @var string $sqlQuery
     */
    protected  string $sqlQuery;

    /**
     * Указывает, возвращает ли запрос данные или нет
     * true -возвращает данные
     * false -не возвращает данные
     * @var bool $isGetResul
     */
    protected bool $isGetResul = false;

    public function __construct()
    {
        $this->conn = new mysqli(DB_SERVER_NAME, DB_USER_NAME, DB_PASSWORD, DB_DATABASE_NAME, DB_PORT);
        if ($this->conn->connect_error)
            die("Connection failed: " . $this->conn->connect_error);
    }

    /**
     * Выборка столбцов таблицы для формирования запроса
     * @param array ...$columns названия столбцов таблицы
     * @return $this
     */
    public function select( ...$columns): Database
    {
        $this->isGetResul = true;

        $stringOfColumns = implode(', ', $columns);

        $this->sqlQuery = "SELECT $stringOfColumns ";
        return $this;
    }

    /**
     * Формирования запроса для добавления данных в таблицу
     * @param string $nameTable название таблицы
     * @param array $columns ассоциативный массив [['Столбец' = 'значение'], ..]
     * @return $this
     */
    public function insert(string $nameTable, array $columns): Database
    {
        $stringOfColumns = implode(', ', array_keys($columns));
        $stringOfValues =  implode("', '", $columns);

        $this->sqlQuery = "INSERT INTO $nameTable ($stringOfColumns) VALUES ('$stringOfValues')";

        return $this;
    }

    /**
     * Формирования запроса для обновления данных в таблице
     * @param string $nameTable название таблицы
     * @return $this
     */
    public function update(string $nameTable): Database
    {
        $this->sqlQuery = "UPDATE $nameTable ";
        return $this;
    }

    /**
     * Формирования запроса для удаления строк в таблице
     * @param string $nameTable название таблицы
     * @return $this
     */
    public function delete(string $nameTable): Database
    {
        $this->sqlQuery = "DELETE FROM $nameTable ";
        return $this;
    }

    /** название таблиц которые будут присутствовать запросе
     * @param array ...$nameTable название таблицы
     * @return $this
     */
    public function from( ...$nameTable): Database
    {
        $stringOfTable = implode(', ', $nameTable);

        $this->sqlQuery .= "FROM $stringOfTable ";

        return $this;
    }

    /** объединяет таблицы по ключам
     * @param $type string тип соединения
     * @param $nameTable string название таблицы
     * @param $linkCondition string внешний и первичный ключ  id_PK = id_FK
     * @return $this
     */
    public function join(string $type, string $nameTable, string $linkCondition) : Database
    {
        $this->sqlQuery .= "$type JOIN $nameTable ON $linkCondition ";
        return $this;
    }

    /** условие для запроса
     * @param string $condition условие
     * @return $this
     */
    public function where(string $condition): Database
    {
        $this->sqlQuery .= " WHERE $condition ";
        return $this;
    }

    /** указывает в запросе какие столбцы должны быть обновлены и указывает новые значения для столбцов
     * @param array $columnsAndValues ассоциативный массив [['Столбец' = 'значение'], ..]
     * @return $this
     */
    public function set(array $columnsAndValues): Database
    {
        $stringOfColumnsAndValues = 'SET ';
        foreach ($columnsAndValues as $key => $value) {
            $stringOfColumnsAndValues .= "$key = '$value', ";
        }
        $stringOfColumnsAndValues[-2] = ' ';
        $this->sqlQuery .=$stringOfColumnsAndValues . ' ';

        return $this;
    }

    /** задает группировка по атрибутам
     * @param array ...$column названия столбцов таблицы
     * @return $this
     */
    public function groupBy(...$column): Database
    {
        $stringOfColumn = implode(', ', $column);
        $this->sqlQuery .= " GROUP BY $stringOfColumn ";
        return $this;
    }

    /** задает сортировку выходных значений.
     * @param array ...$column названия столбцов таблицы
     * @return $this
     */
    public function orderBy(...$column): Database
    {
        $stringOfColumn = implode(', ', $column);
        $this->sqlQuery .= " ORDER BY $stringOfColumn ";
        return $this;
    }

    /**
     * Выполняет запрос
     * @return array данные полученные после выполнения запроса
     */
    public function perform(): array
    {
        //echo $this->sqlQuery;
        $resultData = [];
        $resultQuery = $this->conn->query($this->sqlQuery);

        if($this->isGetResul) {
            while ($row = $resultQuery->fetch_assoc()) {
                $resultData[] = $row;
            }
        }
        return $resultData;
    }
}