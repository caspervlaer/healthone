<?php


namespace model;


class User
{
    private $name;
    private $wachtwoord;
    private $role;
    private $id;

    public function getName()
    {
        return $this->name;
    }

    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getId()
    {
        return $this->id;
    }

    /*public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }*/


}