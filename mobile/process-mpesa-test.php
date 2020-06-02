<?php
/* @var $mpesa MpesaFactory */
/* @throws \Httpful\Exception\ConnectionErrorException */

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../config/config.php';
require_once 'MpesaActions.php';


$mpesa = new \mpesa\MpesaActions();


$whoops = new Whoops\Run();
$handler = new \Whoops\Handler\JsonResponseHandler();
$whoops->pushHandler($handler);
$whoops->register();

$postObject = (object)$_POST;

$regNumber = isset($postObject->refNumber) ? $postObject->refNumber : null;
$customerPhoneNumber = isset($postObject->stkPhone) ? $postObject->stkPhone : null;
$transactionType = isset($postObject->transactionType) ? $postObject->transactionType : null;
$businessShortCode = isset($postObject->businessShortCode) ? $postObject->businessShortCode : null;
$amount = isset($postObject->amount) ? $postObject->amount : 0;
$desc = isset($postObject->desc) ? $postObject->desc : 'STK Payment';

$callbackURL = isset($postObject->callbackURL) ? $postObject->callbackURL : null;
$validationURL = isset($postObject->validationURL) ? $postObject->validationURL : null;
$confirmationURL = isset($postObject->confirmationURL) ? $postObject->confirmationURL : null;


$resp = $mpesa->processMe($businessShortCode, $transactionType, $amount, $customerPhoneNumber, $regNumber);


echo $resp;
die();

