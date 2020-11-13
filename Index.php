<?php
use model\Model;
include_once ("model/Model.php");
use view\View;
include_once ("view/View.php");
use controller\Controller;
include_once ("controller/Controller.php");

$controller = new Controller();

// READ : it will show u the patienten screen
if(isset($_POST['showForm']))
{
    $controller->showFormPatientAction( $_POST['showForm']);
}
//  UPDATE : changes info of a row of patients
else if(isset($_POST['update']))
{
    $controller->updatePatientAction();
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
    $controller->createUserAction($_POST['adduser']);
}
// READ :  it will log u in
else if (isset($_POST['login'])){
    $controller->loginAction();
}
// ACTION : it will let u log out
else if (isset($_POST['logout'])){
    $controller->logoutAction();
}
// READ :  it will show the login screen
else
{
    $controller->readLoginAction();
}