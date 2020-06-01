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
$amount = isset($postObject->amount) ? $postObject->amount : 0;
$desc = isset($postObject->desc) ? $postObject->desc : 'Payment';
$resp = [];

if ($regNumber == null || $customerPhoneNumber == null || $amount == 0) {
    $handler->setPageTitle('Invalid Payment Parameters');
    throw new Exception('Invalid Payment parameters', 501);
}


$BusinessShortCode = '174379';

//go here to get them pass key developer.safaricom.co.ke/test_credentials
$LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

$timestamp = $mpesa->GetTimeStamp(true);
$password = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $timestamp);

//$callbackURL = 'https://mpesa.tsobu.co.ke/mpesa//callback.php';
$callbackURL = 'https://b5b222540e96.ngrok.io/callback.php';


$lipaNaMpesaPost = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
//    'TransactionType' => 'CustomerBuyGoodsOnline',
    'Amount' => $amount,
    'PartyA' => $customerPhoneNumber,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $customerPhoneNumber,
    'CallBackURL' => "{$callbackURL}{$callbackParams}",
    'AccountReference' => $regNumber,
    'TransactionDesc' => $desc,
    //'Remark' => 'TEst Payment'
);

$c2bRequest = [
    "ShortCode" => $BusinessShortCode,
    "CommandID" => "CustomerBuyGoodsOnline",
    "Amount" => $amount,
    "Msisdn" => $customerPhoneNumber,
    // "BillRefNumber" => ""
];
$checkoutRequestID = 'ws_CO_21022018121436973';//'ws_CO_09022018144017528';

$lipa_na_mpesa_query_post = array(
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'CheckoutRequestID' => $checkoutRequestID
);


//$resp = $mpesa->LipaNaMpesaProcessRequest($lipaNaMpesaPost);
$resp = $mpesa->customerToBusiness($c2bRequest);
//$resp = $mpesa->LipaNaMpesaRequestQuery($lipa_na_mpesa_query_post);


$fp = file_put_contents('logs/' . date('Y_m_d_his-') . 'response.log', $resp);

echo json_encode($resp);
die();

