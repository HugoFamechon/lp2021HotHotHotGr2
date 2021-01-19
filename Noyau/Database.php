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
    private $DB_tables;
    private $DB_tableFields;
    private $AutoIncrementPrimaryKeys;


    public function __construct(){
        $ini_file = parse_ini_file ( './Database.ini');
        $this->host = $ini_file['host'];
        $this->db = $ini_file['db'];
        $this->user = $ini_file['user'];
        $this->pass = $ini_file['pass'];
        $this->charset = $ini_file['charset'];
        $this->dsn = "mysql:host=$this->host";

        $this->AutoIncrementPrimaryKeys = [];

        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            $this->createDB();
            $this->CreateTables();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function createDB() {
        $this->pdo->exec("CREATE DATABASE IF NOT EXISTS `$this->db`;
                CREATE USER '$this->user'@'$this->host' IDENTIFIED BY '$this->pass';
                GRANT ALL ON `$this->db`.* TO '$this->user'@'$this->host';
                FLUSH PRIVILEGES;");
    }

    public function createTables() {
        $json_file = json_decode(file_get_contents("./Database.json"), true);
        $i = 0;
        $this->DB_tables = $json_file["DB_TABLES"];
        $this->DB_tableFields = $json_file["DB_TABLES_FIELDS"];
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
            $ParsedFields = $ParsedFields . $Field["FieldName"] . " " . $Field["FieldType"] . ",";
        }

        // on cherche le nombre de PK pour savoir comment on ecris la contrainte PRIMARY KEY et
        // on cherche le nombre de FK pour savoir comment on ecris la contrainte FOREIGN KEY
        foreach ($Fields[$index] as $Field) {
            if ($Field["PK"]) {
                array_push($this->AutoIncrementPrimaryKeys, $TableName . "." . $Field["FieldName"]);
               $nbPK++;
               $Constraint_Name = $Constraint_Name . "_" . $Field["FieldName"];
            }

            if (isset($Field["ForeignKeyTable"]) && $Field["ForeignKeyTable"]) {
               $nbFK++;
            }
        }

        if($nbPK > 1)
        {
            $PK = "CONSTRAINT " . $Constraint_Name . " PRIMARY KEY (";
        }

//        echo "<p>nbPK = $nbPK </p>";
//        echo "<p>nbFK = $nbFK </p>";

        if ($nbPK === 0) {
            throw new Exception('Une table doit forcement contenir au moins une clé primaire ! / A table must contain at least one Primary Key !');
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
                else if($nbPKCount === $nbPK-1)
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
        if ($nbFK > 0 && $nbPK > 0)
            $PK = $PK . ",";


        //on construit la contrainte de FK
        foreach ($Fields[$index] as $Field) {
            if(isset($Field["ForeignKeyTable"]))
            {
                if($nbFKCount === $nbFK-1){
                    $FK = $FK . "FOREIGN KEY (" . $Field["ForeignKey"] . ") REFERENCES " . $Field["ForeignKeyTable"] . "(" . $Field["ForeignKey"] .")";
                } else {
                    $FK = $FK . "FOREIGN KEY (" . $Field["ForeignKey"] . ") REFERENCES " . $Field["ForeignKeyTable"] . "(" . $Field["ForeignKey"] ."), ";
                }
                $nbFKCount++;
            }
        }
        $request = "CREATE TABLE IF NOT EXISTS " . "$this->db." . $TableName . "(" . $ParsedFields . $PK . $FK . ");";
//        echo "<p>$request</p>";
        $this->pdo->exec($request);
    }

    public function addRow($tableName, array $Fields) {
        if (in_array($tableName, $this->DB_tables)) {
            try {
                $request = "INSERT INTO $this->db.$tableName (";

                $iterations = count($this->DB_tableFields[array_search($tableName, $this->DB_tables)]);

                // Pour ne pas qu'il prennent en compte les clès en auto increment
                $onlyOnce = true;
                foreach ($this->DB_tableFields[array_search($tableName, $this->DB_tables)] as $fieldName) {
                    if (in_array($this->AutoIncrementPrimaryKeys, $fieldName) && $onlyOnce) {
                        $iterations--;
                    }
                }

                echo "<p>Iteration = $iterations</p>";
                $i = 0;
                foreach ($this->DB_tableFields[array_search($tableName, $this->DB_tables)] as $fieldName) {
                    if(!in_array($this->AutoIncrementPrimaryKeys, $fieldName)) {
                        if ($i === $iterations)
                        {
                            $request = $request . $fieldName["FieldName"];
                        } else {
                            $request = $request . $fieldName["FieldName"] . ",";
                        }
                    }
                    $i++;
                }

                $request = $request . ") VALUES (";
                $iterations = count($Fields);
                $i = 0;
                foreach ($Fields as $field) {
                    if ($i === $iterations-1)
                    {
                        $request = $request . "'$field'";
                    } else {
                        $request = $request . "'$field'" . ",";
                    }
                    $i++;
                }

                $request = $request . ");";
                echo "<p>$request</p>";
                $this->pdo->exec($request);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        } else {
            throw new Exception("IL N'EXISTE PAS DE TABLE $tableName DANS LA BDD");
        }

    }


}