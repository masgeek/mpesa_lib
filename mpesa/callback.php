<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 08-Feb-18
 * Time: 11:
 *
 * @var $callback \helper\DATBASE_HELPER
 */
$root_dir = dirname(dirname(__FILE__));

require_once $root_dir . '/vendor/autoload.php';
require_once 'TRANSACTION_CALLBACKS.php';
require_once $root_dir . '/helpers/DATBASE_HELPER.php';

$data = [];
$callbackJSONData = file_get_contents('php://input');


if (strlen($callbackJSONData) > 2) {
    $data = \mpesa\TRANSACTION_CALLBACKS::processSTKPushRequestCallback($callbackJSONData, true);

    file_put_contents('logs/' . date('Y_m_d_h-i-s-') . 'request_json.log', $callbackJSONData);
}


$callback = new \helper\DATBASE_HELPER();

$resp = $callback->WriteSTKToDatabase($data);
