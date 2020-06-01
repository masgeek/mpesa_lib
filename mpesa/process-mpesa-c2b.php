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
//$handler = new \Whoops\Handler\PrettyPageHandler;
$handler = new \Whoops\Handler\JsonResponseHandler();
$whoops->pushHandler($handler);
$whoops->register();

$postObject = (object)$_POST;

$regNumber = isset($postObject->refNumber) ? $postObject->refNumber : null;
$customerPhoneNumber = isset($postObject->phone) ? $postObject->phone : null;
$transactionType = isset($postObject->transactionType) ? $postObject->transactionType : null;
$businessShortCode = isset($postObject->businessShortCode) ? $postObject->businessShortCode : null;

$amount = isset($postObject->amount) ? $postObject->amount : 0;
$desc = isset($postObject->desc) ? $postObject->desc : 'Payment';
$responseType = isset($postObject->responseType) ? $postObject->responseType : 'Completed';

$callbackURL = isset($postObject->callbackURL) ? $postObject->callbackURL : null;
$validationURL = isset($postObject->validationURL) ? $postObject->validationURL : null;
$confirmationURL = isset($postObject->confirmationURL) ? $postObject->confirmationURL : null;
$resp = [];

if ($regNumber == null || $customerPhoneNumber == null || $amount == 0 || $transactionType == null) {
    throw new Exception('Invalid Payment parameters', 501);
} else {

    //go here to get them pass key developer.safaricom.co.ke/test_credentials
    $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

    $timestamp = $mpesa->GetTimeStamp(true);
    $password = base64_encode($businessShortCode . $LipaNaMpesaPasskey . $timestamp);

    $c2bUrlRegBody = [
        "ShortCode" => $businessShortCode,
        "ResponseType" => $responseType,
        "ConfirmationURL" => $confirmationURL,
        "ValidationURL" => $validationURL
    ];

    $c2bRequest = [
        "ShortCode" => $businessShortCode,
        "CommandID" => $transactionType,
        "Amount" => $amount,
        "Msisdn" => $customerPhoneNumber,
        "BillRefNumber" => ""
    ];


//    $resp = $mpesa->registerC2BUrls($c2bUrlRegBody);
    $resp = $mpesa->customerToBusiness($c2bRequest);
}

$fp = file_put_contents('logs/' . date('Ymdhis-') . 'response.log', $resp);

echo json_encode($resp);
die();

