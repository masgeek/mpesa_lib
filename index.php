<?php
/* @var $mpesa MPESA_FACTORY */
require_once 'config/config.php';
require_once 'mpesa/MPESA_FACTORY.php';

use mpesa\MPESA_FACTORY;


$mpesa = new MPESA_FACTORY(APP_CONSUMER_KEY, APP_CONSUMER_SECRET);

$token = '1lvMG20Oh0TKnTiPAMfNWZoUToMb';//$mpesa->GetAccessToken();

$mpesa->access_token = $token;

$curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => ' ',
    'Password' => ' ',
    'Timestamp' => ' ',
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount"' => '3000',
    'PartyA' => ' ',
    'PartyB' => ' ',
    'PhoneNumber' => ' ',
    'CallBackURL' => 'https://ip_address:port/callback',
    'AccountReference' => ' ',
    'TransactionDesc' => ' '
);


$resp = $mpesa->LipaNaMpesaProcessRequest($curl_post_data);

var_dump($resp);

