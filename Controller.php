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
    public function getView()
    {
        return $this->view;
    }
    public function updateModel($id, $name, $maker, $compansated, $side_efect, $benefits){

        $this->model->setDrug($id, $name, $maker, $compansated, $side_efect, $benefits);
    }
    public function updateView() {
        $this->view->viewContent();
    }


}