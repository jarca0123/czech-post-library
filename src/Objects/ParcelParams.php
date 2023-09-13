<?

namespace Jarca0123\CzechPostLibrary\Objects;

class ParcelParams extends ApiObject
{
    public $recordID; // string, 50 characters, required
    public $parcelCode; // string, min 1 character, max 13 characters
    public $masterCode; // string, max 13 characters
    public $prefixParcelCode; // string, max 2 characters
    public $weight; // string, regex ^((\d{1,5})|(\d{1,5}\.\d{1,3}))$
    public $insuredValue; // double, min 0, max 999999999.99
    public $amount; // double, min 0, max 999999999.99
    public $currency; // string, 3 characters
    public $vsVoucher; // string, ^\d{1,10}$
    public $vsParcel; // string, ^\d{1,10}$
    public $sequenceParcel; // integer, min 0, max 99
    public $quantityParcel; // integer, min 0, max 99
    public $note; // string, max 50 characters
    public $notePrint; // string, max 50 characters
    public $length; // integer, min 0, max 999
    public $width; // integer, min 0, max 999
    public $height; // integer, min 0, max 999
    public $mrn; // string, max 18 characters
    public $referenceNumber; // string, max 30 characters
    public $pallets; // integer, min 1, max 99
    public $specSym; // string, max 10 characters
    public $note2; // string, max 50 characters
    public $numSign; // string, max 30 characters
    public $score; // string, max 30 characters
    public $orderNumberZPRO; // string, max 11 characters
    public $returnNumDays; // string, max 2 characters

    protected static function getRules()
    {
        return [
            'recordID' => ['valueType' => 'string', 'maxLength' => 50],
            'parcelCode' => ['valueType' => 'string', 'minLength' => 1, 'maxLength' => 13],
            'masterCode' => ['valueType' => 'string', 'maxLength' => 13],
            'prefixParcelCode' => ['valueType' => 'string', 'maxLength' => 2],
            'weight' => ['valueType' => 'string', 'regex' => '/^((\d{1,5})|(\d{1,5}\.\d{1,3}))$/'],
            'insuredValue' => ['valueType' => 'double', 'min' => 0, 'max' => 999999999.99],
            'amount' => ['valueType' => 'double', 'min' => 0, 'max' => 999999999.99],
            'currency' => ['valueType' => 'string', 'maxLength' => 3],
            'vsVoucher' => ['valueType' => 'string', 'regex' => '/^\d{1,10}$/'],
            'vsParcel' => ['valueType' => 'string', 'regex' => '/^\d{1,10}$/'],
            'sequenceParcel' => ['valueType' => 'integer', 'min' => 0, 'max' => 99],
            'quantityParcel' => ['valueType' => 'integer', 'min' => 0, 'max' => 99],
            'note' => ['valueType' => 'string', 'maxLength' => 50],
            'notePrint' => ['valueType' => 'string', 'maxLength' => 50],
            'length' => ['valueType' => 'integer', 'min' => 0, 'max' => 999],
            'width' => ['valueType' => 'integer', 'min' => 0, 'max' => 999],
            'height' => ['valueType' => 'integer', 'min' => 0, 'max' => 999],
            'mrn' => ['valueType' => 'string', 'maxLength' => 18],
            'referenceNumber' => ['valueType' => 'string', 'maxLength' => 30],
            'pallets' => ['valueType' => 'integer', 'min' => 1, 'max' => 99],
            'specSym' => ['valueType' => 'string', 'maxLength' => 10],
            'note2' => ['valueType' => 'string', 'maxLength' => 50],
            'numSign' => ['valueType' => 'string', 'maxLength' => 30],
            'score' => ['valueType' => 'string', 'maxLength' => 30],
            'orderNumberZPRO' => ['valueType' => 'string', 'maxLength' => 11],
            'returnNumDays' => ['valueType' => 'string', 'maxLength' => 2],
        ];
    }

    public function __construct(string $recordID, string $prefixParcelCode)
    {
        $this->recordID = $recordID;
        $this->prefixParcelCode = $prefixParcelCode;
    }
}
