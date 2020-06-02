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
require_once 'TransactionCallBacks.php';
require_once $root_dir . '/helpers/DATABASE_HELPER.php';

$data = [];
$callbackJSONData = file_get_contents('php://input');


// Tell log4php to use our configuration file.
Logger::configure($root_dir . '/config/config.xml');

$callbackParams = serialize($_POST);

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('callback');

if (strlen($callbackJSONData) > 2) {
    //$data = \mpesa\TransactionCallBacks::processSTKPushRequestCallback($callbackJSONData, true);
}


$log->info(json_decode($callbackJSONData));

$callback = new \helper\DATABASE_HELPER();

$resp = $callback->WriteSTKToDatabase($data);

echo json_encode($resp);
die();
