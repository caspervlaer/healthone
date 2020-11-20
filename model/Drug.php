<?php

namespace model;

class Drug
{
    private $id;
    private $naam;
    private $maker;
    private $compensated;
    private $side_efect;
    private $benefits;

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    //with this u get a variable that u asked for

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }

}
