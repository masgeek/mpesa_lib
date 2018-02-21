<?php
$respA = serialize($_REQUEST);
$respB = serialize($_POST);
$respC = serialize($_GET);
$respD = file_get_contents('php://input');

$fp = file_put_contents('logs/' . date('Y_m_d_his-') . 'callbackREQUEST.log', $respA);
$fp = file_put_contents('logs/' . date('Y_m_d_his-') . 'callbackPOST.log', $respB);
$fp = file_put_contents('logs/' . date('Y_m_d_his-') . 'callbackGET.log', $respC);
$fp = file_put_contents('logs/' . date('Y_m_d_his-') . 'callbackFILE.log', $respD);