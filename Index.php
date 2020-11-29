<?php
use model\Model;
include_once ("model/Model.php");
use view\View;
include_once ("view/View.php");
use controller\Controller;
include_once ("controller/Controller.php");

$controller = new Controller();
session_start();

// READ : it will show u the patienten screen
if(isset($_POST['showForm']))
{
    $controller->showFormPatientAction( $_POST['showForm']);
}
else if (isset($_POST['showDrugForm']))
{
    $controller->showDrugFormAction($_POST['showDrugForm']);
}
else if (isset($_POST['showPatienten'])){
    $controller->readPatientenAction();
}
else if (isset($_POST['showCreateReceipt'])){
    $controller->showReceiptFormAction($_POST['showCreateReceipt']);
}
else if (isset($_POST['showReceipt'])){
    $controller->showReceiptAction($_POST['showReceipt']);
}
else if (isset($_POST['addReceipt'])){
    $controller->addReceiptAction();
}

//  UPDATE : changes info of a row of patients
else if(isset($_POST['update']))
{
    $controller->updatePatientAction();
}
else if (isset($_POST['showDrugs']))
{
    $controller->showDrugsAction();
}
else if (isset($_POST['deleteDrug']))
{
    $controller->deleteDrugAction($_POST['deleteDrug']);
}
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
else if (isset($_POST['updateDrug'])){
    $controller->updateDrugAction();
}
// READ :  it will show the login screen
else
{
    $controller->readLoginAction();
}