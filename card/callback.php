<?php
$callbackParams = serialize($_POST);

$fp = file_put_contents('logs/' . date('Y_m_d_his-') . 'callbackPOST.log', $callbackParams);
