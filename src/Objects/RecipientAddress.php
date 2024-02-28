<?php

namespace Jarca0123\CzechPostLibrary\Objects;

class RecipientAddress extends ApiObject
{
    public $street; // string, 40 characters
    public $houseNumber; // string, 6 characters
    public $sequenceNumber; // string, 6 characters
    public $cityPart; // string, 40 characters
    public $city; // string, 40 characters
    public $zipCode; // string, 25 characters
    public $isoCountry; // string, 2 characters
    public $subIsoCountry; // string, 6 characters
    public $addressCode; // integer

    protected static function getRules()
    {
        return [
            'street' => [
                'valueType' => 'string',
                'maxLength' => 40,
            ],
            'houseNumber' => [
                'valueType' => 'string',
                'maxLength' => 6,
            ],
            'sequenceNumber' => [
                'valueType' => 'string',
                'maxLength' => 6,
            ],
            'cityPart' => [
                'valueType' => 'string',
                'maxLength' => 40,
            ],
            'city' => [
                'valueType' => 'string',
                'maxLength' => 40,
            ],
            'zipCode' => [
                'valueType' => 'string',
                'maxLength' => 25,
            ],
            'isoCountry' => [
                'valueType' => 'string',
                'maxLength' => 2,
            ],
            'subIsoCountry' => [
                'valueType' => 'string',
                'maxLength' => 6,
            ],
            'addressCode' => [
                'valueType' => 'integer',
            ],
        ];
    }
}
