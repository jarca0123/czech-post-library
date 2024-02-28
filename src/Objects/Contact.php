<?php
namespace Jarca0123\CzechPostLibrary\Objects;

class Contact extends ApiObject {
    public $mobilNumber;
    public $phoneNumber;
    public $emailAddress;

    protected static function getRules() {
        return [
            'mobilNumber' => ['valueType' => 'string'],
            'phoneNumber' => ['valueType' => 'string'],
            'emailAddress' => ['valueType' => 'string'],
        ];
    }
}