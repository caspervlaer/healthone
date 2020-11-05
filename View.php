<?php
namespace view;
use model\Model;

class View
{
    private $model;
    private $content;
    //constructor
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->content = "Tractors";
        echo "<hr>create account : ".$this->model->getContent();

    }
    public function viewContent(){
        $drugs = $this->model->getDrug();
        echo "<hr>name : ".$drugs->getName();
    }
}