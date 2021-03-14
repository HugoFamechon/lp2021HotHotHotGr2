<?php

final class User
{
    public $name;
    public $firstname;
    public $email;
    public $password;
    public $db;

    private function loadDB(){
        if(!isset($this->db))
            $this->db = new Database();
    }

    public function createUsers($name, $firstname, $email, $password) {
        $this->loadDB();
        $this->name = $name;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
        $users = $this->db->SelectQuery('UserTable', ['*']);
        $isAlready = false;
        foreach ($users as $user) {
            if($user['email'] === $email)
            {
                $isAlready = true;
            }
        }
        if (!$isAlready) {
            $this->db->addRow("UserTable", [$this->name , $this->firstname, $this->email, $this->password]);
            return 0;
        } else {
            return 1;
        }  
    }

    public function connexionUsers($email, $pwd) {
        if(session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            session_start();
        }
        $this->loadDB();
        $tableName = 'UserTable';
        $users = $this->db->SelectQuery($tableName, ['*']);
        foreach ($users as $user) {
            if($user['email'] === $email)
            {  
                if(password_verify($pwd,$user['Password']))
                {
                    $_SESSION['email'] = $email;
                    $_SESSION['UserID'] = $user['UserID'];
                    $_SESSION['Nom'] = $user['Nom'];
                    $_SESSION['Prenom'] = $user['Prenom'];
                    $_SESSION["loggedin"] = true;
                    return 2;
                }
                else
                {
                    return 3;
                }
            }
        }
        return 4;
        
    }

}