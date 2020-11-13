<?php
use model\Model;
include_once ("model/Model.php");
use view\View;
include_once ("view/View.php");
use controller\Controller;
include_once ("controller/Controller.php");

$controller = new Controller();
//session_start();
//&& isset($_SESSION['loggedin'])
//if ($_SESSION["loggedin"]=="true"){

//}


if(isset($_POST['showForm']))
{
    $controller->showFormPatientAction( $_POST['showForm']);
}
//  UPDATE: formulier afhandeling om een rij bij te werken
else if(isset($_POST['update']))
{
    $controller->updatePatientAction();
}
// CREATE:  formulier afhandeling nieuwe rij
else if(isset($_POST['create']))
{
    $controller->createPatientAction();
}
// DELETE:  verwijderen rijen
else if(isset($_POST['delete']))
{
    $controller->deletePatientAction($_POST['delete']);
}
// CREATE: formulier afhandeling nieuwe user
else if (isset($_POST['adduser'])){
    $controller->createUserAction($_POST['adduser']);
}
// READ:  formulier inloggen user
else if (isset($_POST['login'])){
    $controller->loginAction();
}
else if (isset($_POST['logout'])){
    $controller->logoutAction();
}
// READ:  overzicht login pagina
else
{
    $controller->readLoginAction();
}