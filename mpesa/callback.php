<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 08-Feb-18
 * Time: 11:56
 */

$req_dumpA = print_r( $_GET, true );
$req_dumpB = print_r( $_POST, true );
$req_dumpC = print_r( $_REQUEST, true );


file_put_contents( date('Y_m_d').'request_get.log',serialize($req_dumpA) );
file_put_contents( date('Y_m_d').'request_post.log',serialize($req_dumpB) );
file_put_contents( date('Y_m_d').'request_request.log',serialize($req_dumpC) );