<?php

namespace model;

class Drug
{
    private $id;
    private $name;
    private $maker;
    private $compansated;
    private $side_efect;
    private $benefits;

    public function __construct($id, $name, $maker, $compansated, $side_efect, $benefits){
        $this->id = $id;
        $this->benefits = $benefits;
        $this->compansated = $compansated;
        $this->maker = $maker;
        $this->name = $name;
        $this->side_efect = $side_efect;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getMaker()
    {
        return $this->maker;
    }

    public function setMaker($maker)
    {
        $this->maker = $maker;
    }

    public function getCompansated()
    {
        return $this->compansated;
    }

    public function setCompansated($compansated)
    {
        $this->compansated = $compansated;
    }

    public function getSideEfect()
    {
        return $this->side_efect;
    }

    public function setSideEfect($side_efect)
    {
        $this->side_efect = $side_efect;
    }

    public function getBenefits()
    {
        return $this->benefits;
    }

    public function setBenefits($benefits)
    {
        $this->benefits = $benefits;
    }

}
