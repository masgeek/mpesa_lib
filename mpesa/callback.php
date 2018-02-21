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

$callbackJSONData = <<<JSON
{"Body":{"stkCallback":{"MerchantRequestID":"8055-253849-2","CheckoutRequestID":"ws_CO_21022018142443504","ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1.00},{"Name":"MpesaReceiptNumber","Value":"MBL1V0VJ23"},{"Name":"Balance"},{"Name":"TransactionDate","Value":20180221142510},{"Name":"PhoneNumber","Value":254713196504}]}}}}
JSON;


if (strlen($callbackJSONData) > 2) {
    $data = \mpesa\TRANSACTION_CALLBACKS::processSTKPushRequestCallback($callbackJSONData, true);

    file_put_contents('logs/' . date('Y_m_d_h-i-s-') . 'request_json.log', $data);
}


$callback = new \helper\DATBASE_HELPER();

$resp = $callback->WriteSTKToDatabase($data);
