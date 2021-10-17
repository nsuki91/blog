<?php

namespace nsuki;

require_once __ROOT__.'/src/config.php';

class Database
{
    public $connection;

    public function __construct()
    {
        $this->connectDb();
    }

    public function connectDb()
    {
        $this->connection = new \mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

        if($this->connection->connect_errno) {
            die("Connection failed" . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);

        $this->confirmQuery($result);

        return $result;
    }

    private function confirmQuery($result)
    {
        if(!$result) {
            die('Query failed' . $this->connection->error);
        }
    }

    public function escapeString($string)
    {
        $escapedString = $this->connection->real_escape_string($string);
        return $escapedString;
    }

    public function insertID()
    {
        return $this->connection->insert_id;
    }
}