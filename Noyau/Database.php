<?php

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
        $ini_file = parse_ini_file ( './Database.ini');
        $this->host = $ini_file['host'];
        $this->db = $ini_file['db'];
        $this->user = $ini_file['user'];
        $this->pass = $ini_file['pass'];
        $this->charset = $ini_file['charset'];
        $this->dsn = "mysql:host=$this->host";


        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            $this->createDB();
            $this->CreateTables();
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

    public function createTables() {
        $json_file = json_decode("./Database.json");
        $i = 0;
        foreach ($json_file["DB_TABLES"] as $tables){
            $this->CreateTable($i, $tables, $json_file["DB_TABLES_FIELDS"]);
            $i++;
        }

    }

    public function createTable($index, $TableName, $Fields) {
        $ParsedFields = "";
        $PK = "";
        $nbPK = 0;
        $nbFK = 0;
        $Constraint_Name = "PK";
        $FK = "";
        $nbPKCount = 0;
        $nbFKCount = 0;

        //On construit la creation de la table avec les champs
        foreach ($Fields[$index] as $Field) {
            echo $Field["FieldName"];
            $ParsedFields = $ParsedFields . $Field["FieldName"] . " " . $Field["FieldType"] . ",";
        }

        // on cherche le nombre de PK pour savoir comment on ecris la contrainte PRIMARY KEY et
        // on cherche le nombre de FK pour savoir comment on ecris la contrainte FOREIGN KEY
        foreach ($Fields[$index] as $Field) {
            if ($Field["PK"]) {
               $nbPK++;
               $Constraint_Name = $Constraint_Name . "_" . $Field["FieldName"];
            }

            if ($Field["ForeignKeyTable"]) {
               $nbFK++;
            }
        }

        if($nbPK > 1)
        {
            $PK = "CONSTRAINTS " . $Constraint_Name . " PRIMARY KEY (";
        }

        //on construit la contrainte de PK
        foreach ($Fields[$index] as $Field) {
            //s'il y a plusieurs elements qui font une PK
            if($Field["PK"] && $nbPK > 1)
            {
                if($nbPKCount === 0)
                {
                    $PK = $PK . $Field["FieldName"];
                }
                else if($nbPKCount === $nbPK)
                {
                    $PK = $PK . "," . $Field["FieldName"] . ")";
                }
                else
                {
                    $PK = $PK . "," . $Field["FieldName"];
                }
                $nbPKCount++;
            } else if ($Field["PK"]) {
                $PK = $PK . "PRIMARY KEY (" . $Field["FieldName"] . ")";
            }
        }
        //on rajoute la virgule s'il y a des clés étrangères
        if ($nbFK > 0)
            $PK = $PK . ",";

        //on construit la contrainte de FK
        foreach ($Fields[$index] as $Field) {
            if(isset($Field["ForeignKeyTable"]))
            {
                if($nbFKCount == $nbFK){
                    $FK = $FK . "FOREIGN KEY (" . $Field["ForeignKey"] . ") REFERENCES " . $Field["ForeignKeyTable"] . "(" . $Field["ForeignKey"] .")";
                } else {
                    $FK = $FK . "FOREIGN KEY (" . $Field["ForeignKey"] . ") REFERENCES " . $Field["ForeignKeyTable"] . "(" . $Field["ForeignKey"] ."),";
                }
                $nbFKCount++;
            }
        }
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS `$this->db`.`$TableName`(`$ParsedFields`.`$PK`.`$FK`);
        ");
    }

    public static function echoString($myString) {
        echo $myString;
    }


}