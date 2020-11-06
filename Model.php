<?php
namespace model;
use model\Drug;
include_once("model/Drug.php");
use model\Patient;
include_once ("model/Patient.php");

class Model
{
    private $drug;
    private $patient;
    private $user;
    public $content;
    private $database;

    public function __construct()
    {
        $this->content = "<form method='post' action='index.php'>
                           Name: <input type='text' name='name'>
                           Wachtwoord: <input type='text' name='wacht'>
                           <input type='submit'>";
    }

    private function makeConnection(){
        $this->database = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");
    }

    public function insertUser($naam,$wacht,$roles){
        $this->makeConnection();
        if($naam !='')
        {
            $query = $this->database->prepare (
                "INSERT INTO `users` (`id`, `naam`, `wacht`, `roles`) 
                VALUES (NULL, :naam, :wacht, :roles)");
            $query->bindParam(":naam", $naam);
            $query->bindParam(":wacht", strtoupper(hash("sha256", $wacht)));
            $query->bindParam(":roles", $roles);
            $result = $query->execute();
            return $result;
        }
        return -1;
    }

    public function login($username, $wachtwoord){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `users` WHERE `users`.`username` =:username');
        $selection->bindParam(":username",$username);
        $result = $selection ->execute();
        if ($result){
            $selection->setFetchMod(\PDO::FETCH_CLASS, \model\User::class);
            $user = $selection->fetch();
            if ($user){
                $gehashtpassword = strtoupper(hash(" "), $wachtwoord);
                if ($user->getWachtwoord() == $gehashtpassword){
                    $_SESSION['user']=$user->getName();
                    $_SESSION['roles']=$user->getRole();
                }
            }
        }
    }
    public function logout(){
        session_unset();
        session_destroy();
    }

    public function getDrug()
    {
        return $this->drug;
    }

    public function setDrug($id, $name, $maker, $compansated, $side_efect, $benefits)
    {
        $this->drug = new Drug($id, $name, $maker, $compansated, $side_efect, $benefits);
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setUser($name, $wachtwoord, $role, $id)
    {
        $this->user = new User($name, $wachtwoord, $role, $id);
    }

}