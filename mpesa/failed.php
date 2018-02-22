<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 08-Feb-18
 * Time: 11:
 *
 * @var $callback \helper\DATABASE_HELPER
 */
$root_dir = dirname(dirname(__FILE__));

require_once $root_dir . '/vendor/autoload.php';
require_once 'TRANSACTION_CALLBACKS.php';
require_once $root_dir . '/helpers/DATABASE_HELPER.php';

$data = [];
$callbackJSONData = file_get_contents('php://input');


// Tell log4php to use our configuration file.
Logger::configure($root_dir . '/config/config.xml');

$callbackParams = serialize($_POST);

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('myLogger');

// Start logging
$log->info(json_decode($callbackJSONData));


if (strlen($callbackJSONData) > 2) {
    $data = \mpesa\TRANSACTION_CALLBACKS::processSTKPushRequestCallback($callbackJSONData, true);
}


$callback = new \helper\DATABASE_HELPER();

$resp = $callback->WriteSTKToDatabase($data);
