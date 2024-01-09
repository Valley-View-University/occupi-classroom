<?php

namespace Core;

use Exception;
use PDO;

class Database
{
    public $connection;
    public $statement;

    /**
     * @param $dsn_param
     * @param $username
     * @param $password
     */
    public function __construct($dsn_param, $username, $password)
    {
        $dsn = 'mysql:' . http_build_query($dsn_param, '', ';');
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    /**
     * @param $query
     * @param $params
     * @return $this|mixed|string
     */
    public function query($query, $params = [])
    {
        try {
            $this->statement = $this->connection->prepare($query);

            $this->statement->execute($params);

            return $this;

        } catch (Exception) {
            return $this->statement->errorInfo()[2];
        }

    }

    /**
     * @return mixed
     */

    public function get()
    {
        return $this->statement->fetchAll();
    }

    /**
     * @return mixed
     */
    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            abort();
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function find()
    {
        return $this->statement->fetch();
    }
}
