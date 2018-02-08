<?php
/* @var $mpesa MPESA_FACTORY */

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

$lipa_na_mpesa_post = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => '601373',
    'Password' => base64_encode('373reset'),
    'Timestamp' => $mpesa->GetTimeStamp(),
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount"' => '3000',
    'PartyA' => '254713196504',
    'PartyB' => '600000',
    'PhoneNumber' => '254708374149',
    'CallBackURL' => 'https://41.89.65.170:81/mpesa/callback',
    'AccountReference' => 'PAYH' . $mpesa->GetTimeStamp(),
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


//$resp = $mpesa->LipaNaMpesaProcessRequest($token, $lipa_na_mpesa_post);
//$resp = $mpesa->ConsumerToBusinessSimulate($c2b_post_data);
//var_dump($resp);

