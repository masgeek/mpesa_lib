<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 08-Feb-18
 * Time: 11:56
 */

$req_dumpA = print_r($_GET, true);
$req_dumpB = print_r($_POST, true);
$req_dumpC = print_r($_REQUEST, true);
$callbackJSONData=file_get_contents('php://input');


file_put_contents('logs/' . date('Y_m_d') . 'request_get.log', serialize($req_dumpA));
file_put_contents('logs/' . date('Y_m_d') . 'request_post.log', serialize($req_dumpB));
file_put_contents('logs/' . date('Y_m_d') . 'request_request.log', serialize($req_dumpC));
file_put_contents('logs/' . date('Y_m_d') . 'request_json.log', $callbackJSONData);