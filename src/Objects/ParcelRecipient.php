<?
namespace Jarca0123\CzechPostLibrary\Objects;

class ParcelRecipient extends ApiObject {
    public $recordID; //string, 20 characters
    public $firstName; //string
    public $surname; //string
    public $company; //string
    public $aditionAddress; //string
    public $subject; //string

    public $ic; // int64, min 0, max 9999999999
    public $dic; //string
    public $specification; //string

    public $address; //class RecipientAddress

    public $bank; //class Bank
    public $mobilNumber; //string
    public $phoneNumber; //string
    public $emailAddress; //string

    public $custCardNum; //string, 20 characters
    public $adviceInfo; //class AdviceInfo

    protected static function getRules() {
        return [
            'recordID' => ['valueType' => 'string', 'maxLength' => 20],
            'firstName' => ['valueType' => 'string'],
            'surname' => ['valueType' => 'string'],
            'company' => ['valueType' => 'string'],
            'aditionAddress' => ['valueType' => 'string'],
            'subject' => ['valueType' => 'string'],
            'ic' => ['valueType' => 'int64', 'min' => 0, 'max' => 9999999999],
            'dic' => ['valueType' => 'string'],
            'specification' => ['valueType' => 'string'],
            'address' => ['valueType' => 'object', 'objectType' => RecipientAddress::class],
            'bank' => ['valueType' => 'object', 'objectType' => Bank::class],
            'mobilNumber' => ['valueType' => 'string'],
            'phoneNumber' => ['valueType' => 'string'],
            'emailAddress' => ['valueType' => 'string'],
            'custCardNum' => ['valueType' => 'string', 'maxLength' => 20],
            'adviceInfo' => ['valueType' => 'object', 'objectType' => AdviceInfo::class],
        ];
    }

}