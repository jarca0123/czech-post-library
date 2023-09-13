<?php

namespace Jarca0123\CzechPostLibrary;
//test api token: b79b16c2-2f77-450f-91a5-868c3c698a82
//test secret key: dOJWwjp+BWqUcof3K+3OW6XGTnEpmWerx64TCNk0+0pZnonHdN99NFRIGaJSX0/HTtiu6AGYpKp0mjguzqp+wg==

use Jarca0123\CzechPostLibrary\Objects;

class CzechPostB2B
{

    private $apiUrl = 'https://b2b-test.postaonline.cz:444/restservices/ZSKService/v1/';

    private $apiToken;
    private $secretKey;
    private $postCode;
    private $customerID;
    private $customerCardID;

    function __construct($apiToken, $secretKey, $postCode, $customerID, $customerCardID)
    {
        $this->apiToken = $apiToken;
        $this->secretKey = $secretKey;
        $this->postCode = $postCode;
        $this->customerID = $customerID;
        $this->customerCardID = $customerCardID;
    }

    private function sendRequest($method, $url, $body, $returnCode = false)
    {
        $unixTimestamp = time();
        $nonce = uniqid();
        $bodySHA256 = hash('sha256', $body);
        $hmacSHA256 = hash_hmac('sha256', $bodySHA256 . ";" . $unixTimestamp . ";" . $nonce, $this->secretKey, true);
        $hmacSHA256Base64 = base64_encode($hmacSHA256);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->apiUrl . $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . 'CP-HMAC-SHA256' . ' ' . 'nonce="' . $nonce . '", ' . 'signature="' . $hmacSHA256Base64 . '"',
            'Authorization-Timestamp: ' . $unixTimestamp,
            'Authorization-Content-SHA256: ' . $bodySHA256,
            'Api-Token: ' . $this->apiToken,
        ));
        $response = curl_exec($curl);
        if ($response === false) {
            echo 'Curl error: ' . curl_error($curl);
        }
        if ($returnCode) {
            $response = array($response, curl_getinfo($curl, CURLINFO_RESPONSE_CODE));
        }
        curl_close($curl);
        return $response;
    }

    public function parcelService(Objects\ParcelParams $parcelParams, Objects\ParcelRecipient $parcelAddress, $parcelServices, Objects\PrintParams $printParams, int $locationNumber = 1, int $position = 1, $transmissionEnd = null)
    {
        $body = json_encode($this->array_remove_empty(array(
            'parcelServiceHeader' => array(
                'parcelServiceHeaderCom' => array(
                    'transmissionDate' => date('Y-m-d'),
                    'customerID' => $this->customerID,
                    'postCode' => $this->postCode,
                    'locationNumber' => $locationNumber,
                    'senderCustCardNum' => $this->customerCardID,
                ),
                'transmissionEnd' => $transmissionEnd,
                'printParams' => $printParams,
                'position' => $position,
            ),
            'parcelServiceData' => array(
                'parcelParams' => $parcelParams,
                'parcelAddress' => $parcelAddress,
                'parcelServices' => $parcelServices,
            ),
        )));
        return $this->sendRequest('POST', 'parcelService', $body);
    }

    /**
     * @param Parcel[] $parcelDataList
     */
    public function sendParcels(Objects\ParcelHeader $parcelHeader, array $parcelDataList)
    {
        $body = json_encode(array(
            'parcelHeader' => $parcelHeader,
            'parcelDataList' => $parcelDataList,
        ));
        echo $body;
        return $this->sendRequest('POST', 'sendParcels', $body);
    }

    public function parcelPrinting(Objects\PrintParams $printParams, int $position, array $parcelIds)
    {
        $body = json_encode(array(
            'printingHeader' => array(
                'customerID' => $this->customerID,
                //'contractNumber' => $this->customerCardID,
                'idForm' => $printParams->idForm,
                'shiftHorizontal' => $printParams->shiftHorizontal,
                'shiftVertical' => $printParams->shiftVertical,
                'position' => $position,
            ),
            'printingData' => $parcelIds,
        ));
        return $this->sendRequest('POST', 'parcelPrinting', $body);
    }

    public function getSendParcelsResult($idTransaction, $returnCode = false)
    {
        return $this->sendRequest('GET', 'sendParcels/idTransaction/' . $idTransaction, '', $returnCode);
    }

    public function waitForGetSendParcelsResult($idTransaction)
    {
        //wait while status is not 202
        $response = $this->getSendParcelsResult($idTransaction, true);
        [$response, $returnCode] = $response;
        while ($returnCode == 202) {
            sleep(1);
            $response = $this->getSendParcelsResult($idTransaction, true);
            [$response, $returnCode] = $response;
        }
        return $response;
    }

    public function sendParcelsAndGetResult(Objects\ParcelHeader $parcelHeader, array $parcelDataList)
    {
        $response = $this->sendParcels($parcelHeader, $parcelDataList);
        $responseJson = json_decode($response, true);
        $idTransaction = $responseJson['parcelServiceResult']['idTransaction'];
        return $this->waitForGetSendParcelsResult($idTransaction);
    }


    private function array_remove_empty($haystack)
    {
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $haystack[$key] = $this->array_remove_empty($haystack[$key]);
            }

            if (empty($haystack[$key])) {
                unset($haystack[$key]);
            }
        }

        return $haystack;
    }
}
