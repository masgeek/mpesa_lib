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
require_once 'config/config.php';
require_once 'mpesa/MPESA_FACTORY.php';

use mpesa\MPESA_FACTORY;


$mpesa = new MPESA_FACTORY();

$BusinessShortCode = '174379';
$LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

$timestamp = $mpesa->GetTimeStamp(true);
$password = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $timestamp);


$lipa_na_mpesa_post = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => '1',
    'PartyA' => '254708374149',
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => '254713196504',
    'CallBackURL' => 'http://tsobu.co.ke/mpesa/callback.php',
    'AccountReference' => 'PAY' . $timestamp,
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

$checkoutRequestID = 'ws_CO_08022018150403886';

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

//$resp = $mpesa->LipaNaMpesaProcessRequest($lipa_na_mpesa_post);
$resp = $mpesa->LipaNaMpesaRequest($lipa_na_mpesa_query_post);
//$resp = $mpesa->ConsumerToBusinessSimulate($c2b_post_data);

var_dump($resp);

