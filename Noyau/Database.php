<?php

//Classe pas fini
final class Database {

    private $pdo;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;
    private $dsn;
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];


    public function __construct(){
        $ini_file = json_decode('./Database.ini');
        $this->host = $ini_file['host'];
        $this->db = $ini_file['db'];
        $this->user = $ini_file['user'];
        $this->pass = $ini_file['pass'];
        $this->charset = $ini_file['charset'];
        $this->dsn = "mysql:host=$this->host";

        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            $this->createDB();
            $this->CreateTables($ini_file);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        var_dump($this->pdo);
    }

    public function createDB() {
        $this->pdo->exec("CREATE DATABASE IF NOT EXISTS `$this->db`;
                CREATE USER '$this->user'@'$this->host' IDENTIFIED BY '$this->pass';
                GRANT ALL ON `$this->db`.* TO '$this->user'@'$this->host';
                FLUSH PRIVILEGES;");
    }
    public function createTables(array $ini_file) {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `$this->db`.`$ini_file['pass']`(
                USER_ID INT NOT NULL AUTO_INCREMENT,
                Nom VARCHAR(100) NOT NULL,
                Prenom VARCHAR(100) NOT NULL,
                Mail VARCHAR(100) NOT NULL
            ); ");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `$this->db`.TEMP_HISTORY; ");
    }

    public static function echoString($myString) {
        echo $myString;
    }


}