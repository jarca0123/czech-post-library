<?php
namespace Jarca0123\CzechPostLibrary\Objects;

class ParcelCustomGoods extends ApiObject {
    public $sequence;
    public $customCont;
    public $quantity;
    public $weight; //  ^((\d{1,5})|(\d{1,5}\.\d{1,3}))$
    public $customVal;
    public $hsCode;
    public $iso;
}