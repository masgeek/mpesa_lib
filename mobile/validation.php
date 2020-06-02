<?php

$root_dir = dirname(dirname(__FILE__));

require_once $root_dir . '/vendor/autoload.php';


$callbackJSONData = file_get_contents('php://input');

// Tell log4php to use our configuration file.
Logger::configure($root_dir . '/config/config.xml');

$callbackParams = serialize($_POST);

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('validation');

/*
Reject an Mpesa transaction
by replying with the below code
*/

$failResp = [
    "ResultCode" => 1,
    "ResultDesc" => "Failed",
    "ThirdPartyTransID" => 0
];


/*
Accept an Mpesa transaction
by replying with the below code
*/

$successResp = [
    "ResultCode" => 0,
    "ResultDesc" => "Accepted",
    "ThirdPartyTransID" => 0
];

$log->info(json_decode($callbackJSONData));

echo json_encode($successResp);
die();