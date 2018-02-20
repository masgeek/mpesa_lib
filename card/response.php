<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 20-Feb-18
 * Time: 12:04
 */

$resp = serialize($_POST);

file_put_contents(date('Y_m_d_his-') . 'response.log', $resp);