<?php
namespace controller;

use view\View;
include_once ("view/View.php");
use model\Model;
include_once ("model/Model.php");

class Controller
{
    private $model;
    private $view;
    //constructor

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View($this->model);
    }
    //this will show the patienten
    public function readPatientenAction(){
        $this->view->showPatienten();
    }
    //this wil show u the login page
    public function readLoginAction(){
        $this->view->showLogin();
    }
    //this will show u the drug form
    public function showDrugFormAction($id=null){
        $this->view->showDrugForm($id);
    }
    //this will show u the receipt form
    public function showReceiptFormAction($id){
        $this->view->showReceiptForm($id);
    }
    //this will show u the patienten form
    public function showFormPatientAction($id=null){
        $this->view->showFormPatienten($id);
    }
    //this will show u the receipt page
    public function showReceiptAction($id){
        $this->view->showReceipt($id);
    }
    //this will read what u put in the input and create a receipt of it and then goes to the patienten page
    public function addReceiptAction(){
        $patientid = filter_input(INPUT_POST,'patientid');
        $drugid = filter_input(INPUT_POST,'drugid');
        $notitie = filter_input(INPUT_POST,'notitie');
        $herhaling = filter_input(INPUT_POST,'herhaling');
        $duration = filter_input(INPUT_POST,'duration');
        $result = $this->model->createReceipt($patientid,$drugid,$notitie,$herhaling,$duration);
        $this->view->showPatienten($result);
    }
    //this will read what u put in the input and looks if u put a name in and if so then creates a patient and shows the patienten screen otherwise is will say no name and places u back in the form
    public function createPatientAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $adres = filter_input(INPUT_POST,'adres');
        $woonplaats = filter_input(INPUT_POST,'woonplaats');
        $geboortedatum = filter_input(INPUT_POST,'geboortedatum');
        $soortverzekering = filter_input(INPUT_POST,'soortverzekering');
        $zknummer = filter_input(INPUT_POST,'zknummer');
        if ($naam == ""){
            echo "geen naam";
            $this->view->showFormPatienten();
        } else {
            $result = $this->model->insertPatient($naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering);
            $this->view->showPatienten($result);
        }
    }
    //this will read what u put in the input and update the patient with it and then show u the patienten page
    public function updatePatientAction(){
        $id = filter_input(INPUT_POST,'id');
        $naam = filter_input(INPUT_POST,'naam');
        $adres = filter_input(INPUT_POST,'adres');
        $woonplaats = filter_input(INPUT_POST,'woonplaats');
        $geboortedatum = filter_input(INPUT_POST,'geboortedatum');
        $zknummer = filter_input(INPUT_POST,'zknummer');
        $soortverzekering = filter_input(INPUT_POST,'soortverzekering');
        $result=$this->model->updatePatient($id,$naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering);
        $this->view->showPatienten($result);
    }
    //this will delete a patient and show u the patienten page
    public function deletePatientAction($id){
        $result = $this->model->deletePatient($id);
        $this->view->showPatienten($result);
    }
    //this will read what u put in the input and create a user
    public function createUserAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $wachtwoord = filter_input(INPUT_POST,'wachtwoord');
        $apotheek = filter_input(INPUT_POST,'apotheek');
        $result = $this->model->insertUser($naam,$wachtwoord,$apotheek);
        //$this->view->showPatienten($result);
    }
    //this will read what u put in the input and try's to log u in if is correct then it will go to the patienten page otherwise it will stay in the login screen
    public function loginAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $wachtwoord = filter_input(INPUT_POST,'wachtwoord');
        $this->model->login($naam,$wachtwoord);
        if ($_SESSION['loggedin']=="true"){
            $this->view->showPatienten();
        } else{
            $_SESSION['loggedin']="false";
            $this->view->showLogin();
        }
    }
    //this will log u out and show u the login page
    public function logoutAction(){
        $this->model->logout();
        $this->view->showLogin();
    }
    //this show u the drug page
    public function showDrugsAction(){
        $this->view->showDrugs();
    }
    //this will delete the drug and show u the drug page
    public function deleteDrugAction($id){
        $result = $this->model->deleteDrug($id);
        $this->view->showDrugs($result);
    }
    //this will read what u put in the input and looks if u put in a name if so then creates a drug and show u the drug page otherwise it will say no name and show the drug form
    public function addDrugAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $maker = filter_input(INPUT_POST,'maker');
        $compensated = filter_input(INPUT_POST,'compensated');
        $side_efect = filter_input(INPUT_POST,'side_efect');
        $benefits = filter_input(INPUT_POST,'benefits');
        if ($naam == ""){
            echo "geen naam";
            $this->view->showDrugForm();
        } else {
            $result = $this->model->addDrug($naam,$maker,$compensated,$side_efect,$benefits);
            $this->view->showDrugs($result);
        }
    }
    //this will read what u put in the input and update the drug adn then show the drug page
    public function updateDrugAction(){
        $id = filter_input(INPUT_POST,'id');
        $naam = filter_input(INPUT_POST,'naam');
        $maker = filter_input(INPUT_POST,'maker');
        $compensated = filter_input(INPUT_POST,'compensated');
        $side_efect = filter_input(INPUT_POST,'side_efect');
        $benefits = filter_input(INPUT_POST,'benefits');
        $result=$this->model->updateDrug($id,$naam,$maker,$compensated,$side_efect,$benefits);
        $this->view->showDrugs($result);
    }
}