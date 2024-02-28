<?php
namespace Jarca0123\CzechPostLibrary\Objects;

class LetterHeader extends ApiObject {
    protected $transmissionDate; // class DateTime, required
    protected $customerID; // string, 6 characters
    protected $postCode; // string, 5 characters
    protected $contractNumber; // string, 10 characters
    protected $frankingNumber; // string, 10 characters
    protected $senderCustCardNum; // string, 20 characters
    protected $locationNumber; //integer


    protected static function getRules() {
        return [
            'transmissionDate' => ['class' => \DateTime::class],
            'customerID' => ['valueType' => 'string', 'maxLength' => 6],
            'postCode' => ['valueType' => 'string', 'maxLength' => 5],
            'contractNumber' => ['valueType' => 'string', 'maxLength' => 10],
            'frankingNumber' => ['valueType' => 'string', 'maxLength' => 10],
            'senderCustCardNum' => ['valueType' => 'string', 'maxLength' => 20],
            'locationNumber' => ['valueType' => 'integer'],
        ];
    }

    public function __construct()
    {
        
    }

}
