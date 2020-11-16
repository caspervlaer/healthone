<?php
namespace model;
use model\Drug;
include_once("model/Drug.php");
use model\Patient;
include_once ("model/Patient.php");
use model\User;
include_once ("model/User.php");

class Model
{
    private $database;

    private function makeConnection(){
        $this->database = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");
    }

    public function insertPatient($naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering){
        $this->makeConnection();
        if($naam !='')
        {
            $query = $this->database->prepare (
                "INSERT INTO `patienten` (`id`, `naam`, `adres`, `woonplaats`, `zknummer`, `geboortedatum`, `soortverzekering`) 
                VALUES (NULL, :naam, :adres, :woonplaats, :zknummer, :geboortedatum, :soortverzekering)");
            $query->bindParam(":naam", $naam);
            $query->bindParam(":adres", $adres);
            $query->bindParam(":woonplaats",$woonplaats);
            $query->bindParam(":zknummer", $zknummer);
            $query->bindParam(":geboortedatum", $geboortedatum);
            $query->bindParam(":soortverzekering",$soortverzekering);
            $result = $query->execute();
            return $result;
        }
        return -1;
        // id hoeft niet te worden toegevoegd omdat de id in de databse op autoincrement staat.


    }
    public function updatePatient($id,$naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering){
        $this->makeConnection();

        // id moet worden toegevoegd omdat de id in de databse wordt gezocht
        $query = $this->database->prepare (
            "UPDATE `patienten` SET `naam` = :naam, `adres`=:adres, `woonplaats` = :woonplaats,
            `zknummer`=:zknummer, `geboortedatum`=:geboortedatum, `soortverzekering`=:soortverzekering 
            WHERE `patienten`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":naam", $naam);
        $query->bindParam(":adres", $adres);
        $query->bindParam(":woonplaats",$woonplaats);
        $query->bindParam(":zknummer", $zknummer);
        $query->bindParam(":geboortedatum", $geboortedatum);
        $query->bindParam(":soortverzekering",$soortverzekering);
        $result = $query->execute();
        return $result;
    }

    public function getPatienten(){

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `patienten`');
        if($selection){
            $result=$selection->fetchAll(\PDO::FETCH_CLASS,\model\Patient::class);
            return $result;
        }
        return null;
    }
    public function getUser(){
        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `users`');
        if($selection){
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\User::class);
            $user = $selection->fetch();
            if ($user){
                return $user;
            }
        }
        return null;
    }
    public function selectPatient($id){

        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `patienten` 
            WHERE `patienten`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        if($result){
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\Patient::class);
            $patient = $selection->fetch();
            return $patient;
        }
        return null;
    }
    public function deletePatient($id){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'DELETE FROM `patienten` 
            WHERE `patienten`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        return $result;
    }
    public function insertUser($naam,$wachtwoord,$apotheek){
        $this->makeConnection();
        if($naam !='')
        {
            $query = $this->database->prepare (
                "INSERT INTO `apothekers` (`id`, `naam`, `wachtwoord`, `apotheek`) 
                VALUES (NULL, :naam, :wachtwoord, :apotheek)");
            $query->bindParam(":naam", $naam);
            $query->bindParam(":wachtwoord", $wachtwoord);
            $query->bindParam(":apotheek",$apotheek);
            $result = $query->execute();
            return $result;
        }
        return -1;
        // id hoeft niet te worden toegevoegd omdat de id in de databse op autoincrement staat.
    }
    public function login($name, $wachtwoord){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `users` WHERE `users`.`name` =:name');
        $selection->bindParam(":name",$name);
        $result = $selection->execute();
        if ($result){
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\User::class);
            $user = $selection->fetch();
            if ($user){
                $gehashtpassword = hash("sha256", $wachtwoord);
                if ($user->__get("wachtwoord") == $gehashtpassword){
                    $_SESSION['user']=$user->__get("name");
                    $_SESSION['roles']=$user->__get("role");
                    $_SESSION['loggedin']="true";
                } else{
                    $_SESSION['loggedin']="false";
                    echo "wrong password";
                }
            }
        }
    }
    public function logout(){
        $_SESSION['loggedin']="false";
        session_unset();
    }
}