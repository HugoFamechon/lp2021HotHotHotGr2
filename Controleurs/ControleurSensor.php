<?php


final class ControleurSensor
{

    public function defautAction()
    {
        $this->LoadSensorDataAction();
    }

    public function LoadSensorDataAction(array $A_get_parametres = null, array $A_post_parametres = null) {
        //On récupére les données du serv
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
        $remote_file_contents = file_get_contents('https://hothothot.dog/api/capteurs/');
        $data = json_decode($remote_file_contents, true);
        $Capteurs = $data['capteurs'];
        $O_Sensor = new Sensor();
        Vue::montrer('Sensor/AddSensorsData', array('Sensors' => $O_Sensor->AddSensors($Capteurs), 'SensorsData' => $O_Sensor->AddSensorsData($Capteurs)));
    }
}