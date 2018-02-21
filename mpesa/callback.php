<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 08-Feb-18
 * Time: 11:56
 */
$root_dir = dirname(dirname(__FILE__));

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use Httpful\Request;

require_once $root_dir . '/vendor/autoload.php';

$callbackJSONData = file_get_contents('php://input');


var_dump($callbackJSONData);
file_put_contents('logs/' . date('Y_m_d_his-') . 'request_json.log', $callbackJSONData);

class callback
{
    public static function WriteSTKToDatabase($callbackObject)
    {

    }
}