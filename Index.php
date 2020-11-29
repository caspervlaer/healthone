<?php
use model\Model;
include_once ("model/Model.php");
use view\View;
include_once ("view/View.php");
use controller\Controller;
include_once ("controller/Controller.php");

$controller = new Controller();
//this function starts the session
session_start();

// READ : it will show u the patienten form screen
if(isset($_POST['showForm']))
{
    $controller->showFormPatientAction( $_POST['showForm']);
}
// READ : it will show u the drug form screen
else if (isset($_POST['showDrugForm']))
{
    $controller->showDrugFormAction($_POST['showDrugForm']);
}
// READ : it will show u the patienten screen
else if (isset($_POST['showPatienten'])){
    $controller->readPatientenAction();
}
// READ : it will show u the create receipt screen
else if (isset($_POST['showCreateReceipt'])){
    $controller->showReceiptFormAction($_POST['showCreateReceipt']);
}
// READ : it will show u the receipt screen screen
else if (isset($_POST['showReceipt'])){
    $controller->showReceiptAction($_POST['showReceipt']);
}
// CREATE : it will add a receipt to a patient
else if (isset($_POST['addReceipt'])){
    $controller->addReceiptAction();
}

//  UPDATE : changes info of a row of patients
else if(isset($_POST['update']))
{
    $controller->updatePatientAction();
}
// READ : it will show u the drug screen
else if (isset($_POST['showDrugs']))
{
    $controller->showDrugsAction();
}
// DELETE : it will remove a drug
else if (isset($_POST['deleteDrug']))
{
    $controller->deleteDrugAction($_POST['deleteDrug']);
}
// CREATE : it will add a drug
else if (isset($_POST['addDrug']))
{
    $controller->addDrugAction();
}
// CREATE :  adds a new row of patients
else if(isset($_POST['create']))
{
    $controller->createPatientAction();
}
// DELETE :  deletes a row of patients
else if(isset($_POST['delete']))
{
    $controller->deletePatientAction($_POST['delete']);
}
// CREATE : it adds a new user
else if (isset($_POST['adduser'])){
    $controller->createUserAction();
}
// READ :  it will log u in
else if (isset($_POST['login'])){
    $controller->loginAction();
}
// ACTION : it will let u log out
else if (isset($_POST['logout'])){
    $controller->logoutAction();
}
// UPDATE : it will update a drug
else if (isset($_POST['updateDrug'])){
    $controller->updateDrugAction();
}
// READ :  it will show the login screen
else
{
    $controller->readLoginAction();
}