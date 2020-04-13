<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $db_name = "universitas";

    public $connection;

    public function getConnection() {
        $this->connection = null;
        try {
            $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
            $this->connection->exec("set names utf-8");
        } catch(PDOException $exception) {
            echo "Connection error: ".$exception->getMessage();
        }
        return $this->connection;
    }
}