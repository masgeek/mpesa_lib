<?php
/* @var $mpesa MpesaFactory */
/* @throws \Httpful\Exception\ConnectionErrorException */

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../config/config.php';
require_once 'MpesaFactory.php';
require_once 'TransactionCallBacks.php';

use mpesa\MpesaFactory;

$mpesa = new MpesaFactory();


$whoops = new Whoops\Run();
$handler = new \Whoops\Handler\JsonResponseHandler();
$whoops->pushHandler($handler);
$whoops->register();

$postObject = (object)$_POST;

$refNumber = isset($postObject->refNumber) ? $postObject->refNumber : null;
$customerPhoneNumber = isset($postObject->stkPhone) ? $postObject->stkPhone : null;
$transactionType = isset($postObject->transactionType) ? $postObject->transactionType : null;
$businessShortCode = isset($postObject->businessShortCode) ? $postObject->businessShortCode : null;
$amount = isset($postObject->amount) ? $postObject->amount : 0;
$desc = isset($postObject->desc) ? $postObject->desc : 'STK Payment';

$callbackURL = isset($postObject->callbackURL) ? $postObject->callbackURL : null;
$validationURL = isset($postObject->validationURL) ? $postObject->validationURL : null;
$confirmationURL = isset($postObject->confirmationURL) ? $postObject->confirmationURL : null;
$resp = [];

if ($refNumber == null || $customerPhoneNumber == null || $amount == 0 || $transactionType == null) {
    throw new Exception('Invalid Payment parameters', 501);
} else {

//go here to get them pass key developer.safaricom.co.ke/test_credentials
    $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

    $timestamp = $mpesa->GetTimeStamp(true);
    $password = base64_encode($businessShortCode . $LipaNaMpesaPasskey . $timestamp);

    $lipaNaMpesaPost = array(
        //Fill in the request parameters with valid values
        'BusinessShortCode' => $businessShortCode,
        'Password' => $password,
        'Timestamp' => $timestamp,
        'TransactionType' => $transactionType,
        'Amount' => $amount,
        'PartyA' => $customerPhoneNumber,
        'PartyB' => $businessShortCode,
        'PhoneNumber' => $customerPhoneNumber,
        'CallBackURL' => "{$callbackURL}",
        'AccountReference' => $refNumber,
        'TransactionDesc' => $desc
    );

    $resp = $mpesa->LipaNaMpesaProcessRequest($lipaNaMpesaPost);
}

echo json_encode($resp);
die();

