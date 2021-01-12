<?php


final class ControleurGrouping
{
    public function defautAction()
    {
        if(isset($_GET['DisplayGroups'])){
            $this->DisplayGroupsAction(array($_GET['DisplayGroups']), array());
        } else {
            $O_Grouping = new Grouping();
            Vue::montrer('Grouping/voirForm', array('groups' => $O_Grouping->getNombreGroupe()));
        }
    }

    public function CreateGroupsAction(array $A_get_parametres = null, array $A_post_parametres = null) {
        if(isset($_GET['DisplayGroups'])){
            $this->DisplayGroupsAction(array($_GET['DisplayGroups']), $A_post_parametres);
        } else {
            $O_Grouping = new Grouping();
            Vue::montrer('Grouping/voirForm', array('groups' => $O_Grouping->getNombreGroupe()));
        }

    }

    public function DisplayGroupsAction(array $A_get_parametres = null, array $A_post_parametres = null) {
        if(isset($A_get_parametres[0])){

            $O_Grouping = new Grouping();
            Vue::montrer('Grouping/voirGroups', array('groups' => $O_Grouping->makeGroups($A_get_parametres[0])));
        } else {
            $O_Grouping = new Grouping();
            Vue::montrer('Grouping/voirGroups', array('groups' => $O_Grouping->makeGroups(4)));
        }

    }

}