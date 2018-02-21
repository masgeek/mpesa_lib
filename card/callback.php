<?php
$resp = serialize($_REQUEST);
$fp = file_put_contents('logs/' . date('Y_m_d_his-') . 'callback.log', $resp);
echo '<pre>';
var_dump(unserialize($resp));