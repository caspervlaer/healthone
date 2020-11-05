<?php
use model\Model;
include_once ("model/Model.php");
use view\View;
include_once ("view/View.php");
use controller\Controller;
include_once ("controller/Controller.php");

$controller = new Controller();


$controller->updateModel(1,"poep","leo", "geen", "niks" , "geen");
$controller->updateView();