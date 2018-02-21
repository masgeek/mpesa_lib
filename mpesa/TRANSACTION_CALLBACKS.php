<?php
/**
 * Created by PhpStorm.
 * User: MNANDWA
 * Date: 10/19/2017
 * Time: 4:23 PM
 */

namespace mpesa;


/**
 * Class TransactionCallbacks
 * This class contains functions that will be used to obtain data from Mpesa callbacks
 * @package safaricom\Mpesa
 */
class TRANSACTION_CALLBACKS
{
    /**
     * Use this function to process the STK push request callback
     * @return string
     */
    public static function processSTKPushRequestCallback($callbackJSONData, $asArray = false)
    {
        $callbackData = json_decode($callbackJSONData)->Body;

        $amount = 0;
        $mpesaReceiptNumber = null;
        $balance = 0;
        $b2CUtilityAccountAvailableFunds = 0;
        $transactionDate = null;
        $phoneNumber = null;


        $resultCode = $callbackData->stkCallback->ResultCode;
        $resultDesc = $callbackData->stkCallback->ResultDesc;
        $merchantRequestID = $callbackData->stkCallback->MerchantRequestID;
        $checkoutRequestID = $callbackData->stkCallback->CheckoutRequestID;


        if ($resultCode == 0) {
            $amount = $callbackData->stkCallback->CallbackMetadata->Item[0]->Value;
            $mpesaReceiptNumber = $callbackData->stkCallback->CallbackMetadata->Item[1]->Value;
            $balance = 0;//$callbackData->stkCallback->CallbackMetadata->Item[2]->Value;
            $b2CUtilityAccountAvailableFunds = 0;//$callbackData->stkCallback->CallbackMetadata->Item[3]->Value;
            $transactionDate = $callbackData->stkCallback->CallbackMetadata->Item[3]->Value;
            $phoneNumber = $callbackData->stkCallback->CallbackMetadata->Item[4]->Value;
        }


        $result = [
            "resultDesc" => $resultDesc,
            "resultCode" => $resultCode,
            "merchantRequestID" => $merchantRequestID,
            "checkoutRequestID" => $checkoutRequestID,
            "amount" => $amount,
            "mpesaReceiptNumber" => $mpesaReceiptNumber,
            "balance" => $balance,
            "b2CUtilityAccountAvailableFunds" => $b2CUtilityAccountAvailableFunds,
            "transactionDate" => $transactionDate,
            "phoneNumber" => $phoneNumber
        ];

        return $asArray ? $result : json_encode($result);
    }

    /**
     * Use this function to process the STK Push  request callback
     * @return string
     */
    public static function processSTKPushQueryRequestCallback($callbackJSONData)
    {
        $callbackData = json_decode($callbackJSONData);
        $responseCode = $callbackData->ResponseCode;
        $responseDescription = $callbackData->ResponseDescription;
        $merchantRequestID = $callbackData->MerchantRequestID;
        $checkoutRequestID = $callbackData->CheckoutRequestID;
        $resultCode = $callbackData->ResultCode;
        $resultDesc = $callbackData->ResultDesc;

        $result = [
            "resultCode" => $resultCode,
            "responseDescription" => $responseDescription,
            "responseCode" => $responseCode,
            "merchantRequestID" => $merchantRequestID,
            "checkoutRequestID" => $checkoutRequestID,
            "resultDesc" => $resultDesc
        ];

        return json_encode($result);
    }
}