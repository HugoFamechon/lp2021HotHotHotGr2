<?php


final class ControleurSensor
{
    public $DB;

    public function defautAction()
    {
        $this->LoadSensorDataAction();
    }

    private function loadDB(){
        if(!isset($this->DB))
            $this->DB = new Database();
    }
    private function AddSensors(array $Sensors){
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
                echo "<p>Added Sensor $n in DB</p>";
            }
        }
    }

    public function LoadSensorDataAction(array $A_get_parametres = null, array $A_post_parametres = null) {
        $this->loadDB();

        //On récupére les données du serv
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
        $remote_file_contents = file_get_contents('https://hothothot.dog/api/capteurs/');
        $data = json_decode($remote_file_contents, true);
        $Capteurs = $data['capteurs'];
        $this->AddSensors($Capteurs);


    }

    public function DisplayGroupsAction(array $A_get_parametres = null, array $A_post_parametres = null) {

    }

}