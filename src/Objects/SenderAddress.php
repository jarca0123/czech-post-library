<?php
namespace Jarca0123\CzechPostLibrary\Objects;

class SenderAddress extends RecipientAddress {
    protected $companyName;
    protected $aditionAddress;
    protected $senderRefNum;


    public function __construct(string $companyName, string $city, string $zipCode)
    {
        $this->companyName = $companyName;
        $this->city = $city;
        $this->zipCode = $zipCode;
    }

    protected static function getRules() {
        return [
            'companyName' => [
                'valueType' => 'string',
                'maxLength' => 50,
            ],
            'aditionAddress' => [
                'valueType' => 'string',
                'maxLength' => 50,
            ],
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
            'senderRefNum' => [
                'valueType' => 'string',
                'maxLength' => 50,
            ],
        ];
    }

}