<?
namespace Jarca0123\CzechPostLibrary\Objects;

class ParcelCustomsDeclaration extends ApiObject {
    public $category;
    public $note; // <= 50 characters
    public $customValCur;
    public $parcelCustomGoods; //ParcelCustomGoods[], <= 20 items
}