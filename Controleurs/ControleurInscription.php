<?php

final class ControleurInscription
{
    public function defautAction()
    {
        if(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['confpsw'])){
            $this->DisplayUsersAction(array(), array($_POST['name'],$_POST['firstname'],$_POST['email'],$_POST['psw']));
        } else {
            Vue::montrer('User/inscription');
        }
    }

    public function DisplayUsersAction(array $A_get_parametres = null, array $A_post_parametres = null) {
        if(isset($A_post_parametres[0]) && isset($A_post_parametres[1]) && isset($A_post_parametres[2]) && isset($A_post_parametres[3])){
            $mdp = password_hash($A_post_parametres[3], PASSWORD_DEFAULT);
            $Users = new User($A_post_parametres[0],$A_post_parametres[1],$A_post_parametres[2], $mdp);
            Vue::montrer('User/login', array('users' => $Users->createUsers()));
        } else {
            Vue::montrer('User/inscription');
        }

    }

}