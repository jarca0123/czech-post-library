<?php
namespace Jarca0123\CzechPostLibrary\Objects;

class ParcelHeader extends LetterHeader {
    public $senderAddress; //class Address 
    public $codAddress; //class Address
    public $codBank; //class Bank
    public $senderContacts; //class Contact
    public $transmissionEnd; //in [null, 0, 1]
    public $goodToAccept; //boolean

    protected static function getRules() {
        return [
            'transmissionDate' => ['class' => \DateTime::class, 'required' => true],
            'customerID' => ['valueType' => 'string', 'maxLength' => 6],
            'postCode' => ['valueType' => 'string', 'maxLength' => 5],
            'contractNumber' => ['valueType' => 'string', 'maxLength' => 10],
            'frankingNumber' => ['valueType' => 'string', 'maxLength' => 10],
            'senderCustCardNum' => ['valueType' => 'string', 'maxLength' => 20],
            'locationNumber' => ['valueType' => 'integer'],
            'senderAddress' => ['class' => SenderAddress::class],
            'codAddress' => ['class' => SenderAddress::class],
            'codBank' => ['class' => Bank::class],
            'senderContacts' => ['class' => Contact::class],
            'transmissionEnd' => ['in' => [null, 0, 1]],
            'goodToAccept' => ['valueType' => 'boolean'],
        ];
    }

}
