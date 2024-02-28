<?php
namespace Jarca0123\CzechPostLibrary\Objects;

class Bank extends ApiObject {
    public $prefixAccount; //string, max length 6, regex ^\d{1,6}$
    public $account; //string, max length 10, regex ^\d{1,10}$
    public $bank; //string, max length 4, regex ^\d{1,4}$


    protected static function getRules() {
        return [
            'prefixAccount' => ['valueType' => 'string', 'maxLength' => 6, 'regex' => '/^\d{1,6}$/'],
            'account' => ['valueType' => 'string', 'maxLength' => 10, 'regex' => '/^\d{1,10}$/'],
            'bank' => ['valueType' => 'string', 'maxLength' => 4, 'regex' => '/^\d{1,4}$/'],
        ];;
    }

    function __construct($prefixAccount, $account, $bank) {
        $this->prefixAccount = $prefixAccount;
        $this->account = $account;
        $this->bank = $bank;
    }
}