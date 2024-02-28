<?php
namespace Jarca0123\CzechPostLibrary\Objects;

class PrintParams extends ApiObject {
    public $idForm; // int
    public $shiftHorizontal; // int
    public $shiftVertical; // int

    protected static function getRules(){
        return array(
            'idForm' => array('type' => 'int'),
            'shiftHorizontal' => array('type' => 'int'),
            'shiftVertical' => array('type' => 'int'),
        );
    } 

    function __construct($idForm, $shiftHorizontal, $shiftVertical) {
        $this->idForm = $idForm;
        $this->shiftHorizontal = $shiftHorizontal;
        $this->shiftVertical = $shiftVertical;
    }



}