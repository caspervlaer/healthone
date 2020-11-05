<?php
namespace model;
use model\Drug;
include_once ("model/Drug.php");

class Model
{
    private $drug;
    public $content;

    public function __construct()
    {
        $this->content = "<form method='post'>
                           Name: <input type='text' name='name'>
                           Wachtwoord: <input type='text' name='wacht'>
                           <input type='submit'>";
    }

    private function makeConnection(){
        $this->database = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");
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

}