<?php

class DB
{
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $charset;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->dbname = "movies";
        $this->user = "root";
        $this->pass = "";
        $this->charset = "utf8";
    }

    public function connect()
    {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $connect = new PDO($dsn, $this->user, $this->pass, $options);
            return $connect;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}