<?php

class Sensor {

    public $DB;

    private function loadDB(){
        if(!isset($this->DB))
            $this->DB = new Database();
    }

    public function AddSensors(array $Sensors) {
        $this->loadDB();
        $returnString = '';
        $tableName = "Sensors";
        foreach ($Sensors as $sensor) {
            $isAlreadyInDB = false;
            foreach ($this->DB->SelectQuery($tableName, ["*"]) as $item) {
                if ($item['Name'] == $sensor['Nom'] && $item['Type'] == $sensor['type'] && $item['Location'] == $sensor['Nom']) {
                    $isAlreadyInDB = true;
                }
//                echo "<p>" . $item['Name'] . " == " . $sensor['Nom'] . " && " . $item['Type'] . "==" . $sensor['type'] . "&&" . $item['Location'] . "==" . $sensor['Nom'] . "</p>";
            }
            if (!$isAlreadyInDB) {
                // TODO : Mettre ça dans le modele plus tard
                $Fields = [$sensor['Nom'], $sensor['type'], "°C", $sensor['Nom']];
                $this->DB->addRow($tableName, $Fields);
                $n = $sensor['Nom'];
                $returnString = $returnString . "<p>Added Sensor $n in DB</p>";
            } else {
                $n = $sensor['Nom'];
                $returnString = $returnString . "<p>Sensor $n is already in DB</p>";
            }
        }
        return $returnString;
    }

    public function AddSensorsData(array $Sensors) {
        $this->loadDB();
        $returnString = '';
        // TODO : Changer l'userID par celui qu'on a dans la session, et, vérifier que si personne n'est co alors on n'ajoute pas à la bdd.
        $UserID = 1;
        if (isset($UserID)) {
            $tableName = "SensorsData";
            $SensortableName = "Sensors";
            foreach ($Sensors as $sensor) {
                $SensorID = null;
                $isSensorInDB = false;
                foreach ($this->DB->SelectQuery($SensortableName, ["*"]) as $item) {
                    if ($item['Name'] == $sensor['Nom'] && $item['Type'] == $sensor['type'] && $item['Location'] == $sensor['Nom']) {
                        $isSensorInDB = true;
                        $SensorID = $item['SensorID'];
                        $returnString = $returnString . $SensorID;
                    }
//                echo "<p>" . $item['Name'] . " == " . $sensor['Nom'] . " && " . $item['Type'] . "==" . $sensor['type'] . "&&" . $item['Location'] . "==" . $sensor['Nom'] . "</p>";
                }
                if ($isSensorInDB) {
                    // TODO : Mettre ça dans le modele plus tard
                    $Fields = [$UserID, $SensorID, $sensor['Timestamp'], $sensor['Valeur']];
                    $this->DB->addRow($tableName, $Fields);
                    $n = $UserID . "+" . $SensorID . "+" . $sensor['Timestamp'] . "+" . $sensor['Valeur'];
                    $returnString = $returnString . "<p>Added line $n in DB.$tableName</p>";
                }
            }
        }
        return $returnString;
    }

}
