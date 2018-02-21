<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 08-Feb-18
 * Time: 11:56
 */

$callbackJSONData=file_get_contents('php://input');


file_put_contents('logs/' . date('Y_m_d_his-') . 'request_json.log', $callbackJSONData);