<?php
/* @var $mpesa MPESA_FACTORY */
/* @throws \Httpful\Exception\ConnectionErrorException */

/**
 *
 * Shortcode 1    601373
 * Initiator Name (Shortcode 1)    apitest373
 * Security Credential (Shortcode 1)    373reset
 * Shortcode 2    600000
 * Test MSISDN    254708374149
 * ExpiryDate    2018-02-11T11:22:45+03:00
 * Lipa Na Mpesa Online Shortcode:    174379
 * Lipa Na Mpesa Online PassKey:
 * bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../config/config.php';
require_once 'MPESA_FACTORY.php';
require_once 'TRANSACTION_CALLBACKS.php';

$whoops = new Whoops\Run();
$handler = new \Whoops\Handler\PrettyPageHandler;
$whoops->pushHandler($handler);
$whoops->register();

$postObject = (object)$_POST;

$regNumber = isset($postObject->refNumber) ? $postObject->refNumber : null;
$phone = isset($postObject->phone) ? $postObject->phone : null;
$amount = isset($postObject->amount) ? $postObject->amount : 0;
$resp = [];

if ($regNumber == null || $phone == null || $amount == 0) {
    $handler->setPageTitle('Invalid Payment Parameters');

    throw new Exception('Invalid Payment parameters', 501);

}


use mpesa\MPESA_FACTORY;

$mpesa = new MPESA_FACTORY();

$BusinessShortCode = '174379';
$LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

$timestamp = $mpesa->GetTimeStamp(true);
$password = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $timestamp);

$callbackURL = 'https://smis2.uonbi.ac.ke/payment/mpesa/';
$callbackParams = "callback.php";

$lipa_na_mpesa_post = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $phone,
    'CallBackURL' => "{$callbackURL}{$callbackParams}",
    'AccountReference' => $regNumber,
    'TransactionDesc' => 'Test Payment'
);

$c2b_post_data = array(
    //Fill in the request parameters with valid values
    'ShortCode' => '601373',
    'CommandID' => 'CustomerPayBillOnline',
    'Amount' => '1',
    'Msisdn' => '254713196504',
    'BillRefNumber' => '00000'
);

//var_dump($lipa_na_mpesa_post);
//die;
$checkoutRequestID = 'ws_CO_21022018121436973';//'ws_CO_09022018144017528';

$lipa_na_mpesa_query_post = array(
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'CheckoutRequestID' => $checkoutRequestID
);

/*
 *   "MerchantRequestID":"9681-281674-1",
            "CheckoutRequestID":"ws_CO_08022018143137667",
            "ResponseCode": "0",
            "ResponseDescription":"Success. Request accepted for processing",
            "CustomerMessage":"Success. Request accepted for processing"
 */

//$resp = $mpesa->GenerateToken();
$resp = $mpesa->LipaNaMpesaProcessRequest($lipa_na_mpesa_post);
//$resp = $mpesa->LipaNaMpesaRequestQuery($lipa_na_mpesa_query_post);
//$resp = $mpesa->ConsumerToBusinessSimulate($c2b_post_data);
///$decoded = \mpesa\TRANSACTION_CALLBACKS::processSTKPushQueryRequestCallback($resp);
//var_dump($decoded);


$fp = file_put_contents('logs/' . date('Y_m_d_his-') . 'response.log', $resp);
echo '<pre>';
var_dump($resp);
