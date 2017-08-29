<?php
/* @var $mpesa MPESA_FACTORY */
require_once 'config/config.php';
require_once 'mpesa/MPESA_FACTORY.php';

use mpesa\MPESA_FACTORY;


$mpesa = new MPESA_FACTORY(APP_CONSUMER_KEY, APP_CONSUMER_SECRET);

$token = $mpesa->GetAccessToken();

var_dump($token);

