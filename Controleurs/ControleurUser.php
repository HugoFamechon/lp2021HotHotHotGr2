<?php

final class ControleurUser
{
    public function defautAction()
    {
        header('Location: /user/login');
    }

    public function inscriptionAction() {
        if(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['pwd1']) && isset($_POST['pwd2'])){
            $mdp = password_hash($_POST['pwd1'], PASSWORD_DEFAULT);
            $Users = new User();
            $this->messageAction($Users->createUsers($_POST['name'],$_POST['firstname'],$_POST['email'], $mdp));
        } else {
            Vue::montrer('User/inscription');
        }
    }

    public function loginAction() {
        if(isset($_POST['email']) && isset($_POST['pwd'])){
            $Users = new User();
            $this->messageAction($Users->connexionUsers($_POST['email'], $_POST['pwd']));
        } else {
            Vue::montrer('User/login');
        }
    }

    public function logoutAction() {
        if(session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            session_start();
        }
        $_SESSION = array();
        if(session_destroy())
        {
           header('Location: /');
        }
    }

    // Affiche un message ainsi que la page de redirection en fonction du numéro de message
    public function messageAction($message) {
        if ($message === 0) {
            Vue::montrer('User/message', array('message' => '<p style="color:green;">Vous êtes inscrit avec succés</p>'));
            Vue::montrer('User/inscription');
        } else if($message === 1){
            Vue::montrer('User/message', array('message' => '<p style="color:red;">Vous avez déja créé un compte avec cet email, Veuillez vous connecter</p>'));
            Vue::montrer('User/inscription');
        } else if($message === 2){
            header('Location: /');
        } else if($message === 3){
            Vue::montrer('User/message', array('message' => '<p style="color:red;">Mot de passe incorrect</p>'));
            Vue::montrer('User/login');
        } else if($message === 4){
            Vue::montrer('User/message', array('message' => '<p style="color:red;">Email incorrect</p>'));
            Vue::montrer('User/login');
        }
    }

}