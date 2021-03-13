<?php

final class User
{
    private $name;
    private $firstname;
    private $email;
    private $password;

    public function __construct($name, $firstname, $email, $password)
    {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name ;
    }

    public function getFirstName()
    {
        return $this->firstname ;
    }

    public function getEmail()
    {
        return $this->email ;
    }

    public function getPassword()
    {
        return $this->password ;
    }

    public function getAll()
    {
        $this->getName();
        $this->getFirstName();
        $this->getEmail();
        $this->getPassword();
    }

    public function createUsers() {
        $DB = new Database();
        $DB->addRow("UserTable", [$this->getName(), $this->getFirstName(), $this->getEmail(), $this->getPassword()]);
    }

}