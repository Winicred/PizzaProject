<?php

class Database
{

    private $conn;
    private $host;
    private $user;
    private $password;
    private $baseName;

    function __construct()
    {
        $this->host = 'localhost'; //hostname
        $this->user = 'root'; //username
        $this->password = ''; //password
        $this->baseName = 'new_pizza2021'; //name of your database
        $this->connect(); //метод соединения с базой данных
    }

    function connect()
    {
        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ''
                . ';dbname=' . $this->baseName . '',
                $this->user,
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            //$this-> conn - идентификатор базы данных
        } catch (Exception $e) {
            die('Connection failed : ' . $e->getMessage());//вывод об ошибке соединения
        }

        return $this->conn;//$this-> conn - идентификатор базы данных
    }

    function __destruct()
    {
        $this->disconnect();
    }

    function disconnect()
    {
        if ($this->conn) {// автомтическое выключение/подключение к БД
            $this->conn = null;
        }
    }

    function getOne($query)
    {
        try {
            $result = $this->conn->prepare($query); // метод подготовки запроса
            $result->execute(); // метод выполнение запроса
            $result->setFetchMode(PDO::FETCH_ASSOC);// выборка данных по названию полей
            $response = $result->fetch();// одна строка - fetch() из таблицы после запроса
            // цикл не требуется
            return $response;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getAll($query)
    {
        try {
            $result = $this->conn->prepare($query); // метод подготовки запроса
            $result->execute(); // метод выполнение запроса

            $result->setFetchMode(PDO::FETCH_ASSOC);// выборка данных по названию полей
            $response = $result->fetchAll();// на выходе таблица данных (виртуальная) fetchAll()
            return $response;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    //----------------------- ЗАПРОСЫ ДЕЙСТВИЯ -----------------------------
    // ДЛЯ INSERT, UPDATE, DELETE
    //http://php.net/manual/ru/pdo.exec.php
    //PDO::exec — Запускает SQL запрос на выполнение и возвращает количество строк, задействованных в ходе его выполнения
    //запросы действия INSERT   UPDATE    DELETE
    function executeRun($query)
    {
        try {
            $response = $this->conn->exec($query);
            return $response;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}

?>