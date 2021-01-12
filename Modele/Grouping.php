<?php

final class Grouping
{
    // on met 4 groupes pour l'instant
    private $_I_nombreEleveGroup = 4;
    private $_A_jsonStudents;
    private $_A_Groups;

    public function __construct()
    {
        // On charge le JSON
        $this->_A_jsonStudents = json_decode(file_get_contents(__DIR__."\..\Assets\data.json"));
    }

    public function getNombreGroupe()
    {
        return $this->_I_nombreEleveGroup ;
    }

    public function getStudentArray()
    {
        return $this->_A_jsonStudents ;
    }

    public function makeGroups($StudentPerGroups) {

        if(isset($StudentPerGroups) && intval($StudentPerGroups) !== 0){
            $this->_I_nombreEleveGroup = intval($StudentPerGroups);
        }
        $A_CopyJson = $this->_A_jsonStudents;
        $nbIteration = 0;


        while(sizeof($A_CopyJson) > 0)
        {

            for($i = 0 ; $i < $this->_I_nombreEleveGroup ; $i++) {
                if (sizeof($A_CopyJson) > 0)
                {
                    $rand = random_int(0, sizeof($A_CopyJson)-1);
                    $this->_A_Groups[$nbIteration][$i] = $A_CopyJson[$rand];
                    unset($A_CopyJson[$rand]);
                    sort($A_CopyJson);
                }
            }
            $nbIteration++;
        }
        //var_dump($this->_A_Groups[0][0]->prenom);
        return $this->_A_Groups ;
    }

}