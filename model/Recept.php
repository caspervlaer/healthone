<?php


namespace model;


class Recept
{

    private $id;
    private $patientid;
    private $drugid;
    private $herhaling;
    private $notitie;
    private $date;
    private $duration;
    //with this u get a variable that u asked for
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    //with this u set or change a variable u chose
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
}