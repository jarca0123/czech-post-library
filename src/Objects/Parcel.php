<?
namespace Jarca0123\CzechPostLibrary\Objects;

class Parcel extends ApiObject {
    protected $parcelParams;
    protected $parcelAddress;
    //public $parcelAddressDocument;
    protected $parcelServices;
    protected $parcelCustomsDeclaration;

    protected static function getRules() {
        return array(
            'parcelParams' => array(
                'class' => ParcelParams::class,
            ),
            'parcelAddress' => array(
                'class' => ParcelAddressee::class,
            ),
            'parcelCustomsDeclaration' => array(
                'class' => ParcelCustomsDeclaration::class,
            ),
            'parcelServices' => array(
                /*'type' => 'array',
                'valueType' => ParcelService::class,*/ //TODO?
            ),
        );
    }

    function __construct(ParcelParams $parcelParams, ParcelRecipient $parcelAddress, array $parcelServices) {
        $this->parcelParams = $parcelParams;
        $this->parcelAddress = $parcelAddress;
        $this->parcelServices = $parcelServices;
    }

}