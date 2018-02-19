<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 08-Feb-18
 * Time: 11:56
 */

$req_dump = print_r( $_REQUEST, true );
$fp = file_put_contents( date('Y_m_d').'request.log',serialize($req_dump) );