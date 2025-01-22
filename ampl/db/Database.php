<?php

namespace db;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct(
        $dbtype = "mysql",
        $config = [
            'host' => 'mysql',
            'dbname' => 'test_db',
            'charset' => 'utf8mb4',
            'port' => 3306,
        ],
        $username = 'user',
        $password = 'user_password'
    ) {
        $dsn = $dbtype . ':' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            http_response_code(404);
            die('not found');
        }

        return $result;
    }
}