<?php


final class ControleurSensor
{
    public function defautAction()
    {
        $this->LoadSensorDataAction();
    }

    public function LoadSensorDataAction(array $A_get_parametres = null, array $A_post_parametres = null) {
        echo 'LoadSensorDataAction';
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
        $remote_file_contents = file_get_contents('https://hothothot.dog/api/capteurs/');
        $data = json_decode($remote_file_contents, true);
        var_dump($data);
        var_dump(date("d/m/y",$data['capteurs'][0]['Timestamp']));
        var_dump(time());
    }

    public function DisplayGroupsAction(array $A_get_parametres = null, array $A_post_parametres = null) {

    }

}